<?php

(new DotEnv('./.env'))->load(); // Read .env contents

class LoginController extends Controller {

    public static function login() {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = new User();
        $user_found = $user->findUser(0, $email, $password); // 0 because we don't know the user's id

        if ($user_found) {
            $_SESSION['auth'] = $user_found;
            parent::goToPage("/home");
        } 
        else {
            echo '<p style="color: red; margin-top:200px"> USER NOT FOUND!<p>';
            //parent::goToPage("/login");
        }
    }

    public static function logout() {
        session_unset();
        $_SESSION['auth'] = 'guest';
        parent::goToPage("/home");
    }
}