<?php

// get app config
$appConfig = include '../config/app_config.php';

session_start();

//check admin username and password
if ($appConfig['username'] == $_POST['username'] && $appConfig['password'] == $_POST['password']) {
    // create a session for user
    $_SESSION['username'] = $appConfig['username'];
    $_SESSION['login'] = true;
    // redirect to app
    header("Location: http://localhost:8084/IT4Culture/setup.php");
    exit();
} else {
    $_SESSION['error'] = 'Nom d\'utilisateur ou mot de passe erronés';
    $_SESSION['login'] = false;
    header("Location: http://localhost:8084/IT4Culture/index.php");
    exit();
}
