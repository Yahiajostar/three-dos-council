<?php

function getSessionByIdRepo($id)
{
    global $connection;

    $query = $connection->prepare(
        "SELECT * FROM sessions WHERE id = ?"
    );

    $query->execute([$id]);

    return $query->fetch(PDO::FETCH_ASSOC);
}

function deleteSessionRepo($id)
{
    global $connection;

    $query = $connection->prepare(
        "DELETE FROM sessions WHERE id = ?"
    );

    return $query->execute([$id]);
}

function addSessionRepo($title, $session_date, $council_id){
    global $connection;
    $query = $connection->prepare(
        "INSERT INTO sessions (title, session_date, council_id) VALUES(?,?,?)"
    );
    return $query->execute([
        $title,
        $session_date,
        $council_id
    ]);
}

function updateSessionRepo($id, $title, $session_date, $council_id){
    global $connection;
    $query = $connection->prepare(
         "UPDATE sessions SET 
         title = ?,
        session_date = ?,
        council_id = ?
        WHERE id = ?"
    );
    return $query->execute([
        $title,
        $session_date,
        $council_id,
        $id
    ]);
}
?>
