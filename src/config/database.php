<?php
$config = include __DIR__ . '/config.php';

class Database {
    private $conn;

    public function getConnection(){
        global $config;
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$config['DB_HOST']};dbname={$config['DB_NAME']}",
                $config['DB_USER'],
                $config['DB_PASS']
            );
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
