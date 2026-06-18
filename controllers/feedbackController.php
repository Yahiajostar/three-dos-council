<?php
require_once '../connection.php';

require_once '../repos/feedbackRepo.php';

require_once '../helpers/response.php';

function feedbacks(){

    $feedback = getAllFeedbacks();

    response(200, "feedback", $feedback);

}

function feedback_show($id){

    $feedback_show = getFeedbacksById($id);

    if (!$feedback_show){

    response(404, "feedback not found");

    return;

    }

    response(200, "feedback", $feedback_show);
    
    
}

 function feedback_delete($id){
    $feedback_delete = getFeedbackById($id);
    if(!getFeedbacskById($id)){
         response(404,"feedback not found");
    }
    deleteFeedback($id);
    response(200,"feedback deleted");
 }

 function feedback_create($data)
{
    $submission_id = $data['submission_id'] ?? '';
    $comment = $data['comment'] ?? '';
    $rating = $data['rating'] ?? '';

    if(empty($submission_id) || empty($comment) || empty($rating))
    {
        response(400, "missing fields");
        return;
    }

    createFeedback(
        $submission_id,
        $comment,
        $rating
    );

    response(201, "feedback created successfully");
}

function feedback_update($id, $data)
{
    $feedback = getFeedbacksById($id);

    if(!$feedback)
    {
        response(404, "feedback not found");
        return;
    }

    $comment = $data['comment'] ?? '';
    $rating = $data['rating'] ?? '';

    if(empty($comment) || empty($rating))
    {
        response(400, "missing fields");
        return;
    }

    updateFeedback(
        $id,
        $comment,
        $rating
    );

    response(200, "feedback updated successfully");
}