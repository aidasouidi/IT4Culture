<?php
// get app config
session_start();
// get app config
$appConfig = include '../config/app_config.php';
if (isset($_SESSION['login']) && $_SESSION['login']) {
    // destruct all sessions variables
    session_unset();
    // destruct session
    session_destroy();
    // redirect to login page
    header('Location: '.$appConfig['base_url'].'index.php');
    //stop current script
    exit();
}