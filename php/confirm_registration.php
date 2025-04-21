<?php
session_start();

if (!isset($_SESSION['form_data'])) {
    header('Location: registerpage.php');
    exit();
}

$form_data = $_SESSION['form_data'];
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
                <li><b>Student ID:</b> <?= htmlspecialchars($form_data['userid']) ?></li>
                <li><b>Username:</b> <?= htmlspecialchars($form_data['username']) ?></li>
                <li><b>Full Name:</b> <?= htmlspecialchars($form_data['firstname']) ?> <?= htmlspecialchars($form_data['lastname']) ?></li>
                <li><b>Email:</b> <?= htmlspecialchars($form_data['email']) ?></li>
                <li><b>Program:</b> <?= htmlspecialchars($form_data['program']) ?></li>
                <li><b>Year & Section:</b> <?= htmlspecialchars($form_data['year']) ?> - <?= htmlspecialchars($form_data['sec']) ?></li>
            </ul>

            <!-- Form with hidden inputs to pass the data -->
            <form action="welcome_email.php" method="POST">
                <input type="hidden" name="userid" value="<?= htmlspecialchars($form_data['userid']) ?>">
                <input type="hidden" name="username" value="<?= htmlspecialchars($form_data['username']) ?>">
                <input type="hidden" name="firstname" value="<?= htmlspecialchars($form_data['firstname']) ?>">
                <input type="hidden" name="lastname" value="<?= htmlspecialchars($form_data['lastname']) ?>">
                <input type="hidden" name="email" value="<?= htmlspecialchars($form_data['email']) ?>">
                <input type="hidden" name="program" value="<?= htmlspecialchars($form_data['program']) ?>">
                <input type="hidden" name="year" value="<?= htmlspecialchars($form_data['year']) ?>">
                <input type="hidden" name="sec" value="<?= htmlspecialchars($form_data['sec']) ?>">
                
                <div class="buttons">
                    <a href="registerpage.php" class="edit">Go Back</a>
                    <button type="submit" class="submit">Confirm and Register</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
