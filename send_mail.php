<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendOtpEmail($email, $otp) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;

        // YOUR GMAIL LOGIN
        $mail->Username   = 'ajinkyakulkarni2003@gmail.com';      
        $mail->Password   = 'pgzajukbqrbnutrk';        

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('YOUR_EMAIL@gmail.com', 'Online Voting System');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP Code';
        $mail->Body    = "<p>Your OTP for login is: <b>$otp</b><br>Valid for 5 minutes.</p>";

        $mail->send();
        return true;

    } catch (Exception $e) {
        return false;
    }
}
