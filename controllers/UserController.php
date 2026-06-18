<?php
/**
 * User Controller
 *
 * Handles incoming requests for the Users & Council module.
 * Validates input, calls the repository for data, and sends back a response.
 */
require_once __DIR__ . '/../helpers/response.php';
require_once __DIR__ . '/../repos/UserRepo.php';

/**
 * Returns the full list of users.
 */
function getUserList(){
    $users = getAllUsers();
    response(200, "Users fetched successfully", $users);
}

/**
 * Returns a single user by id.
 *
 * @param int $id The user's id from the request
 */
function getSingleUser($id){
    $user = getUserById($id);
    if(!$user){
        response(404, "User not found");
    }
    response(200, "User fetched successfully", $user);
}

/**
 * Updates a user's name and/or email.
 * Keeps the existing value for any field that wasn't sent.
 *
 * @param int $id The user's id
 * @param array $data Request body, may contain 'name' and/or 'email'
 */
function editUser($id, $data){
    $user = getUserById($id);
    if(!$user){
        response(404, "User not found");
    }
    $name = $data['name'] ?? $user['name'];
    $email = $data['email'] ?? $user['email'];
    updateUser($id, $name, $email);
    response(200, "User updated successfully");
}

/**
 * Soft deletes a user after confirming they exist.
 *
 * @param int $id The user's id
 */
function deleteUser($id){
    $user = getUserById($id);
    if(!$user){
        response(404, "User not found");
    }
    softDeleteUser($id);
    response(200, "User deleted successfully");
}

/**
 * Assigns a title to a user, requires title_id in the request body.
 *
 * @param int $id The user's id
 * @param array $data Request body, must contain 'title_id'
 */
function assignUserTitle($id, $data){
    if(!isset($data['title_id'])){
        response(400, "title_id is required");
    }
    assignTitle($id, $data['title_id']);
    response(200, "Title assigned successfully");
}

/**
 * Returns the profile of the currently logged-in user.
 *
 * Reads the user's id from their verified token instead of the URL,
 * so each user can only ever see their own data.
 */
function getOwnProfile(){
    require_once __DIR__ . '/../helpers/JWT.php';

    $verifiedToken = VerifyToken();

    $user = getUserById($verifiedToken->user_id);

    if(!$user){
        response(404, "User not found");
    }

    response(200, "Profile fetched successfully", $user);
}
?>