<?php
/**
 * Forget Password Controller
 * * Handles the initial phase of the password recovery process.
 * Validates the email, generates a secure 6-digit OTP, stores it in Redis 
 * with a TTL expiration, and dispatches the OTP via email.
 */


require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/validation.php';
require_once '../repos/user_repo.php';
require_once '../redis_connection.php';
require_once '../helpers/send_mail.php';
//$redis = new Predis\Client();

function forget_password($data){
    global $redis;
    
    // Validate request inputs
    empty_validation($data ,['email']);
    $email = $data['email'];
    validateEmail($email);
    
    // Verify user presence in Database
    $user = getID_byEmail($email);
    if(!$user){
        response(404, "Email not found");
    }
    
    // Generate a secure 6-digit verification code
    $otp = rand(100000, 999999);
    $redisKey = "otp:" . $email;
    
    // Cache OTP in Redis with a 5-minute (300 seconds) expiration safety window
    $redis->setex($redisKey, 300, $otp);
    
    // sending mail with the otp
    sendMailOTP($email, $otp); 

    response(200, "OTP generated and sent successfully", [
        "otp" => $otp
    ]);
}