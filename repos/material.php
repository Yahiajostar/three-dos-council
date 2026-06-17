<?php

require_once "../connection.php";

function getAllMaterialsRepo()
{
    global $connection;

    $query = $connection->prepare(
        "SELECT * FROM materials WHERE is_deleted = 0"
    );

    $query->execute();

    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function deleteMaterialRepo($id)
{
    global $connection;

    $query = $connection->prepare(
        "UPDATE materials
         SET is_deleted = 1
         WHERE id = ?"
    );

    return $query->execute([$id]);
}

function getMaterialByIdRepo($id)
{
    global $connection;

    $query = $connection->prepare(
        "SELECT * FROM materials
         WHERE id = ?"
    );

    $query->execute([$id]);

    return $query->fetch(PDO::FETCH_ASSOC);
}