<?php 
// ATTENTION NE PAS UTILISER CE CODE EN PRODUCTION
// N'EST PAS SECURISE CONTRE LES INJECTIONS SQL

$pdo = new PDO('mysql:dbname=studi_checkit;host=localhost;charset=utf8mb4', 'root', '');
$id = $_GET['id'];
var_dump($id);

// Avec 'single quotes', PHP n’interprète pas les variables 
// → $id reste du texte → la requête est incorrecte.
// Avec "double quotes", PHP interprète $id 
// → la requête fonctionne, mais elle est non sécurisée.
$query = $pdo->query("SELECT * FROM user WHERE id = $id");





$result = $query->fetch(PDO::FETCH_ASSOC);
