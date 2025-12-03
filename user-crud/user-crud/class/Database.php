<?php
// class/Database.php
class Database {
private static $instance = null;
private $pdo;


private function __construct() {
require_once __DIR__ . '/../inc/config.php';
$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
try {
$this->pdo = new PDO($dsn, DB_USER, DB_PASS, [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
]);
} catch (PDOException $e) {
die('Koneksi DB gagal: ' . $e->getMessage());
}
}


public static function getInstance() {
if (self::$instance === null) {
self::$instance = new Database();
}
return self::$instance;
}


public function getConnection() {
return $this->pdo;
}
}
