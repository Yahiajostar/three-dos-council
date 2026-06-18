<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__) . '/vendor/autoload.php';

function sendMailOTP($email, $otp){
    $mail = new PHPMailer(true);

    try {
        // SMTP Server configuration environment setup
        $mail->isSMTP();
//         $mail->SMTPDebug = 2;
// $mail->Debugoutput = 'html';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yahiadiaa1010@gmail.com'; 
        //$mail->Password   = 'etqf tbpe anwo icck';   
        $mail->Password   = 'xvfv uecm thaa abvr';    // App-specific security password credential

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        // Identity Metadata Assignment
        $mail->setFrom('yahiadiaa1010@gmail.com', '3dos_councils (2)');
        $mail->addAddress($email); 
// Email Body Payload definitions
        $mail->isHTML(true);
        $mail->Subject = 'OTP Verification';
        $mail->Body    = "Your OTP code is: " . $otp;

        $mail->send();
       // return true;
        
    }// catch (Exception $e) {
    //     echo "Mail Error: " . $mail->ErrorInfo;
    // }
    catch (Exception $e) {
        header('Content-Type: application/json');
        http_response_code(500);

        echo json_encode([
           // "status" => 500,
            "message" => $e
           // "error" => $mail->ErrorInfo
             ]);
        exit;
    }
}