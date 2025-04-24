<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $inputOtp = $_POST['otp'];

    if (isset($_SESSION['otp']) && $inputOtp == $_SESSION['otp']) {
        // Verified
        $_SESSION['verified'] = true;
        header("Location: resetpassword.php");
        exit();
    } else {
        $error = "Invalid OTP. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Reset Password</title>
    <link rel="stylesheet" href="../css/verify_reset_otp.css">
</head>
<body>
    <div class="box" id="otpPage">
        <div class="content">
            <div class="otp">One-Time-Password</div>
            <p class="subtitle">Please enter the OTP sent to your email</p>
            
            <?php if (isset($error)) echo "<div class='message error'>$error</div>"; ?>

            <form method="POST">
                <div class="input-container">
                    <input class="otpbox" type="text" name="otp" placeholder="Enter OTP" required>
                </div>
                <button class="submit" type="submit">Verify</button>
            </form>
        </div>
    </div>
</body>
</html>
