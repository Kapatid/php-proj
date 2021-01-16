<?php

$id = 0;
if (isset($_GET['item_id'])) {
    $id = $_GET['item_id'];
}


function universalRoutes() {
    /**
     * Route::set() takes in the uri request
     * If it is successful run the function
     * 
     */
    Route::set('/', function() {
        HomeController::index(); // Some function inside the given controller
        HomeController::CreateView('Home'); // CreateView takes in the filename of a page
    });
    
    Route::set('/home', function() {
        HomeController::index();
        HomeController::CreateView('Home');
    });
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    // Run authPage to prevent guest and user from accessing certain pages
    if (Controller::authPage('auth', 'guest')) {
        universalRoutes();

        Route::set('/login', function() {
            LoginController::CreateView('Login');
        });
        
        Route::set('/signup', function() {
            SignupController::CreateView('Signup');
        });

        if (isset($_SESSION['error'])) {
            Controller::CreateView('error');
            exit;
        }
    }
    
    if (!Controller::authPage('auth', 'guest')) {
        universalRoutes();

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

        if (isset($_SESSION['error'])) {
            Controller::CreateView('error');
            exit;
        }
    }
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

    Route::set("/purchase", function() {
        StoreController::newReciept();
    });

    Route::set("/purchase-delete", function() {
        ProfileController::deleteReceipt();
    });
}