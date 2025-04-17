<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$email = $_POST['email'];

$otp = rand(100000, 999999);

$_SESSION['otp'] = $otp;

//$user = $_POST['username'];
$subject = "Your OTP Code for ClassConnect URSB";
$body ="Your One-Time Password (OTP) for ClassConnectURSB is: <b>$otp</b>";

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'ursbclassconnect@gmail.com';
    $mail->Password = 'rqrm bjcp eolz nsun';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('ursbclassconnect@gmail.com', 'ClassConnect');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $body;

    // Send email
    $mail->send();
    echo 'OTP has been sent to your email.';
    header("Location: otp.php"); 
    exit();
} catch (Exception $e) {
    echo "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
