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

function addMaterialRepo($session_id, $content){

    global $connection;

    $query = $connection->prepare(
        "INSERT INTO materials(session_id, content) VALUES(?,?)"
    );
     return $query->execute([
        $session_id,
        $content
     ]);
}

function updateMaterialRepo($id, $content){

    global $connection;
    $query = $connection->prepare(
        "UPDATE materials SET content = ? WHERE id = ?"
    );
    return $query->execute([
        $content,
        $id
    ]);
}
?>
