<?php

function getListsByUserId(PDO $pdo, int $userId): array
{
    $sql = "SELECT list.*, category.name as category_name, 
    category.icon as category_icon 
    FROM list
    JOIN category ON category.id = list.category_id 
    WHERE user_id = :user_id";


    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id', $userId, PDO::PARAM_INT);

    $query->execute();
    $lists = $query->fetchAll(PDO::FETCH_ASSOC);

    return $lists;
}

/**
 * Nullable : function testNullable(?int $id) {}
 * Optionnel : function testOptionnel(int $id = 0) {}
 * Nullable : function testBoth(?int $id = null) {}
 */

function saveList(PDO $pdo, string $title, int $userId, int $categoryId, ?int $id = null): int|bool
{
    if ($id) {
        // UPDATE
        $query = $pdo->prepare('UPDATE list 
                                SET title = :title, userId = :userId, categoryId = :categoryId 
                                WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    } else {
        // INSERT
        $query = $pdo->prepare('INSERT INTO list (title, userId, categoryId)
                                VALUES(:title, :userId, :categoryId)');
    }
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':userId', $userId, PDO::PARAM_INT);
    $query->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);

    $res = $query->execute();

    if ($res) {
        if ($id) {
            // pour le UPDATE → on renvoie l'id existant
            return $id;
        } else {
            // pour le INSERT → on récupère l'id du nouvel enregistrement
            return $pdo->lastInsertId();
        }
    } else {
        return false;
    }
}
