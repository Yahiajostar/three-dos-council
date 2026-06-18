<?php
function empty_validation($data, $fields){
    foreach ($fields as $field){
        if (empty($data[$field])) {
            response(400, "$field is required");
            break;
        }
    }
}

function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        response(400, "Invalid email format");
    }
}