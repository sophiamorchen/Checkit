<?php
require_once 'templates/header.php';
require_once 'lib/pdo.php';
require_once 'lib/list.php';

if (isset($_SESSION['user'])) {
    $lists = getListsByUserId($pdo, $_SESSION['user']['id']);
}

?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Mes listes</h1>
        <a href="ajout-modif-liste.php" class="btn btn-primary">Ajouter une liste</a>
    </div>


    <div class="row">
        <?php if (isset($_SESSION['user'])) { ?>
            <?php if ($lists) { ?>
                <?php foreach ($lists as $list) { ?>
                    <div class="col-md-4 my-2">
                        <div class="card w-100">
                            <div class="card-header d-flex align-items-center justify-content-evenly">
                                <i class="bi bi-card-checklist"></i>
                                <h3 class="card-title"><?php echo $list['title']; ?></h3>
                            </div>
                            <div class="card-body d-flex justify-content-between align-items-end">
                                <a href="#" class="btn btn-primary">Voir la liste</a>
                                <div>
                                    <span class="badge rounded-pill text-bg-primary">
                                        <i class="bi <?php echo $list['category_icon']; ?>"></i>
                                        <?php echo $list['category_name']; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <p>Pas de liste.</p>
            <?php } ?>
        <?php } else { ?>
            <p>Pour consulter vos listes, vous devez être connecté.</p>
            <a href="login.php" class="btn btn-outline-primary me-2">Login</a>
        <?php } ?>
    </div>
</div>

<?php
require_once 'templates/footer.php';
?>