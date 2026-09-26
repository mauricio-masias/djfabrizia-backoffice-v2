<?php

namespace Tests\Integration;

use Illuminate\Foundation\Testing\RefreshDatabaseState;
use PDO;
use PDOException;
use Tests\TestCase;

/**
 * Runs against the real MariaDB test database (djfabriz_cms_test) instead of
 * SQLite, to catch differences in JSON handling, collation and strict mode.
 * Skipped when that database is not reachable (e.g. outside Docker).
 *
 * Laravel tracks "already migrated" in one static flag shared by every test.
 * This class keeps a separate flag for MariaDB and swaps it in and out, so a
 * MariaDB migration never makes the SQLite tests skip theirs (and vice versa).
 */
abstract class IntegrationTestCase extends TestCase
{
    private const DATABASE = 'djfabriz_cms_test';

    private static bool $mariaDbMigrated = false;

    private bool $sqliteMigrated = false;

    /** @var array<string, array{env: string|false, _ENV: mixed, _SERVER: mixed}> */
    private array $originalEnv = [];

    protected function setUp(): void
    {
        $this->useMariaDb();

        $this->sqliteMigrated = RefreshDatabaseState::$migrated;
        RefreshDatabaseState::$migrated = self::$mariaDbMigrated;

        parent::setUp();

        self::$mariaDbMigrated = RefreshDatabaseState::$migrated;
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        RefreshDatabaseState::$migrated = $this->sqliteMigrated;

        foreach ($this->originalEnv as $key => $original) {
            $original['env'] === false ? putenv($key) : putenv("{$key}={$original['env']}");
            $_ENV[$key] = $original['_ENV'];
            $_SERVER[$key] = $original['_SERVER'];
        }

        $this->originalEnv = [];
    }

    private function useMariaDb(): void
    {
        $host = getenv('DB_HOST') ?: 'djdb';
        $port = getenv('DB_PORT') ?: '3306';
        $user = getenv('DB_USERNAME') ?: 'cms_rw';
        $password = getenv('DB_PASSWORD') ?: $this->passwordFromDotEnv();

        try {
            new PDO("mysql:host={$host};port={$port};dbname=".self::DATABASE, $user, $password, [PDO::ATTR_TIMEOUT => 2]);
        } catch (PDOException $exception) {
            $this->markTestSkipped('MariaDB test database unavailable: '.$exception->getMessage());
        }

        foreach (['DB_CONNECTION' => 'mysql', 'DB_DATABASE' => self::DATABASE, 'DB_HOST' => $host, 'DB_PORT' => $port, 'DB_USERNAME' => $user, 'DB_PASSWORD' => $password] as $key => $value) {
            $this->originalEnv[$key] = ['env' => getenv($key), '_ENV' => $_ENV[$key] ?? null, '_SERVER' => $_SERVER[$key] ?? null];
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }

    /**
     * phpunit.xml forces SQLite, so the MariaDB password is read from .env.
     */
    private function passwordFromDotEnv(): string
    {
        $env = @file_get_contents(dirname(__DIR__, 2).'/.env');

        if ($env !== false && preg_match('/^DB_PASSWORD=(.*)$/m', $env, $match) === 1) {
            return trim($match[1], " \"'");
        }

        return '';
    }
}
