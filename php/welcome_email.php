<?php
include 'db_conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userid = $_POST['userid'];
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $program = $_POST['program'];
    $year = (int)$_POST['year'];
    $sec = (int)$_POST['sec'];

    // Insert into database
    $query = "INSERT INTO student_tb (student_no, username, fname, lname, password, email, program, year, section) 
              VALUES ('$userid', '$username', '$firstname', '$lastname', '$password', '$email', '$program', $year, $sec)";
              
    if (mysqli_query($conn, $query)) {
        // Send welcome email
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
            $mail->addAddress($email); // using $_POST['email']

            $mail->isHTML(true);
            $mail->Subject = 'Welcome to ClassConnect!';
            $mail->Body = "Hello <b>{$username}</b>,<br>Welcome to ClassConnect!<br>We're excited to have you join our community of learners and educators.<br>ClassConnect is all about making collaboration easier, learning more engaging, and communication seamless.<br>Let's make the most of this journey together!<br><hr>If you notice any bugs or glitches, kindly report them to us so we could further develop the system to cater everyone else's needs.<br>We thank you for supporting ClassConnect.";

            $mail->send();

            header('Location: loginpage.php');
            exit();
        } catch (Exception $e) {
            echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
