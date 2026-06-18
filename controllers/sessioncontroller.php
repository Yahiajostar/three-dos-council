<?php
require_once "../helpers/JWT.php";
require_once "../connection.php";
require_once "../helpers/response.php";
require_once "../repos/sessions.php";

//GET ALL SESSIONS
function getAllSessions()
{
 
    VerifyToken();
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
  
    VerifyToken();
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
        $session
    );
}

//delete session

function deleteSession($id)
{
    $verifiedToken = VerifyToken();
    require_admin($verifiedToken);

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

//add session

function addSession(){
    $data = json_decode(
        file_get_contents("php://input"),
        true
    );
    addSessionRepo(
        $data["title"],
        $data["session_date"],
        $data["council_id"]
    );
    response(
        201,
        "Session Added Successfully"
    );
}

//Edit sessions

function updateSession($id){
    $session = getSessionByIdRepo($id);
    if(!$session){
        response(
            404,
            "Session Not Found"
        );
        return;
    }
        $data = json_decode(
        file_get_contents("php://input"),
        true
    );
    updateSessionRepo(
        $id,
        $data["title"],
        $data["session_date"],
        $data["council_id"]
    );
        response(
        200,
        "Session Updated Successfully"
    );
}
?>
