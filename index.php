<?php

//Starts a new session
session_start();

if (isset($_SESSION['login']) && $_SESSION['login']) {
    // get app config
    $appConfig = include '../config/app_config.php';
    // redirect to app
    header('Location: '. $appConfig['base_url'] .'setup.php');
    exit();
}
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
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <div class="logo-container">
                        <img src="assets/img/logo.png" class="img-fluid"/>
                    </div>
                    <div class="app">
                        <span class="line app-name"><i class="fa fa-list-ul" aria-hidden="true"></i> PLANNEL</span>
                        <span class="line app-slogan">Une application de gestion des ressources</span> 
                    </div>
                    <form action="scripts/login.php" method="post">
                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Nom d'utilisateur</label>
                            <input type="text" class="form-control form-control-lg" name="username"/>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Mot de passe</label>
                            <input type="password" class="form-control form-control-lg" name="password"/>
                        </div>

                        <?php if (isset($_SESSION['error']) && isset($_SESSION['login']) && !$_SESSION['login']) { ?>
                        <div class="error">
                            <span><?php echo $_SESSION['error']; ?></span>
                        </div>
                        <?php } ?>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                            style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
