<?php
// Check if form data is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if the passwords match
    if ($password !== $confirmPassword) {
        header("Location: registerpage.php?error=password_mismatch");
        exit();
    }
    else {
        unset($_POST['confirm_password']);
        unset($_POST['password']);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation</title>
    <link rel="stylesheet" href="../css/confirm_registration.css">
</head>
<body>
    <div class="content">
        <div class="confirmbox">
        <h2>Please Confirm Your Information</h2>
    <ul>
        <li><b>Username/ID:</b> <?= htmlspecialchars($_POST['userid']) ?></li>
        <li><b>Username:</b> <?= htmlspecialchars($_POST['username']) ?></li>
        <li><b>Full Name:</b> <?= htmlspecialchars($_POST['firstname']) ?> <?= htmlspecialchars($_POST['lastname']) ?></li>
        <li><b>Email:</b> <?= htmlspecialchars($_POST['email']) ?></li>
        <li><b>Program:</b> <?= htmlspecialchars($_POST['program']) ?></li>
        <li><b>Year & Section:</b> <?= htmlspecialchars($_POST['yearsec']) ?></li>
    </ul>

    <form action="welcome_email.php" method="POST">
        <button type="submit" class="submit">Confirm and Register</button>
    </form>
        </div>
    </div>

</body>
</html>
