<?php

class ProfileController extends Controller{
    
    public static function index() {
        $users = new User();

        // foreach($users->getUsers() as $user) {
        //     print_r($user['first_name'] . " " . $user['last_name'] . "<br>"); // Print
        // }
    }
}