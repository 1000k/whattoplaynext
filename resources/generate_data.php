<?php
define('DATA_JSON', './data.json');
define('DATABASE_CONFIG_FILE', '../app/config/database.php');

require_once DATABASE_CONFIG_FILE;

function connectDb() {
	$config = new DATABASE_CONFIG;

	$dbname = $config->default['database'];
	$host = $config->default['host'];
	$user = $config->default['login'];
	$password = $config->default['password'];

	return new PDO("mysql:dbname={$dbname};host={$host}", $user, $password);
}

function dropTable($pdo, $table) {
	return $pdo->exec("DROP TABLE {$table}");
}

function duplicated($tune) {
	return false;
}

$data_json = file_get_contents(DATA_JSON);
if ($data_json === false) {
	echo 'Failed to read json file.';
	exit;
}

if (($data = json_decode($data_json)) === false) {
	echo 'Failed to parse json.';
	exit;
}

try {
	$pdo = connectDb();

	foreach (['books', 'books_tunes', 'tunes'] as $table) {
		dropTable($pdo, $table);
	}
} catch (Exception $e) {
	echo $e->getMessage();
	exit;
}
