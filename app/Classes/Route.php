<?php

class Route {

    public static $validRoutes = array();

    public static function set($route, $function) {
        self::$validRoutes[] = $route;

        // print_r(self::$validRoutes); 

        if ($_SERVER['REQUEST_URI'] == $route) {
            $function->__invoke();
        }
        elseif (!in_array($_SERVER['REQUEST_URI'], $_SESSION['routes'])) {
            echo "PAGE NOT FOUND";
            exit;
        }
    }
}