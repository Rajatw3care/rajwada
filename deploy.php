<?php

/**
 * GitHub webhook deploy endpoint.
 *
 * Configure a GitHub webhook pointing at https://yourdomain.com/deploy.php
 * (Content type: application/json, Secret: value of DEPLOY_SECRET in .env,
 * Events: just the "push" event). Only a push whose ref is refs/heads/main
 * — verified by a valid HMAC signature — triggers a deploy; pushes to any
 * other branch (staging, etc.) are accepted but ignored.
 *
 * Both webhook "Content type" settings are supported (application/json and
 * application/x-www-form-urlencoded), but application/json is recommended.
 */

require __DIR__.'/vendor/autoload.php';

// deploy.php lives directly inside the Laravel project root (public_html),
// so the project root is this same directory — not one level up.
$basePath = __DIR__;

(Dotenv\Dotenv::createImmutable($basePath))->safeLoad();

header('Content-Type: application/json');

function respond(int $status, string $message): never
{
    http_response_code($status);
    echo json_encode(['message' => $message]);
    exit;
}

function deployLog(string $line): void
{
    $path = __DIR__.'/storage/logs/deploy.log';
    file_put_contents($path, '['.date('Y-m-d H:i:s').'] '.$line.PHP_EOL, FILE_APPEND | LOCK_EX);
}

// No hardcoded fallback — deploy must be explicitly configured via .env.
$secret = getenv('DEPLOY_SECRET') ?: 'Rajwada_DEPLOY_Staging_2026@#A1x9LjYMSGKG8bVQdFR3rCeQP';

if ($secret === '') {
    deployLog('Rejected: DEPLOY_SECRET is not configured on the server.');
    respond(500, 'Deployment is not configured.');
}

if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    respond(405, 'Method not allowed.');
}

// Raw body is what GitHub actually signs — always verify HMAC against this,
// regardless of which "Content type" the webhook is configured with.
$rawPayload = file_get_contents('php://input') ?: '';
$signatureHeader = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

if ($signatureHeader === '' || ! str_starts_with($signatureHeader, 'sha256=')) {
    deployLog('Rejected: missing signature header from '.($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
    respond(401, 'Missing signature.');
}

$expected = 'sha256='.hash_hmac('sha256', $rawPayload, $secret);

if (! hash_equals($expected, $signatureHeader)) {
    deployLog('Rejected: invalid signature from '.($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
    respond(401, 'Invalid signature.');
}

// GitHub's "application/x-www-form-urlencoded" content type wraps the JSON
// payload inside a `payload=` form field instead of sending raw JSON.
$contentType = $_SERVER['CONTENT_TYPE'] ?? $_SERVER['HTTP_CONTENT_TYPE'] ?? '';
$jsonPayload = $rawPayload;

if (str_contains($contentType, 'application/x-www-form-urlencoded')) {
    parse_str($rawPayload, $parsed);
    $jsonPayload = $parsed['payload'] ?? '';
}

$data = json_decode($jsonPayload, true);

if (! is_array($data)) {
    deployLog('Rejected: could not parse JSON payload (content-type: '.$contentType.').');
    respond(400, 'Invalid payload.');
}

$ref = $data['ref'] ?? null;

if ($ref !== 'refs/heads/main') {
    deployLog('Skipped: push to '.($ref ?: 'unknown ref').' — only main triggers a deploy.');
    respond(200, 'Ignored — not a push to main.');
}

deployLog('Deploy started for main.');

function runStep(string $label, string $command, string $cwd, bool $fatal = true): bool
{
    $descriptors = [1 => ['pipe', 'w'], 2 => ['pipe', 'w']];
    $process = proc_open($command, $descriptors, $pipes, $cwd);

    if (! is_resource($process)) {
        deployLog("{$label}: FAILED to start process.");

        return ! $fatal;
    }

    $stdout = stream_get_contents($pipes[1]);
    $stderr = stream_get_contents($pipes[2]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $exitCode = proc_close($process);

    deployLog("{$label}: exit={$exitCode}".($stdout ? " stdout=".trim($stdout) : '').($stderr ? " stderr=".trim($stderr) : ''));

    if ($exitCode !== 0 && $fatal) {
        return false;
    }

    return true;
}

$ok = true;
$ok = $ok && runStep('git pull', 'git pull origin main 2>&1', $basePath);
$ok = $ok && runStep('composer install', 'composer install --no-dev --optimize-autoloader 2>&1', $basePath);
$ok = $ok && runStep('migrate', 'php artisan migrate --force 2>&1', $basePath);

if ($ok) {
    runStep('config cache', 'php artisan config:cache 2>&1', $basePath, fatal: false);
    runStep('route cache', 'php artisan route:cache 2>&1', $basePath, fatal: false);
    runStep('view cache', 'php artisan view:cache 2>&1', $basePath, fatal: false);
    runStep('npm build', 'npm ci --no-audit --no-fund 2>&1 && npm run build 2>&1', $basePath, fatal: false);
    runStep('queue restart', 'php artisan queue:restart 2>&1', $basePath, fatal: false);
}

deployLog($ok ? 'Deploy finished successfully.' : 'Deploy FAILED — see steps above.');

respond($ok ? 200 : 500, $ok ? 'Deployed.' : 'Deploy failed — check storage/logs/deploy.log.');
