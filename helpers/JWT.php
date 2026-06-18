<?php
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

$headers = getallheaders();
$token = $headers['Authorization'] ?? $headers['authorization'] ?? '';

if(!$token){
 response(401,"token is requird ");
}
$token = str_replace("Bearer " ,"",$token);

try{
$decoded = JWT::decode($token , new Key("B0RN0Jx6muUoyGJGmahlRiQJ6mpNXEDQShyHT8bCbYp" , "HS256"));

return $decoded;
}catch(Exception $e){
    response(401 , "invalid token");
}
}

function require_admin($verifedToken){
    if($verifedToken->role !== "admin"){
        response(403,"access denied admin");
    }
}