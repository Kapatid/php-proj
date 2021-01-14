<?php

class User extends Database {
    
    public static function getUsers() {
        $db = new Database();
        return $db->getAll("users");
    }

    public static function findUser(int $id = 0, string $email = '', string $password = '') {
        $db = new Database();
        $user = $db->find("users", $id, $email);

        if (password_verify($password, $user['password'])) {
            return $user;
        }
        else {
            return null;
        }
    }

    public function setUser(string $first_name, string $last_name, string $email, string $department, string $password) {
        $data = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "department" => $department,
        "password" => $password
        );

        $db = new Database();
        $db->create("users", $data);
    }

    public static function updateUser(int $id, string $first_name, string $last_name, string $department) {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "department" => $department,
            "updated_at" => date("Y-m-d H:i:s")
        );

        $db = new Database();
        return $db->update("users", $id, $data);
    }
}