<?php

/*
|--------------------------------------------------------------------------
| Safety guard — deletes a stale config cache before anything else
|--------------------------------------------------------------------------
|
| On 2026-09-02 the test suite was run directly on the live server. A stale
| bootstrap/cache/config.php made Laravel misreport its own environment,
| RefreshDatabase's migrate:fresh call went through, and the live database
| was wiped. The actual per-test guard lives in tests/TestCase.php (it has
| to run inside a test's setUp(), before parent::setUp(), to catch this
| ahead of RefreshDatabase — see the comment there). This just removes the
| stale cache file so config() reflects .env / phpunit.xml again, in case
| a leftover `php artisan config:cache` on a dev machine ever reintroduces
| the same failure mode.
|
*/

$cachedConfig = __DIR__.'/../bootstrap/cache/config.php';
if (file_exists($cachedConfig)) {
    unlink($cachedConfig);
}

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function something()
{
    // ..
}
