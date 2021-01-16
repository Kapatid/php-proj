<?php

class User extends Database {
    private $db;

    function __construct()
    {
        $this->db = new Database();
    }
    
    public function getUsers() {
        return $this->db->getAll("users");
    }

    public function findUser(int $id = 0, string $email = '', string $password = '') {
        $user = $this->db->find("users", $id, $email);

        if (password_verify($password, $user['password'])) {
            return $user;
        }
        else {
            return null;
        }
    }

    public function setUser(string $first_name, string $last_name, string $email, string $password) {
        $data = array(
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "password" => $password
        );

        $this->db->create("users", $data);
    }

    public function updateUser(int $id, string $first_name, string $last_name, string $department) {
        date_default_timezone_set('Asia/Hong_Kong');

        $data = array(
            "first_name" => $first_name,
            "last_name" => $last_name,
            "department" => $department,
            "updated_at" => date("Y-m-d H:i:s")
        );

        return $this->db->update("users", $id, $data);
    }
}