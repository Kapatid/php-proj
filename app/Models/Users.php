<?php

class Users extends Database {

    public function getUsers() {
        $sql = "SELECT * 
                FROM users";
        
        $stmt = $this->connect()->query($sql); // Executes query
        $users = $stmt->fetchAll(); // Gets query results

        return $users;
    }

    protected function getUser(string $first_name, string $last_name) {
        $sql = "SELECT * 
                FROM users
                WHERE first_name = ? AND last_name = ?"; // Made to prevention harmful injections by users
        
        $stmt = $this->connect()->prepare($sql); // prepare() is used to bind any user-input
        $stmt->execute([$first_name, $last_name]); // execute() executes a prepared statement
        $names = $stmt->fetchAll();

        foreach($names as $name) {
            echo $name['first_name'] . " " . $name['last_name'] . "<br>"; // Print
        }
    }

    protected function setUser(string $first_name, string $last_name, string $email, string $password, string $department) {
        $sql = "INSERT INTO `users`(first_name, last_name, email, password, department)
                VALUES (?, ?, ?, ?, ?)"; 

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$first_name, $last_name, $email, $password, $department]);
    }

    protected function updateUser(int $id, string $first_name, string $last_name, string $department) {
        date_default_timezone_set('Asia/Hong_Kong');
        $sql = "UPDATE `users` SET `first_name`=?, `last_name`=?, `department`=?, `updated_at`=?
                WHERE `id` = $id"; 

        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$first_name, $last_name, $department, date("Y-m-d H:i:s")]);
    }
}