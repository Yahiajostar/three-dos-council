<?php

/**
 * Data Validation Helper Functions
 * * Contains generic, reusable validation rules to sanitize and verify
 * incoming API client request payloads before processing them in controllers.
 */

// checking empty input
function empty_validation($data, $fields){
    foreach ($fields as $field){
        if (empty($data[$field])) {
            response(400, "$field is required");
            break;
        }
    }
}
// cehcking if email format is good
function validateEmail($email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        response(400, "Invalid email format");
    }
}