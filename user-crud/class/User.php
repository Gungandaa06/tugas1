<?php
// class/User.php
class User {
private $pdo;
public function __construct(PDO $pdo) {
$this->pdo = $pdo;
}


// contoh: cek login (username/password simple, password hashed)
public function authenticate($username, $password) {
$stmt = $this->pdo->prepare('SELECT id, username, password_hash FROM users WHERE username = :u LIMIT 1');
$stmt->execute([':u' => $username]);
$row = $stmt->fetch();
if ($row && password_verify($password, $row['password_hash'])) {
return $row;
}
return false;
}
}
