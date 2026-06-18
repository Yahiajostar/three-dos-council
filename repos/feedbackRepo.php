<?php

require_once '../connection.php';

function getAllFeedbacks () {

    global $connection;

    $statment = $connection->prepare("SELECT * FROM feedback");

    $statment->execute();

    return $feedback = $statment->fetchAll();
}

function getFeedbacksById($id){

    global $connection;

    $statment = $connection->prepare("select *FROM feedback WHERE feedback_id = :id");

    $statment->execute(['id'=>$id]);

    return $feedback = $statment->fetch(); 
}

function createFeedback($submission_id, $comment, $rating)
{
    global $connection;

    $statement = $connection->prepare(
        "INSERT INTO feedback
        (submission_id, comment, rating, is_deleted)
        VALUES
        (:submission_id, :comment, :rating, 0)"
    );

    $statement->execute([
        'submission_id' => $submission_id,
        'comment' => $comment,
        'rating' => $rating
    ]);
}

function updateFeedback($id, $comment, $rating)
{
    global $connection;

    $statement = $connection->prepare(
        "UPDATE feedback
        SET comment = :comment,
            rating = :rating
        WHERE feedback_id = :id"
    );

    $statement->execute([
        'id' => $id,
        'comment' => $comment,
        'rating' => $rating
    ]);
}

function deleteFeedback($id){

 global $connection;

 $statement = $connection->prepare(
    "UPDATE feedback
    set is_deleted = 1
     WHERE feedback_id = :id"
     );

  $statement->execute(['id' => $id]);


}