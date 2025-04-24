<?php
session_start();

$errorMessage = "";

if (isset($_SESSION['error'])) {
    $errorMessage = $_SESSION['error'];

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="../css/forgotpass.css">
</head>

<body>
    <form class="box" id="forgotPass" method="POST" action="resetpass_otp.php">
        <div class="content">
            <label for="email">Password Reset</label>
            <p id="subtitle">Please enter the email address of the account you want to reset the password for.</p>

            <?php if (!empty($errorMessage)): ?>
                <div class="message error"><?php echo $errorMessage; ?></div>
            <?php endif; ?>

            <input class="email" id="email" type="email" name="email" required placeholder="Enter your email">
            <button class="submit" id="submit" type="submit">SUBMIT</button>
        </div>
    </form>
</body>

</html>
