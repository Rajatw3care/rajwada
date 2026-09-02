<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Hard stop before ANY test runs — and, critically, before
     * parent::setUp() gets a chance to run RefreshDatabase's migrate:fresh
     * — unless this process is unambiguously an isolated local test run.
     *
     * Why this exists: on 2026-09-02 the test suite was run directly on the
     * live server. A stale config cache made Laravel misreport its own
     * environment, RefreshDatabase's migrate:fresh call went through, and
     * the live database was wiped.
     *
     * This checks the RAW process environment variable (not app()->environment(),
     * which isn't available yet at this point — the app object doesn't exist
     * until parent::setUp() creates it, and by then RefreshDatabase has
     * already run). Raw env vars are what phpunit.xml's <env> block injects,
     * and they're immune to a stale bootstrap/cache/config.php the way
     * config()/app()->environment() are not.
     *
     * A second, redundant check runs after boot too, purely as a backstop —
     * see guardAgainstUnsafeDatabase() below.
     *
     * Never run `php artisan test` / `vendor/bin/pest` anywhere but a local
     * dev machine. This guard is a last-resort safety net, not a reason to
     * ever try it on the live server again.
     */
    protected function setUp(): void
    {
        $rawEnv = getenv('APP_ENV') ?: ($_ENV['APP_ENV'] ?? ($_SERVER['APP_ENV'] ?? null));

        if ($rawEnv !== 'testing') {
            $this->abortSuite('Raw APP_ENV is "'.($rawEnv ?? 'null').'", not "testing".');
        }

        parent::setUp();

        $this->guardAgainstUnsafeDatabase();
    }

    /**
     * Backstop check once the real app exists — catches the case where the
     * raw env var above looked fine but Laravel still resolved something
     * unsafe (e.g. a hand-edited phpunit.xml pointing at a real database).
     */
    protected function guardAgainstUnsafeDatabase(): void
    {
        if (! app()->environment('testing')) {
            $this->abortSuite('app()->environment() is "'.app()->environment().'", not "testing".');
        }

        $connection = config('database.default');
        $database = (string) config("database.connections.{$connection}.database");

        $looksSafe = $connection === 'sqlite'
            && ($database === ':memory:' || str_contains($database, 'testing'));

        if (! $looksSafe) {
            $this->abortSuite(
                "The resolved database connection doesn't look like an isolated test database ".
                "(connection=\"{$connection}\" database=\"{$database}\")."
            );
        }
    }

    private function abortSuite(string $reason): never
    {
        fwrite(STDERR, "\n\n".str_repeat('=', 78)."\n".
            "ABORTING TEST SUITE — refusing to risk touching a real database.\n".
            $reason."\n".
            "Tests must only ever run locally with APP_ENV=testing (see phpunit.xml).\n".
            "Never run the test suite on the live/production server.\n".
            str_repeat('=', 78)."\n\n");

        exit(1);
    }
}
