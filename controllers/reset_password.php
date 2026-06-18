<?php


/**
 * Reset Password Controller
 * * Handles the final phase of password recovery.
 * Validates the user-submitted OTP against the cached Redis value 
 * and overrides the previous database secret credential record.
 */


require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once '../connection.php';
require_once '../helpers/response.php';
require_once '../helpers/validation.php';
require_once '../repos/user_repo.php'; 
require_once '../redis_connection.php';

//$redis = new Predis\Client();
function resetPassword($data){
    
    global $redis;
    // Run validation safeguards
    empty_validation($data, ['email', 'otp', 'new_password']);
    $email = $data['email'];
    $userOtp = $data['otp'];
    $newPassword = $data['new_password'];
    validateEmail($email);
    // Fetch stored OTP verification token value from cache store
    $redisKey = "otp:" . $email;
    $savedOtp = $redis->get($redisKey);
    // Validate existence window constraints
    if (!$savedOtp) {
        response(400, "OTP has expired or invalid");
    }
    
    if ($userOtp != $savedOtp) {
        response(400, "Incorrect OTP code");
    }
    // Overwrite old password entry 
    $isUpdated = UpdatePassByEmail($email, $newPassword);
    
    if ($isUpdated) {
        // Enforce cleanup logic by deleting the consumed single-use OTP key
        $redis->del($redisKey);
        
        response(200, "reset pass successfully");
    } else {
        response(500, "Error in reseting pass");
    }
}
