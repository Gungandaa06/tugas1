<?php
// class/Database.php
class Database {
private static $instance = null;
private $pdo;


private function __construct($host, $db, $user, $pass) {
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
$opts = [
PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
$this->pdo = new PDO($dsn, $user, $pass, $opts);
}


public static function getInstance($host, $db, $user, $pass) {
if (self::$instance === null) {
self::$instance = new Database($host, $db, $user, $pass);
}
return self::$instance;
}


public function getConnection() {
return $this->pdo;
}
}
