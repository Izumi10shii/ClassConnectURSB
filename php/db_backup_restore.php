<?php
$databaseName = "classconnectdb";
$mysqlPath = "F:\\xampp\\mysql\\bin\\"; // Change based on your XAMPP installation path


function backupDatabase($mysqlPath, $databaseName) {
    $backupFile = "../backups/backup_" . date("Y-m-d_H-i-s") . ".sql";
    $command = "{$mysqlPath}mysqldump -u root $databaseName > $backupFile";
    system($command, $retval);
    return $retval === 0 ? $backupFile : false;
}

function restoreDatabase($mysqlPath, $databaseName, $sqlFile) {
    $command = "{$mysqlPath}mysql -u root $databaseName < $sqlFile";
    system($command, $retval);
    return $retval === 0;
}

// Handle form submissions
$message = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['backup'])) {
        $file = backupDatabase($mysqlPath, $databaseName);
        $message = $file ? "✅ Backup created: $file" : "❌ Backup failed.";
    }

    if (isset($_POST['restore'])) {
        if (!empty($_POST['restore_file'])) {
            $fileToRestore = $_POST['restore_file'];
            if (file_exists($fileToRestore)) {
                $success = restoreDatabase($mysqlPath, $databaseName, $fileToRestore);
                $message = $success ? "✅ Restore successful." : "❌ Restore failed.";
            } else {
                $message = "❌ File not found.";
            }
        } else {
            $message = "❌ Please provide a file path.";
        }
    }
}

// Get list of backups
$backups = glob("../backups/*.sql");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Database Backup & Restore</title>
    <link rel="stylesheet" href="../css/db_backup_restore.css">
</head>
<body>

<h2>🗂 Backup and Restore MySQL Database</h2>

<form method="POST">
    <button type="submit" name="backup">🔄 Create Backup</button>
</form>

<h3>📥 Restore</h3>
<form method="POST">
    <label>Select a backup file:</label><br>
    <select name="restore_file">
        <?php foreach ($backups as $file): ?>
            <option value="<?= htmlspecialchars($file) ?>"><?= basename($file) ?></option>
        <?php endforeach; ?>
    </select><br><br>
    <button type="submit" name="restore">♻ Restore Database</button>
</form>

<?php if ($message): ?>
    <p class="message"><?= htmlspecialchars($message) ?></p>
    <?php unset($message); ?>
<?php endif; ?>

</body>
</html>
