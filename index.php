<?php
    // First file to be run
    session_start();
    ob_start();
    require_once('./app/Classes/Autoloader.php');
    require_once('./public/views/layouts/app.php');