<?php

$_SESSION['routes'] = ["index.php", "home", "profile"];

Route::set('index.php', function() {
    HomeController::CreateView('Home');
});

Route::set('home', function() {
    HomeController::CreateView('Home');
});

Route::set('profile', function() {
    ProfileController::index();
    ProfileController::CreateView('Profile');
});