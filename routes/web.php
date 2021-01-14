<?php

$id = 0;
if (isset($_GET['item_id'])) {
    $id = $_GET['item_id'];
}

$_SESSION['routes'] = ["/", "/home", "/login", "/signup", "/logout", "/profile", "/store", "/item?item_id=$id"];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    Route::set('/', function() {
        HomeController::index();
        HomeController::CreateView('Home');
    });
    
    Route::set('/home', function() {
        HomeController::index();
        HomeController::CreateView('Home');
    });
    
    Route::set('/login', function() {
        LoginController::CreateView('Login');
    });
    
    Route::set('/signup', function() {
        SignupController::CreateView('Signup');
    });
    
    Route::set('/profile', function() {
        ProfileController::index();
        ProfileController::CreateView('Profile');
    });

    Route::set('/store', function() {
        StoreController::index();
        StoreController::CreateView('Store');
    });

    Route::set("/item?item_id=$id", function() {
        StoreController::getItem();
    });
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    Route::set('/login', function() {
        LoginController::login();
    });

    Route::set('/signup', function() {
        SignupController::signup();
    });

    Route::set('/logout', function() {
        LoginController::logout();
    });
}
