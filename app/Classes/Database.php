<?php

class Database {
    private $host = "localhost";
    private $user = "root";
    private $pwd = "";
    private $dbName = "oop_php";

    protected function connect() {

        try {
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName; // Type of database and what host and db name 

            $pdo = new PDO($dsn, $this->user, $this->pwd, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
            
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, 
                               PDO::FETCH_ASSOC); // FETCH_ASSOC returns an array

            return $pdo;
        } 
        catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
            exit;
        }

    }
}