<?php


/**
 * JSON Web Token (JWT) Security Helper
 * * Implements stateless authentication and Role-Based Access Control (RBAC).
 * Encodes authenticated user sessions into signed tokens, intercepts incoming API requests 
 * to verify claims, and acts as a gateway middleware to guard sensitive admin routes.
 */


require '../vendor/autoload.php';
require_once '../helpers/response.php';
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
//require_once 'vendor/autoload.php';

function GenerateToken($user){
   
$payload=[
"iat" => time(),
"exp" => time()+3600,
"user_id" => $user['id'],
"role" => $user['role']
];

return JWT::encode($payload,"B0RN0Jx6muUoyGJGmahlRiQJ6mpNXEDQShyHT8bCbYp","HS256");

}

function VerifyToken(){
// Abstract extraction logic to safely handle inconsistent HTTP client header naming cases
$headers = getallheaders();
$token = $headers['Authorization'] ?? $headers['authorization'] ?? '';

if(!$token){
 response(401,"token is requird ");
}

// Isolate the pure Base64 cryptographic string by stripping out the standard 'Bearer ' prefix
$token = str_replace("Bearer " ,"",$token);

try{
    // Authenticate request integrity against secret signature keys
$decoded = JWT::decode($token , new Key("B0RN0Jx6muUoyGJGmahlRiQJ6mpNXEDQShyHT8bCbYp" , "HS256"));

return $decoded;
}catch(Exception $e){
    response(401 , "invalid token");
}
}

function require_admin($verifedToken){
    // role authorization
    if($verifedToken->role !== "admin"){
        response(403,"access denied admin");
    }
}