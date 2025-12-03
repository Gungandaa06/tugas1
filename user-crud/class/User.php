<?php

class User {

  
// protected properties
protected $id;
protected $password;
protected $db;

  // protected properties
protected $id;
protected $password;
protected $db;

  // constructor

public function __construct() {
  $this->db = new Database();
}

  // Authenticate user credentials
  public function __construct() {
    
  }

  // Get all users
  puiblic function getAll(){
    $sql = "SELECT"
  }

  // Set user properties by ID

public function setById($id) {
  $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
  $stmt = $this->db->query($sql, ['id' => $id]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    $this->id = $user['id'];
    $this->username = $user['username'];
    $this->fullname = $user['fullname'];
    $this->city = $user['city'];
    $this->created_at = $user['created_at'];
    $this->password = $user['password'];
    return true;
  }
  return false;
}

  // Get ID
  public function getID()
    return $this->id;

  // Get password
 public function getPassword(){
  return $this->password;
 }

  // Set password (hashed)
  public function setPass($password){
    sthis->password = password_hash ($password, PASSWORD_DEFAULT);
  }

  // Save user (insert or update)
  
  // Remove user
  
}