<?php

(new DotEnv('./.env'))->load(); // Read .env contents

class LoginController extends Controller {

    public static function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user_found = $user->findUser(0, $email, $password); // 0 because we don't know the user's id

        if ($user_found) {
            $base_url = self::getUrl();
            $_SESSION['auth'] = $user_found;
            echo "<meta http-equiv='refresh' content='0;URL=$base_url'>";
        } 
        else {
            echo '<p style="color: red;"> USER NOT FOUND!<p>';
        }
    }

    public static function logout() {
        $base_url = self::getUrl();
        session_unset();
        $_SESSION['auth'] = 'guest';
        echo "<meta http-equiv='refresh' content='0;URL=$base_url'>";
    }

    public static function getUrl() {
        if($_SERVER['SERVER_PORT'] !== null) {
            return "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . "/home";
        } else {
            return "http://" . $_SERVER['SERVER_NAME'] . "/home";
        }
    }
}