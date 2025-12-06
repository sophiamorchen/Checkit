<?php
require_once "lib/session.php"; // doit contenir session_start() propre
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <!-- On pourait aussi télécharger le fichier sur bootstrap et directement l' "inclure" -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/override-bootstrap.css">


    <title>Checkit</title>
</head>

<body>
    <div class="container">
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
            <div class="col-md-3 mb-2 mb-md-0">
                <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img width="100" src="assets/images/logo-checkit.png" alt="Logo CheckIt">
                </a>
            </div>
            <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
                <li><a href="index.php" class="nav-link px-2 link-secondary">Home</a></li>
                <?php ?>
                <li><a href="mes-listes.php" class="nav-link px-2">Mes listes</a></li>
                <li><a href="#" class="nav-link px-2">Pricing</a></li>
                <li><a href="#" class="nav-link px-2">FAQs</a></li>
                <li><a href="#" class="nav-link px-2">About</a></li>
            </ul>
            <div class="col-md-3 text-end"> 
                <?php if(isset($_SESSION['user'])) {?>
                    <a href="logout.php" class="btn btn-outline-primary me-2">Logout</a> 
                    <?php } else {?>
                    <a href="login.php" class="btn btn-outline-primary me-2">Login</a> 
                    <?php } ?>

            </div>
        </header>
    </div>