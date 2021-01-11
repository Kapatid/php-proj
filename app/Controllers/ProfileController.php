<?php

class ProfileController extends Controller{
    
    public static function index() {
        $users = new Users();

        // foreach($users->getUsers() as $user) {
        //     print_r($user['first_name'] . " " . $user['last_name'] . "<br>"); // Print
        // }
        
        $_SESSION['users'] = $users->getUsers();
    }
}