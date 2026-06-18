<?php
require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/JWT.php'; 
require_once '../repos/user_repo.php';
require_once '../helpers/validation.php';

function signup($data){
    $name     = $data['name'] ?? '';
    $email    = $data['email'] ?? '';
    $password = $data['password'] ?? '';
    $role = !empty($data['role']) ? $data['role'] : 'delegates';
    $council_id = $data['council_id'] ?? null;
    validateEmail($data['email']);

     empty_validation($data , ['name','email' , 'password']);


      if (getUserByEmail($email)) {
        response(400, "User already exists");
    }

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $isCreated = createUser($name, $email, $hashedPassword, $role , $council_id);
    if ($isCreated) {
        response(201, "User registered successfully");
    } else {
        response(500, "Something went wrong while creating the user");
    }
}

