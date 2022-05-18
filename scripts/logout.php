<?php
session_start();
// get app config
$appConfig = include '../config/app_config.php';
if (isset($_SESSION['login']) && $_SESSION['login']) {
    session_unset();
    session_destroy();
    // redirect to login page
    header('Location: '.$appConfig['base_url'].'index.php');
    exit();
}
