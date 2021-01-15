<?php

class Route {

    public static $validRoutes = array();

    /**
     * Takes in a route name and if
     * it is available run the given function
     */
    public static function set(string $route, object $function) {
        self::$validRoutes[] = $route;

        // print_r(self::$validRoutes); 

        if ($_SERVER['REQUEST_URI'] == $route) {
            unset($_SESSION['error']);
            $function->__invoke();
        }
        elseif (!in_array($_SERVER['REQUEST_URI'], self::$validRoutes)) {
            $_SESSION['error'] = 'page error';
        }
    }
}