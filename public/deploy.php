<?php
/**
 * GitHub webhook auto-deploy endpoint.
 *
 * Point a GitHub webhook (Settings -> Webhooks -> Add webhook) at:
 *   https://your-domain.com/deploy.php
 * Content type: application/json
 * Secret: value of DEPLOY_WEBHOOK_SECRET in .env
 * Events: "Just the push event"
 *
 * Only a push whose ref is refs/heads/{DEPLOY_BRANCH} (default: main) with a
 * valid HMAC signature triggers a deploy. Everything else is ignored (200)
 * or rejected (403/405) without touching the working tree.
 */

declare(strict_types=1);

$projectRoot = dirname(__DIR__);
$logFile = $projectRoot.'/storage/logs/deploy.log';
$lockFile = $projectRoot.'/storage/framework/deploy.lock';

function respond(int $status, array $body): never
{
    http_response_code($status);
    header('Content-Type: application/json');
    echo json_encode($body);
    exit;
}

function deployLog(string $file, string $line): void
{
    @file_put_contents($file, '['.date('Y-m-d H:i:s').'] '.$line.PHP_EOL, FILE_APPEND);
}

/** Minimal .env reader — deploy.php must work even mid-deploy, before vendor/ is settled. */
function readEnvValue(string $envPath, string $key): ?string
{
    if (! is_readable($envPath)) {
        return null;
    }

    foreach (file($envPath, FILE_IGNORE_NEW_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || ! str_starts_with($line, $key.'=')) {
            continue;
        }

        $value = substr($line, strlen($key) + 1);

        return trim($value, " \t\n\r\0\x0B\"'");
    }

    return null;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(405, ['message' => 'Method not allowed']);
}

$secret = readEnvValue($projectRoot.'/.env', 'DEPLOY_WEBHOOK_SECRET');

if (! $secret) {
    deployLog($logFile, 'Rejected: DEPLOY_WEBHOOK_SECRET is not configured in .env');
    respond(500, ['message' => 'Deploy webhook is not configured']);
}

$payload = file_get_contents('php://input') ?: '';
$signatureHeader = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';
$expectedSignature = 'sha256='.hash_hmac('sha256', $payload, $secret);

if ($signatureHeader === '' || ! hash_equals($expectedSignature, $signatureHeader)) {
    deployLog($logFile, 'Rejected: missing or invalid X-Hub-Signature-256');
    respond(403, ['message' => 'Invalid signature']);
}

$data = json_decode($payload, true);
$ref = is_array($data) ? ($data['ref'] ?? '') : '';
$branch = readEnvValue($projectRoot.'/.env', 'DEPLOY_BRANCH') ?: 'main';

if ($ref !== "refs/heads/{$branch}") {
    deployLog($logFile, "Ignored: push to '{$ref}' (deploying on '{$branch}' only)");
    respond(200, ['message' => "Ignored: push to {$ref}"]);
}

// Prevent overlapping deploys if GitHub retries/redelivers the webhook.
$lockHandle = fopen($lockFile, 'c');
if (! $lockHandle || ! flock($lockHandle, LOCK_EX | LOCK_NB)) {
    deployLog($logFile, 'Skipped: a deploy is already in progress');
    respond(429, ['message' => 'A deploy is already in progress']);
}

deployLog($logFile, "Deploy started for {$ref}");

$steps = [
    'git fetch --depth=1 origin '.escapeshellarg($branch),
    'git reset --hard '.escapeshellarg('origin/'.$branch),
    'composer install --no-dev --optimize-autoloader --no-interaction',
    'php artisan migrate --force',
    'php artisan config:cache',
    'php artisan route:cache',
    'php artisan view:cache',
    'npm ci',
    'npm run build',
];

$exitCode = 0;
foreach ($steps as $step) {
    $output = [];
    $stepExitCode = 0;
    exec('cd '.escapeshellarg($projectRoot).' && '.$step.' 2>&1', $output, $stepExitCode);
    deployLog($logFile, "\$ {$step}\n".implode("\n", $output));

    if ($stepExitCode !== 0) {
        $exitCode = $stepExitCode;
        deployLog($logFile, "Step failed (exit {$stepExitCode}), aborting remaining steps.");
        break;
    }
}

flock($lockHandle, LOCK_UN);
fclose($lockHandle);
@unlink($lockFile);

if ($exitCode !== 0) {
    deployLog($logFile, 'Deploy FAILED — see steps above.');
    respond(500, ['message' => 'Deploy failed, check storage/logs/deploy.log']);
}

deployLog($logFile, 'Deploy finished successfully.');
respond(200, ['message' => 'Deployed successfully']);
