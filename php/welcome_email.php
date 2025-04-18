<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$data = $_SESSION['form_data'];

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ursbclassconnect@gmail.com';
    $mail->Password = 'rqrm bjcp eolz nsun';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('ursbclassconnect@gmail.com', 'ClassConnect');
    $mail->addAddress($data['email']);

    $mail->isHTML(true);
    $mail->Subject = 'Welcome to ClassConnect!';
    $mail->Body = "Hello <b>{$data['username']}</b>,<br>Welcome to ClassConnect! We're excited to have you.";

    $mail->send();

    header('Location: loginpage.php');
    exit();
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
