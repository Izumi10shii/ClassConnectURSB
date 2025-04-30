<?php
include("db_conn.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file_name = mysqli_real_escape_string($conn, $_POST['filename']);
    $topic = mysqli_real_escape_string($conn, $_POST['topic']);
    $username = $_SESSION['username'] ?? 'Anonymous';

    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        $targetDir = "../uploads/";
        $fileName = basename($_FILES["file"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
        $allowedTypes = array('pdf', 'doc', 'docx', 'ppt', 'pptx', 'jpg', 'png', 'zip', 'rar', 'txt');

        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
                $insert = "INSERT INTO file_storage_tb (username, file_name, topic, file_path, uploaded_at) 
                           VALUES ('$username', '$file_name', '$topic', '$fileName', NOW())";
                if (mysqli_query($conn, $insert)) {
                    $msg = "Material uploaded successfully!";
                    header("Location: file_storage.php");
                    exit;
                } else {
                    $msg = "Failed to save into database!";
                }
            } else {
                $msg = "Failed to upload file!";
            }
        } else {
            $msg = "Only these file types are allowed: " . implode(", ", $allowedTypes);
        }
    } else {
        $msg = "Please select a valid file to upload.";
    }
}

// Fetch uploaded files
$query = "SELECT * FROM file_storage_tb ORDER BY uploaded_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Upload Material</title>
    <link rel="stylesheet" href="../css/file_storage.css">
</head>

<body>
    <!-- Navbar -->
    <?php include("nav.php"); ?>
    
    <div class="HomeContainer">
        <?php include("userSidebar.php"); ?>
        <div class="content">

            <!-- Upload Form -->
            <div id="uploadForm" class="upload-form">
                <h2>Upload Learning Material</h2>
                <form action="file_storage.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="filename" placeholder="Enter File Name" required>
                    <input type="text" name="topic" placeholder="Enter Topic" required>
                    <input type="file" name="file" required>
                    <button type="submit">Upload</button>
                </form>

                <?php if (isset($msg)): ?>
                    <div class="message"><?php echo $msg; ?></div>
                <?php endif; ?>
            </div>

            <!-- Display Uploaded Files -->
            <div class="file-list">
                <h2>Uploaded Files</h2>
                <?php if ($result && mysqli_num_rows($result) > 0): ?>
                    <ul>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <li>
                                <strong><?php echo htmlspecialchars($row['file_name']); ?></strong>
                                (<?php echo htmlspecialchars($row['topic']); ?>) -
                                <a href="../uploads/<?php echo htmlspecialchars($row['file_path']); ?>"
                                    target="_blank">Download</a>
                                <small>Uploaded by: <?php echo htmlspecialchars($row['username']); ?> on
                                    <?php echo htmlspecialchars($row['uploaded_at']); ?></small>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No files uploaded yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>