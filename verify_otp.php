<?php
session_start(); 

if (isset($_POST['otp'])) {
    $enteredOtp = $_POST['otp'];
    
    if ($enteredOtp == $_SESSION['otp']) {
        // OTP is correct
        echo "<h2>OTP Verified. Registration Successful!</h2>";

        header("Location: loginpage.php");
        exit();
    } else {
        // OTP is incorrect
        echo "<h2>Invalid OTP. Please try again.</h2>";
        echo "<a href='otp.php'>Go Back</a>";
    }
} else {
    // If no OTP is entered
    echo "<h2>Please enter the OTP to verify your registration.</h2>";
    echo "<a href='otp.php'>Go Back</a>";
}
?>
