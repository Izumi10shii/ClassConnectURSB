<?php
include 'db_conn.php';

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

    $query = "INSERT INTO users (userid, username, firstname, lastname, password, email, program, year, sec) 
              VALUES ('$userid', '$username', '$firstname', '$lastname', '$password', '$email', '$program', $year, $sec)";

    if (mysqli_query($conn, $query)) {
        echo "Registration successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
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
                <li><b>Student ID:</b> <?= htmlspecialchars($_POST['userid']) ?></li>
                <li><b>Username:</b> <?= htmlspecialchars($_POST['username']) ?></li>
                <li><b>Full Name:</b> <?= htmlspecialchars($_POST['firstname']) ?> <?= htmlspecialchars($_POST['lastname']) ?></li>
                <li><b>Email:</b> <?= htmlspecialchars($_POST['email']) ?></li>
                <li><b>Program:</b> <?= htmlspecialchars($_POST['program']) ?></li>
                <li><b>Year & Section:</b> <?= htmlspecialchars($_POST['year']) ?> - <?= htmlspecialchars($_POST['sec']) ?></li>
            </ul>

            <!-- Form with hidden inputs to pass the data -->
            <form action="welcome_email.php" method="POST">
                <input type="hidden" name="userid" value="<?= htmlspecialchars($_POST['userid']) ?>">
                <input type="hidden" name="username" value="<?= htmlspecialchars($_POST['username']) ?>">
                <input type="hidden" name="firstname" value="<?= htmlspecialchars($_POST['firstname']) ?>">
                <input type="hidden" name="lastname" value="<?= htmlspecialchars($_POST['lastname']) ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($_POST['email']) ?>">
                <input type="hidden" name="program" value="<?= htmlspecialchars($_POST['program']) ?>">
                <input type="hidden" name="yearsec" value="<?= htmlspecialchars($_POST['yearsec']) ?>">

                <button type="submit" class="submit">Confirm and Register</button>
            </form>
        </div>
    </div>
</body>
</html>
