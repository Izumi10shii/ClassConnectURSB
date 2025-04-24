<?php
session_start();
require 'db_conn.php';
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the database
    $sql = "SELECT * FROM student_tb WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);

    if (!$user) {
        $_SESSION['error'] = "No account is registered with this email.";
        header("Location: forgotpass.php");
        exit();
    }

    // Generate OTP
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['email'] = $email;

    // Prepare email
    $subject = "ClassConnect Password Reset PIN";
    $body = "<html>
                <body>
                    <h2>Password Reset Verification</h2>
                    <p>Your verification PIN is: <b>$otp</b></p>
                    <p>Use this code to verify your identity and reset your password.</p>
                </body>
            </html>";

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ursbclassconnect@gmail.com';
        $mail->Password   = 'rqrm bjcp eolz nsun'; // use an app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('ursbclassconnect@gmail.com', 'ClassConnect');
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();

        header("Location: verify_reset_otp.php");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
