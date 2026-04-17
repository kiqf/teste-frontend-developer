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
    if (str_starts_with($url, 'sqlite:')) {
        $path = substr($url, strlen('sqlite:'));

        if ($path === false || $path === '') {
            throw new RuntimeException('DATABASE_URL sqlite invalido.');
        }

        return [
            'driver' => 'sqlite',
            'path' => $path,
        ];
    }

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

function projectRootPath(string $path = ''): string
{
    $root = dirname(__DIR__, 2);

    if ($path === '') {
        return $root;
    }

    return $root . '/' . ltrim($path, '/');
}

function resolveSqlitePath(string $path): string
{
    if ($path === '' || $path === ':memory:') {
        return $path;
    }

    if ($path[0] === '/') {
        return $path;
    }

    return projectRootPath($path);
}

function initializeSqliteDatabase(PDO $pdo, string $databasePath): void
{
    if ($databasePath === ':memory:') {
        $pdo->exec((string) file_get_contents(projectRootPath('database/schema-sqlite.sql')));
        return;
    }

    $schemaPath = projectRootPath('database/schema-sqlite.sql');
    $tableExists = $pdo
        ->query("SELECT name FROM sqlite_master WHERE type = 'table' AND name = 'contatos'")
        ->fetchColumn();

    if ($tableExists !== false) {
        return;
    }

    $schema = file_get_contents($schemaPath);

    if ($schema === false) {
        throw new RuntimeException('Nao foi possivel carregar o schema do SQLite.');
    }

    $pdo->exec($schema);
}

function createDatabaseConnection(): PDO
{
    $databaseUrl = envValue('DATABASE_URL');

    if ($databaseUrl !== null) {
        $config = parseDatabaseUrl($databaseUrl);
        $driver = $config['driver'];

        if ($driver === 'sqlite') {
            $database = resolveSqlitePath($config['path']);
            $host = null;
            $port = null;
            $username = null;
            $password = null;
        } else {
            $host = $config['host'];
            $port = $config['port'];
            $database = $config['database'];
            $username = $config['username'];
            $password = $config['password'];
        }
    } else {
        $driver = envValue('DB_DRIVER', 'mysql');

        if ($driver === 'sqlite') {
            $database = resolveSqlitePath(envValue('DB_DATABASE', 'database/app.sqlite') ?? 'database/app.sqlite');
            $host = null;
            $port = null;
            $username = null;
            $password = null;
        } else {
            $host = envValue('DB_HOST', '127.0.0.1');
            $port = envValue('DB_PORT', $driver === 'pgsql' ? '5432' : '3306');
            $database = envValue('DB_NAME', 'nexa_growth');
            $username = envValue('DB_USER', 'root');
            $password = envValue('DB_PASS', '');
        }
    }

    if ($database === null) {
        throw new RuntimeException('As configuracoes de banco de dados estao incompletas.');
    }

    if ($driver === 'pgsql') {
        $dsn = sprintf('pgsql:host=%s;port=%s;dbname=%s', $host, $port, $database);
    } elseif ($driver === 'mysql') {
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4', $host, $port, $database);
    } elseif ($driver === 'sqlite') {
        if ($database !== ':memory:') {
            $directory = dirname($database);

            if (!is_dir($directory) && !mkdir($directory, 0777, true) && !is_dir($directory)) {
                throw new RuntimeException('Nao foi possivel criar o diretorio do SQLite.');
            }
        }

        $dsn = sprintf('sqlite:%s', $database);
    } else {
        throw new RuntimeException('Driver de banco de dados desconhecido: ' . $driver);
    }

    $pdo = new PDO(
        $dsn,
        $username,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );

    if ($driver === 'sqlite') {
        initializeSqliteDatabase($pdo, $database);
    }

    return $pdo;
}
