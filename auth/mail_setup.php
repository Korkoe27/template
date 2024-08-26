<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendVerificationEmail($email, $verificationCode) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'live.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'api';
        $mail->Password = 'YOUR_MAILTRAP_PASSWORD';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('youremail@example.com', 'Your Website');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(false);
        $mail->Subject = 'Email Verification';
        $mail->Body    = "Your verification code is: $verificationCode";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}