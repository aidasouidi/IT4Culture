<?php
session_start();

if(isset($_SESSION['login']) && $_SESSION['login']) {
    session_unset();
    session_destroy();
    // redirect to login page
    header("Location: http://localhost:8084/IT4Culture/index.php");
    exit();
}