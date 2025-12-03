<?php
p
class Database {
    
    // Database connection property
    public $conn;

    // Constructor to initialize the database connection

    // Establish database connection
    public function connect() {
        if(!$this->conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME)){
            exit('Connection Failed');
        }
        return $this->conn;

    }
    
    // Disconnect from the database
    public function disconnect() {
        mysqli_close($this->conn);

        //*cara pdo
        //$this->conn = null;
    }
    // Execute a query with optional parameters
    public function query($sql, $params = []){
        // Prepare and excute statement, return false for failed query
        if (!result = mysqli_query())
    }

}  