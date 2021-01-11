<?php

class Controller{

    public static function CreateView($viewName) {

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
}