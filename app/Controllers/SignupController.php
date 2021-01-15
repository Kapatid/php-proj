<?php

class SignupController extends Controller {
    
    public static function signup() {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $users = new User();
        $users->setUser($first_name, $last_name, $email, password_hash($password, PASSWORD_ARGON2ID));

        require_once "./public/views/home.php";
    }
}