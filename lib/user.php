<?php
// Si un fichier ne contient que du php, il n'a pas besoin de balise femrmante php

// 


function verifyUserLoginPassword(PDO $pdo, string $email, string $password):bool|array
{
    // var_dump($email);
    $query = $pdo->prepare("SELECT * FROM user WHERE email = :email");
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->execute();
    // fecth nous permet de récupere une seule ligne
    $user = $query->fetch(PDO::FETCH_ASSOC);
    if($user && password_verify($password, $user['password'])) {
        // verif ok
        return $user;

    } else {
        // email ou mdp incorrect : on retourne false
        return false;
    }

    // var_dump($user);
}