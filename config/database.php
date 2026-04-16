<?php

declare(strict_types=1);

function databaseConfig(): array
{
	return [
		'driver' => $_ENV['DB_CONNECTION'] ?? 'mysql',
		'host' => $_ENV['DB_HOST'] ?? '127.0.0.1',
		'port' => (int) ($_ENV['DB_PORT'] ?? 3310),
		'database' => $_ENV['DB_DATABASE'] ?? 'databasename',
		'username' => $_ENV['DB_USERNAME'] ?? 'databaseuser',
		'password' => $_ENV['DB_PASSWORD'] ?? 'databasepassword',
		'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
	];
}

function databaseDsn(?array $config = null): string
{
	$config ??= databaseConfig();

	return sprintf(
		'%s:host=%s;port=%d;dbname=%s;charset=%s',
		$config['driver'],
		$config['host'],
		$config['port'],
		$config['database'],
		$config['charset']
	);
}

function database(): PDO
{
	static $connection = null;

	if ($connection instanceof PDO) {
		return $connection;
	}

	$config = databaseConfig();

	$connection = new PDO(
		databaseDsn($config),
		$config['username'],
		$config['password'],
		[
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES => false,
		]
	);

	return $connection;
}
function bootEloquent(): Illuminate\Database\Capsule\Manager
{
    $capsule = new Illuminate\Database\Capsule\Manager();
    $capsule->addConnection(databaseConfig());
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
}