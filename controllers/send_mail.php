<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once dirname(__DIR__) . '/vendor/autoload.php';

function sendMailOTP($email, $otp){
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
//         $mail->SMTPDebug = 2;
// $mail->Debugoutput = 'html';
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'yahiadiaa1010@gmail.com'; 
        //$mail->Password   = 'etqf tbpe anwo icck';   
        $mail->Password   = 'etqftbpeanwoicck';   

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('yahiadiaa1010@gmail.com', '3dos Council Admin');
        $mail->addAddress($email); 

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
            "status" => 500,
            "message" => "Mail Error Occurred",
            "error" => $mail->ErrorInfo
        ]);
        exit;
    }
}