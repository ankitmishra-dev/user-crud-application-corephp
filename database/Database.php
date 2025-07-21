<?php
class Database {
    private $conn;

    public function __construct() {
        $host = 'localhost';
        $user = 'root';
        $pass = '';
        $dbname = 'users_crud';

        $this->conn = new mysqli($host, $user, $pass, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
