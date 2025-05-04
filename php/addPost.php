<?php
include("db_conn.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/addPost.css">
</head>

<body>

    <?php include("nav1.php"); ?>

    <div class="HomeContainer">

        <?php


        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_post'])) {
            $title = $_POST['titleInput'] ?? '';
            $description = $_POST['bodyInput'] ?? '';
            $account_id = $_SESSION['account_id'];

            if (!empty($title) && !empty($description)) {
                // Insert the post into the post_tb table
                $newPost = "INSERT INTO post_tb(account_id, title, description) VALUES($account_id, '$title', '$description')";

                if (mysqli_query($conn, $newPost)) {
                    $post_id = mysqli_insert_id($conn); // Get the ID of the newly inserted post

                    // Handle the file uploads
                    if (isset($_FILES['files']) && count($_FILES['files']['name']) > 0) {
                        for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
                            $file_name = $_FILES['files']['name'][$i];
                            $file_tmp_name = $_FILES['files']['tmp_name'][$i];
                            $file_size = $_FILES['files']['size'][$i];
                            $file_error = $_FILES['files']['error'][$i];

                            if ($file_error === 0) {
                                $upload_dir = '../uploads/';
                                $file_path = $upload_dir . basename($file_name);

                                if (move_uploaded_file($file_tmp_name, $file_path)) {
                                    // Insert the file info into the post_files_tb table
                                    $insertFile = "INSERT INTO post_files_tb(post_id, file_name, file_url) 
                                                   VALUES($post_id, '$file_name', '$file_path')";
                                    mysqli_query($conn, $insertFile);
                                }
                            }
                        }
                    }

                    header('Location: home.php');
                    exit();
                } else {
                    error_log("Database Error: " . mysqli_error($conn));
                }
            }
        }
        include("userSidebar.php");
        ?>

        <div class="post">
            <h1>Create New Post</h1>

            <form action="" method="post" enctype="multipart/form-data">

                <div class="selectTag">

                    <label for="dropdown">Choose Topics:</label>
                    <select id="dropdown" name="dropdown">
                        <option value="option1">Ethics</option>
                        <option value="option2">ITE 7</option>
                        <option value="option3">IT 4</option>
                        <option value="option3">IT 5</option>
                        <option value="option3">IT 6</option>
                        <option value="option3">OOP</option>
                        <option value="option3">IT 7</option>
                        <option value="option3">PE 4</option>
                    </select>
                </div>

                <input type="text" name="titleInput" id="titleInput" placeholder="Title">
                <textarea id="bodyInput" name="bodyInput" placeholder="Body"></textarea>

                <!-- Inline CSS since my browser can't see -->
                <div class="file-upload-wrapper" style="display: flex; align-items: center; margin-top: 10px;">
                    <!-- Hidden file input (multiple files allowed) -->
                    <input type="file" id="fileInput" name="files[]" multiple style="display: none;"
                        onchange="updateFileLabel()">

                    <!-- Label with inline styles for the custom file upload button -->
                    <label for="fileInput" class="chooseFiles">
                        Choose Files
                    </label>


                    <!-- File name text -->
                    <span id="file-upload-text" style="font-size: 16px; color: #555; margin-left: 10px;">No files
                        chosen</span>
                </div>

                <input type="submit" name="add_post" class="postBTN" value="Post">
            </form>


        </div>


        <script>
            function updateFileLabel() {
                const fileInput = document.getElementById('fileInput');
                const fileUploadText = document.getElementById('file-upload-text');

                const files = fileInput.files;
                if (files.length > 0) {
                    const fileNames = Array.from(files).map(file => file.name).join(', ');
                    fileUploadText.textContent = fileNames;
                    fileUploadText.style.color = '#333'; // Change text color when files are chosen
                } else {
                    fileUploadText.textContent = 'No files chosen';
                    fileUploadText.style.color = '#aaa'; // Color when no files are selected
                }
            }
        </script>
</body>

</html>