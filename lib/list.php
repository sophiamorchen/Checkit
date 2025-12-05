<?php


function getListsByUserId(PDO $pdo, int $userId): array
{
    // var_dump($email);
    $query = $pdo->prepare("SELECT list.*, 
                            GROUP_CONCAT(category.name SEPARATOR ', ') AS category_name, 
                            GROUP_CONCAT(category.icon SEPARATOR ', ') AS category_icon
                            FROM list
                            JOIN category ON category.id = list.category_id
                            WHERE user_id = :user_id
                            GROUP BY list.id");
    $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $query->execute();

    $lists = $query->fetchAll(PDO::FETCH_ASSOC);
    return $lists;
}
