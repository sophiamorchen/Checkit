<?php

require_once 'templates/header.php';
require_once 'lib/pdo.php';
require_once 'lib/list.php';
require_once 'lib/category.php';

if (!isUserConnected()) {
    header('Location: login.php');
}

$categories = getCategories($pdo);

$errorsList = [];
$errorsListItem = [];
$messagesList = [];


$list = [
    'title' => '',
    'category_id' => '',

];


// Si le formulaire d'ajout-modif de liste a été envoyé
if (isset($_POST['saveList'])) {
    $id = null;
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }
    if (!empty($_POST['title'])) {
        $res = saveList($pdo, $_POST['title'], (int)$_SESSION['user']['id'], $_POST['category_id'], $id);
        if ($res) {
            if ($id) {
                $messagesList[] = "Votre modification a bien été enregistrée.";
            } else {
                header('Location: ajout-modif-liste.php?id=' . $res);
            }
        } else {
            $errorsList[] = "La liste n'a pas été enregistrée.";
        }
    } else {
        $errorsList[] = "Le titre est obligatoire";
    }
}
$editMode = false;
if (isset($_GET['id'])) {
    $list = getListById($pdo, (int)$_GET['id']);
    $editMode = true;
}

if (isset($_POST['saveItem'])) {
    if(!empty($_POST['name'])){
        // sauvegarder
        $res = saveListItem($pdo, $_POST['name'], (int)$_GET['id'], false);
    } else {
        // erreur
        $errorsListItem[] = "Le nom de l'item est obligatoire";
    }

}




?>





<div class="container col-xxl-8">
    <h1>Liste</h1>
    <?php foreach ($errorsList as $error) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
    <?php } ?>
    <?php foreach ($messagesList as $message) { ?>
        <div class="alert alert-success">
            <?= $message ?>
        </div>
    <?php } ?>
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <!-- ici, nous avons mis trois ternaires selon si l'id est dans l'URL: 
                1er : collapsed ou rien du tout dans la CLASSE BOOTSTRAP du button
                2nd : aria-expanded sur "false" si id dans l'URL, true sinon
                3eme : dans la div après le h2 : si PAS d'ID => rien, si ID => "show")
                -->
                <button class="accordion-button <?= ($editMode) ? 'collapsed' :  '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="<?= ($editMode) ? 'false' :  'true' ?>" aria-controls="collapseOne">
                    <!-- isset($_GET) => dit si un id est présent dans l'url -->
                    <?= ($editMode) ? $list['title'] :  'Ajouter une liste' ?>
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse <?= (isset($_GET['id'])) ? '' :  'show' ?>" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre</label>
                            <input type="text" value="<?= $list['title']; ?>" name="title" id="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Catégorie</label>
                            <select name="category_id" id="category_id" class="form-control">categorie 1
                                <?php foreach ($categories as $category) { ?>
                                    <option
                                        <?= ($category['id'] === $list['category_id']) ? 'selected = "selected"' : '' ?>
                                        value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="submit" value="enregistrer" name="saveList" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <?php if (!$editMode) { ?>
            <div class="alert alert-warning">
                Après avoir enregistré, vous pourrez ajouter des items.
            </div>
        <?php } else { ?>
            <h2 class="border-top pt-3">Items</h2>
            <?php foreach ($errorsListItem as $error) { ?>
        <div class="alert alert-danger">
            <?= $error ?>
        </div>
        <?php } ?>
            <form method="post" class="d-flex">
                    <!-- 
                    Checkbox pour un item :
                    - name="status" : identifie le champ côté serveur (dans $_POST['status'])
                    - value="1" (à ajouter) : c'est la valeur qui sera envoyée si la checkbox est cochée
                    - Si la checkbox n'est pas cochée, PHP ne reçoit rien pour ce name, donc on doit gérer par défaut
                    avec quelque chose comme : $status = isset($_POST['status']) ? 1 : 0;
                    - id et label servent juste à rendre le clic sur le texte possible
                -->
                    <input type="checkbox" name="status" id="status">
                    <input type="text" name="name" id="name" placeholder="Ajouter un item" class="form-control mx-3">
                    <input type="submit" name="saveItem" class="btn btn-primary" value="Enregistrer">
                    
            </form>
        <?php } ?>
    </div>
</div>

<?php
require_once "templates/footer.php";
?>