<?php
session_start();
if (isset($_SESSION['login']) && $_SESSION['login']) {
    require_once('../class/db.class.php');
    require_once('../class/distribution.class.php');
    $dbConfig = include '../config/db_config.php';
    $db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
   
    $dist = new Distribution($db);
    $dist->insert(array($_POST['idProd'], $_POST['role'], $_POST['artiste']));
    $db->close();
    // get app config
    $appConfig = include '../config/app_config.php';
    header('Location: '. $appConfig['base_url'] .'main.php');
    exit();
}
