<?php
//Start a new session
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']) {
    require_once('../class/db.class.php');
    require_once('../class/distribution.class.php');
    //get database information from db config file
    $dbConfig = include '../config/db_config.php';
    //connection to database
    $db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
   
    $dist = new Distribution($db);
    //inset distribution new row when click icon add on main IHM
    $dist->insert(array($_POST['idProd'], $_POST['role'], $_POST['artiste']));
    // descrut connection
    //liberate memory space
    $db->close();
    // get app config
    $appConfig = include '../config/app_config.php';
    //rediret to main page
    header('Location: '. $appConfig['base_url'] .'main.php');
    //stop current script
    exit();
}
