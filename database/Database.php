<?php
require_once __DIR__ . '/../config/env.php';
loadEnv();

class Database
{
    private $conn;

    public function __construct()
    {
        $host   = $_ENV['DB_HOST'];
        $user   = $_ENV['DB_USER'];
        $pass   = $_ENV['DB_PASS'];
        $dbname = $_ENV['DB_NAME'];

        $this->conn = new mysqli($host, $user, $pass, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
