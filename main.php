<?php

session_start();
if(!isset($_SESSION['login']) || !$_SESSION['login']) {
    // redirect to login page
    header("Location: http://localhost:8084/IT4Culture/index.php");
    exit();
}

if (!isset($_SESSION['db_setup_ok']) || !$_SESSION['db_setup_ok']) {
    header("Location: http://localhost:8084/IT4Culture/setup.php");
    exit();
}

require_once('class/db.class.php');
require_once('class/production.class.php');

//get DB config 
$dbConfig = include 'config/db_config.php';
$db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);
$prds = new Production($db);
$prodList = $prds->getAll();

?>
<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>

<body>
    <header id="header">
        <div class="d-flex flex-column">
            <div class="logo-container">
                <img src="assets/img/logo.png" class="img-fluid"/>
            </div>
            <div class="sidebar-content">
                <h5>PRODUCTIONS</h5>
                <select id="productions" onchange="getDetails()">
                    <option value="">...</option>
                    <?php
                        foreach ($prodList as $prd) {
                            echo '<option value="'.$prd['id'].'">'.$prd['intitule'].'</option>';
                        }
                    ?>
                </select>
            </div>
            <div class="logout">
                <form action="scripts/logout.php" method="post">
                    <button type="submit" class="btn btn-danger btn-lg"
                    style="padding-left: 2.5rem; padding-right: 2.5rem;"> <i class="fa fa-sign-out" aria-hidden="true"></i> Déconnexion</button>
                </form>
            </div>
        </div>
    </header>
    <main id="main">
        <div class="container">
            <div class="app">
                <span class="line app-name"><i class="fa fa-list-ul" aria-hidden="true"></i> PLANNEL</span>
                <span class="line app-slogan">Une application de gestion des ressources</span> 
            </div>
            <div id="content" class="content" style="margin-top:50px">
                <?php
                    if(!isset($_SESSION['selectedProd']) || !$_SESSION['selectedProd']) {
                        echo '<div class="alert alert-info" role="alert">
                        Veuillez choisir une production !</div>';
                    }
                ?>
            </div>
        </div>
    </main>
</body>
<script>
function getDetails() {
    var d = document.getElementById("productions").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("content").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("POST", "scripts/productions.php", true);
    xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')
    xmlhttp.send("idProd=" + d);
}
function showForm() {
    var x = document.getElementById("distForm");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}
</script>
</html>