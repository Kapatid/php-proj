<?php
    // First file to be run
    ob_start();
    session_start();
    require_once('./app/Classes/Autoloader.php');
    require_once('./public/views/layouts/app.php');