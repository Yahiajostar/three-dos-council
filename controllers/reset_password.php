<?php
require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/validation.php';
require_once '../repos/user_repo.php'; 
require_once '../redis_connection.php';

//$redis = new Predis\Client();
function resetPassword($data){
    global $redis;
    empty_validation($data, ['email', 'otp', 'new_password']);
    $email = $data['email'];
    $userOtp = $data['otp'];
    $newPassword = $data['new_password'];
    validateEmail($email);
    $redisKey = "otp:" . $email;
    $savedOtp = $redis->get($redisKey);
    
    if (!$savedOtp) {
        response(400, "OTP has expired or invalid");
    }
    
    if ($userOtp != $savedOtp) {
        response(400, "Incorrect OTP code");
    }
    $isUpdated = UpdatePassByEmail($email, $newPassword);
    
    if ($isUpdated) {
        $redis->del($redisKey);
        
        response(200, "reset pass successfully");
    } else {
        response(500, "Error in reseting pass");
    }
}
