<?php
session_start();
include 'db_conn.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "SELECT email, password, is_admin, student_no, otp_enabled FROM student_tb WHERE username = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    $_SESSION['error_message'] = 'User not found!';
    header("Location: loginpage.php");
    exit();
}

$user = mysqli_fetch_assoc($result);


// Check password
if ($user['password'] != $password) {
    $_SESSION['error_message'] = 'Incorrect password!';
    header("Location: loginpage.php");
    exit();
}

// Set session values
$email = $user['email'];
$_SESSION['account_id'] = $account_id;
$_SESSION['username'] = $username;
$_SESSION['student_no'] = $user['student_no'];
$_SESSION['otp_enabled'] = $user['otp_enabled'];
$_SESSION['is_admin'] = $user['is_admin'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
$mail = new PHPMailer(true);

// ✅ If OTP is enabled, send OTP and go to OTP page
if ($user['otp_enabled']) {
    // Generate and store OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;

    $subject = "Your OTP Code for ClassConnect URSB";
    $body = "<html>
               <body>
                   <h2>Your One-Time Password (OTP) for ClassConnect URSB</h2>
                   <p>Your OTP is: <b>$otp</b></p>
                   <p>Use this OTP to log in to your account.</p>
               </body>
             </html>";



    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ursbclassconnect@gmail.com';
        $mail->Password = 'rqrm bjcp eolz nsun';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('ursbclassconnect@gmail.com', 'ClassConnect');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();

        // ✅ Redirect to OTP page
        header("Location: otp.php");
        exit();

    } catch (Exception $e) {
        echo "OTP could not be sent. Mailer Error: {$mail->ErrorInfo}";
        exit();
    }

    // ✅ If OTP is disabled, skip directly to home
} else {
    header("Location: home.php");
    exit();
}
?>