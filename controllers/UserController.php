<?php
require_once __DIR__ . '/../helper/response.php';
require_once __DIR__ . '/../repos/UserRepo.php';

function getUserList(){
    $users = getAllUsers();
    response(200, "Users fetched successfully", $users);
}

function getSingleUser($id){
    $user = getUserById($id);

    if(!$user){
        response(404, "User not found");
        return;
    }

    response(200, "User fetched successfully", $user);
}

function editUser($id, $data){
    $user = getUserById($id);

    if(!$user){
        response(404, "User not found");
        return;
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
        return;
    }

    softDeleteUser($id);

    response(200, "User deleted successfully");
}

function assignUserTitle($userId, $data){
    $user = getUserById($userId);

    if(!$user){
        response(404, "User not found");
        return;
    }

    $titleId = $data['title_id'] ?? null;

    if(!$titleId){
        response(400, "Title ID is required");
        return;
    }

    assignTitle($userId, $titleId);

    response(200, "Title assigned successfully");
}
?>