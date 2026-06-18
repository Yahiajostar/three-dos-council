<?php
require_once __DIR__ . '/../helpers/response.php';
//require_once __DIR__ . '/../repos/UserRepo.php';
require_once __DIR__ . '/../repos/user_repo.php';


function getUserList(){
    $users = getAllUsers();
    response(200, "Users fetched successfully", $users);
}

function getSingleUser($id){
    $user = getUserById($id);

    if(!$user){
        response(404, "User not found");
    }

    response(200, "User fetched successfully", $user);
}

function editUser($id, $data){
    $user = getUserById2($id);

    if(!$user){
        response(404, "User not found");
    }

    $name = $data['name'] ?? $user['name'];
    $email = $data['email'] ?? $user['email'];

    updateUser($id, $name, $email);

    response(200, "User updated successfully");
}

function deleteUser($id){
    $user = getUserById($id);

    if(!$user){
        response(404, "User not found");
    }

    softDeleteUser($id);

    response(200, "User deleted successfully");
}

function assignUserTitle($id, $data){
    if(!isset($data['title_id'])){
        response(400, "title_id is required");
    }

    assignTitle($id, $data['title_id']);

    response(200, "Title assigned successfully");
}