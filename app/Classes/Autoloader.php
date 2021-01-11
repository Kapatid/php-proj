<?php

/**
 * Check availability of class once user goes to a url
 */
spl_autoload_register(function ($className) {
    if (file_exists("./app/Classes/" . $className . ".php")) {
        require_once "./app/Classes/" . $className . ".php";
    }
    else if (file_exists("./app/Models/" . $className . ".php")){
        require_once "./app/Models/" . $className . ".php";
    }
    else if (file_exists("./app/Controllers/" . $className . ".php")){
        require_once "./app/Controllers/" . $className . ".php";
    }
});