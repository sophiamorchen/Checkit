<?php
require_once "lib/session.php"; // session_start() ici

// régénère l'ID de session pour protéger contre fixation
session_regenerate_id(true);

// vide toutes les variables de session
session_unset();

// détruit la session côté serveur
session_destroy();

// redirection vers login
header("Location: login.php");
exit;
