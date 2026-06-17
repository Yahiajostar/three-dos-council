
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