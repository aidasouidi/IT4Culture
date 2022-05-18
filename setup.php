<?php

//Starts a new session
session_start();

// redirect to login page if user not logged
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("Location: http://localhost:8084/IT4Culture/index.php");
    exit();
}

require_once('class/db.class.php');

//get DB config
$dbConfig = include 'config/db_config.php';
$db = new db($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['database']);

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
            <div class="content" style="margin-top:50px">
                <h3>Installation</h3>
                <?php
                    if ($db->isConnected) {
                        echo '<span>Vérfication de connexion à la base de données ...';
                        echo '<div class="alert alert-success" role="alert">
                        Connexion réussite à la base de données : ' . $dbConfig['database'] . '</div>';

                        echo '<span>Vérfication des tables ...';
                        $error = false;
                        foreach ($dbConfig['tables'] as $table) {
                            // check table existence
                            if ($db->tableExists($table)) {
                                echo '<div class="alert alert-success" role="alert">
                                Table : ' . $table . ' existe et installée </div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">
                                Table : ' . $table . ' n\'existe pas </div>';
                                $error = true;
                            }
                        }

                        if ($error) {
                            echo '<button id="reinstall" type="button" class="btn btn-primary" onclick="reinstallDb()">Réinstallation</button>';
                        } else {
                            $_SESSION['db_setup_ok'] = true;
                            echo '<a href="./main.php"><button type="button" class="btn btn-success">OK</button></a>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">
                        Connexion echouée à la base de données : ' . $dbConfig['database'] . '</div>';
                    }
                ?>
            </div>
        </div>
    </main>
</body>
<script>
function reinstallDb() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        alert('Base de données réinstallée avec succée');
        location.reload();
      }
    };
    xmlhttp.open("POST", "scripts/dump.php", true);
    xmlhttp.send();
}
</script>
</html>