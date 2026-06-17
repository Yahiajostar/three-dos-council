<?php

require_once "../connection.php";
require_once "../helpers/response.php";
require_once "../repos/sessions.php";

//GET ALL SESSIONS
function getAllSessions()
{
    global $connection;
    try {

        $stmt = $connection->prepare(
            "SELECT * FROM sessions"
        );

        $stmt->execute();

        $sessions = $stmt->fetchAll(PDO::FETCH_ASSOC);

        response(
            200,
            "Sessions Retrieved Successfully",
            $sessions
        );

    } catch(PDOException $e){

        response(
            500,
            $e->getMessage()
        );
    }
}


//GET Session by id
function getSessionById($id)
{
    $session = getSessionByIdRepo($id);

    if(!$session)
    {
        response(
            404,
            "Session Not Found"
        );
        return;
    }

    response(
        200,
        "Session Retrieved Successfully",
    );
}

//delete session

function deleteSession($id)
{
    $session = getSessionByIdRepo($id);

    if(!$session)
    {
        response(
            404,
            "Session Not Found"
        );
        return;
    }

    deleteSessionRepo($id);

    response(
        200,
        "Session Deleted Successfully"
    );
}