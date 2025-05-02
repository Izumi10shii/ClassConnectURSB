<?php
session_start();

if (!isset($_SESSION['otp'])) {
    header("Location: home.php");
    exit;
}

$otpMessage = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['otp'])) {
    $enteredOtp = $_POST['otp'];

    if ($enteredOtp == $_SESSION['otp']) {
        $otpMessage = "<div class='message success'>OTP Verified. Registration Successful! Redirecting...</div>";
        echo "<script>
            setTimeout(function() {
                window.location.href = 'home.php';
            }, 3000);
        </script>";
    } else {
        $otpMessage = "<div class='message error'>Invalid OTP. Please try again.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <link rel="stylesheet" href="../css/otp.css">
    <link rel="icon" href="../icons/cc_logo.png" type="image/x-icon">
</head>
<body>
    <div class="box" id="otpPage">
        <div class="content">
            <div class="otp">One-Time-Password</div>
            <p class="subtitle">Please enter the OTP sent to your email</p>
            
            <?php if (!empty($otpMessage)) echo $otpMessage; ?>

            <form method="POST">
                <div class="input-container">
                    <input class="otpbox" type="text" name="otp" placeholder="OTP" required>
                </div>
                <button class="submit" type="submit">SUBMIT</button>
            </form>
        </div>
    </div>
</body>
</html>
