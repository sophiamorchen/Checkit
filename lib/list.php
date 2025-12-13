<?php

function getListsByUserId(PDO $pdo, int $userId): array
{
    $sql = "SELECT list.*, category.name as category_name, 
    category.icon as category_icon 
    FROM list
    JOIN category ON category.id = list.category_id 
    WHERE user_id = :user_id
    ORDER BY list.id DESC";


    $query = $pdo->prepare($sql);
    $query->bindValue(':user_id', $userId, PDO::PARAM_INT);

    $query->execute();
    $lists = $query->fetchAll(PDO::FETCH_ASSOC);

    return $lists;
}


function getListById(PDO $pdo, $id):array|bool
{
    $query = $pdo->prepare("SELECT * from `list` WHERE id = :id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
    $query->execute();

    return $query->fetch(PDO::FETCH_ASSOC);

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
        $query = $pdo->prepare("UPDATE `list` 
                                SET title = :title, user_id = :user_id, category_id = :category_id
                                WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        

    } else {
        // INSERT
        $query = $pdo->prepare('INSERT INTO list (title, user_id, category_id)
                                VALUES(:title, :user_id, :category_id)');
    }
    $query->bindValue(':title', $title, PDO::PARAM_STR);
    $query->bindValue(':user_id', $userId, PDO::PARAM_INT);
    $query->bindValue(':category_id', $categoryId, PDO::PARAM_INT);

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

function saveListItem(PDO $pdo, string $name, int $list_id, bool $status = false, ?int $id = null):bool
{
    if ($id) {
        // UPDATE
        $query = $pdo->prepare("UPDATE `item` 
                                SET name = :name, list_id = :list_id, status = :status
                                WHERE id = :id");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
    } else {
        // INSERT
        $query = $pdo->prepare('INSERT INTO `item` (name, list_id, status)
                                VALUES(:name, :list_id, :status)');
    }
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':list_id', $list_id, PDO::PARAM_INT);
    $query->bindValue(':status', $status, PDO::PARAM_BOOL);

    return $query->execute();

}