<?php
require_once "templates/header.php";
require_once "lib/pdo.php";
require_once "lib/user.php";

$errors = [];

// NE PAS mettre session_destroy() ici !
// La session doit rester active pour pouvoir stocker l'utilisateur connecté

if (isset($_POST['loginUser'])) {
    $user = verifyUserLoginPassword($pdo, $_POST['email'], $_POST['password']);

    if ($user) {
        // connecter l'utilisateur -> stocker dans la session
        $_SESSION['user'] = $user;

        // redirection après connexion réussie
        header("Location: index.php"); // ou une page membre
        exit;
    } else {
        // afficher une erreur
        $errors[] = "Email ou mot de passe incorrect";
    }
}

?>

<div class="container col-xxl-8 px-4 py-5">
    <h1>Se connecter</h1>

    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
    <?php } ?>

    <form action="" method="post">
        <div class="mb-3">
            <label for="email" class="form-label">Email : </label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe :</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <!-- le "name" est envoyé lors de la connexion -->
        <input type="submit" name="loginUser" value="connexion" class="btn btn-primary">
    </form>
</div>

<?php
require_once "templates/footer.php";
?>