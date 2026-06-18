<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/validation.php';
require_once '../repos/user_repo.php';
require_once '../redis_connection.php';
require_once '../helpers/send_mail.php';
//$redis = new Predis\Client();
function forget_password($data){
    global $redis ;
    empty_validation($data ,['email']);
    $email = $data['email'];
    validateEmail($email);
    $user = getID_byEmail($email);
    if(!$user){
        response(404, "Email not found");
    }
    $otp = rand(100000, 999999);
    $redisKey = "otp:" . $email;
    $redis->setex($redisKey, 300, $otp);
    sendMailOTP($email, $otp); 

    response(200, "OTP generated and sent successfully", [
        "otp" => $otp
    ]);
}