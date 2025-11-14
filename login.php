<?php
// __DIR__ = le dossier où se trouve le fichier PHP dans lequel cette ligne est écrite.
require_once "templates/header.php";
?>

    <div class="container col-xxl-8 px-4 py-5">
        <h1>Se connecter</h1>

        <form action="" method="get">
            <div class="mb-3">
                <label for="email" class="form-label">Email : </label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot  de passe :</label>
                <input type="password" for="password" id="password" class="form-control">
            </div>

            <!-- le "name" est envoyé lors de la connexion -->
            <input type="submit" name="loginUser" value="connexion" class="btn btn-primary">
            <?php  var_dump($_GET); echo "get";?>

        </form>
    </div>

<?php
require_once "templates/footer.php";
?>