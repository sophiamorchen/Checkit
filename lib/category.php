<?php

function getCategories(PDO $pdo):array
{
    $query = $pdo->prepare('SELECT * FROM CATEGORY');
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

?>