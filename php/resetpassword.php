<?php
session_start();
require 'db_conn.php';

$resetMessage = "";

if (!isset($_SESSION['verified']) || !isset($_SESSION['email'])) {
    header("Location: forgotpass.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['new_password'], $_POST['confirm_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $hashedPassword = md5($newPassword); // Use md5 for hashing
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);

        $sql = "UPDATE student_tb SET password = '$hashedPassword' WHERE email = '$email'";
        if (mysqli_query($conn, $sql)) {
            $resetMessage = "<div class='message success'>Password reset successful! Redirecting to login...</div>";
            session_destroy();
            echo "<script>
                setTimeout(function() {
                    window.location.href = 'loginpage.php';
                }, 3000);
            </script>";
        } else {
            $resetMessage = "<div class='message error'>An error occurred. Please try again later.</div>";
        }
    } else {
        $resetMessage = "<div class='message error'>Passwords do not match. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="../css/resetpassword.css">
    <link rel="icon" href="../icons/cc_logo.png" type="image/x-icon">
</head>
<body>
    <div class="box" id="resetPasswordPage">
        <div class="content">
            <div class="title">Reset Password</div>
            <p class="subtitle">Please enter your new password</p>
            
            <?php if (!empty($resetMessage)) echo $resetMessage; ?>

            <form method="POST">
                <div class="input-container">
                    <input class="passwordbox" type="text" name="new_password" placeholder="New Password" required>
                </div>
                <div class="input-container">
                    <input class="passwordbox" type="text" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button class="submit" type="submit">RESET PASSWORD</button>
            </form>
        </div>
    </div>
</body>
</html>