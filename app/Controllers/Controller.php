<?php

class Controller{

    /**
     * Inserts a page to view
     * 
     */
    public static function CreateView(string $viewName) {

        if (file_exists("./public/views/" . $viewName . ".php")) {
            require_once "./public/views/" . $viewName . ".php";
        }
        elseif (file_exists("./public/views/auth/" . $viewName . ".php")) {
            require_once "./public/views/auth/" . $viewName . ".php";
        }
        elseif (file_exists("./public/views/layouts/" . $viewName . ".php")){
            require_once "./public/views/layouts/" . $viewName . ".php";
        }
    }

    /**
     * Authenticate current visitor
     * 
     */
    public static function authPage(string $sessionName, string $sessionData) {
        
        if (isset($_SESSION[$sessionName])) {
            if ($_SESSION[$sessionName] === $sessionData) {
                unset($_SESSION['error']);
                return true;
            }
            else {
                $_SESSION['error'] = 'page error';
                return false;
            }
        }
        else {
            return false;
        }
    }
}