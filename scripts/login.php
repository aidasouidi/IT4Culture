<?php

// get app config
$appConfig = include '../config/app_config.php';
//Start a new session
session_start();
//check admin username and password
if ($appConfig['username'] == $_POST['username'] && $appConfig['password'] == $_POST['password']) {
    // create a session for user
    $_SESSION['username'] = $appConfig['username'];
    $_SESSION['login'] = true;
    // redirect to setup interface
    header('Location: '.$appConfig['base_url'].'setup.php');
    //stop current script
    exit();
} else {
    $_SESSION['error'] = 'Nom d\'utilisateur ou mot de passe erronés';
    $_SESSION['login'] = false;
    // redirect to login page
    header('Location: '.$appConfig['base_url'].'index.php');
    //stop current script
    exit();
}
