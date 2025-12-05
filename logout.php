<?php
require_once "lib/session.php"; // session_start() ici

// régénère l'ID de session pour protéger contre fixation, optionnel ici car juste après, on unset et on destroy
session_regenerate_id(true);

// détruit la session côté serveur
session_destroy();

// vide toutes les variables de session
unset($_SESSION);
// ou bien : $_SESSION = [];


// redirection vers login
header("Location: login.php");
exit;
