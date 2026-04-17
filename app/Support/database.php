<?php

declare(strict_types=1);

function envValue(string $key, ?string $default = null): ?string
{
    $value = getenv($key);

    if ($value === false || $value === '') {
        return $default;
    }

    return $value;
}

function parseDatabaseUrl(string $url): array
{
    $parts = parse_url($url);
    if ($parts === false || !isset($parts['scheme'], $parts['host'], $parts['path'], $parts['user'], $parts['pass'])) {
        throw new RuntimeException('DATABASE_URL invalido.');
    }

    $driver = $parts['scheme'] === 'postgres' ? 'pgsql' : $parts['scheme'];
    $database = ltrim($parts['path'], '/');

    return [
        'driver' => $driver,
        'host' => $parts['host'],
        'port' => $parts['port'] ?? ($driver === 'pgsql' ? '5432' : '3306'),
        'database' => $database,
        'username' => $parts['user'],
        'password' => $parts['pass'],
    ];
}

function createDatabaseConnection(): PDO
{
    $databaseUrl = envValue('DATABASE_URL');

    if ($databaseUrl !== null) {
        $config = parseDatabaseUrl($databaseUrl);
        $driver = $config['driver'];
        $host = $config['host'];
        $port = $config['port'];
        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];
    } else {
        $driver = envValue('DB_DRIVER', 'mysql');
        $host = envValue('DB_HOST', '127.0.0.1');
        $port = envValue('DB_PORT', $driver === 'pgsql' ? '5432' : '3306');
        $database = envValue('DB_NAME', 'nexa_growth');
        $username = envValue('DB_USER', 'root');
        $password = envValue('DB_PASS', '');
    }

    if ($database === null || $username === null) {
        throw new RuntimeException('As configuracoes de banco de dados estao incompletas.');
    }

    if ($driver === 'pgsql') {
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);
    } elseif ($driver === 'mysql') {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $database);
    } else {
        throw new RuntimeException('Driver de banco de dados desconhecido: ' . $driver);
    }

    return new PDO(
        $dsn,
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
}
