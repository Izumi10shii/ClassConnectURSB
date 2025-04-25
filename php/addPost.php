<?php
include("db_conn.php");

session_start();
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
    <nav class="homeHeader">
        <a href="home.php">
            <h1>Class<span style="opacity: 0;">.</span>Connect</h1>
        </a>
        <input class="search" type="text" placeholder="Search">
        <a href="userPage.html">
            <!-- Profile picture -->
            <div class="pfp profile"></div>
        </a>
    </nav>

    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <div class="homebtn lsu">Home</div>
                <div class="popularbtn lsu">Profile</div>

                <div class="explorebtn lsu">
                    <a href="explorePage.php">
                        Explore Discussions
                    </a>
                </div>

                <div class="popularbtn lsu">File Storage</div>

                <div class="popularbtn lsu">
                    <a href="adminUsersList.php">
                        Registered Users
                    </a>
                </div>

                <div class="popularbtn lsu">
                    <a href="adminPostsList.php">
                        Post Management
                    </a>
                </div>

                <div class="popularbtn lsu">Settings</div>
            </div>
            <div class="leftSideDown">
                <div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_post'])) {
            $title = $_POST['titleInput'] ?? '';
            $description = $_POST['bodyInput'] ?? '';
            $user = $_SESSION['username'];

            if (!empty($title) && !empty($description)) {
                // Insert the post into the post_tb table
                $newPost = "INSERT INTO post_tb(username, title, description) VALUES('$user', '$title', '$description')";

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

                    // Redirect after successful post creation
                    header('Location: home.php');
                    exit();
                } else {
                    error_log("Database Error: " . mysqli_error($conn));
                }
            }
        }
        ?>

        <div class="post">
            <h1>Create Post</h1>

            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="titleInput" id="titleInput" placeholder="Title">
                <textarea id="bodyInput" name="bodyInput" placeholder="Body"></textarea>

                <!-- Inline CSS since my browser can't see -->
                <div class="file-upload-wrapper" style="display: flex; align-items: center; margin-top: 10px;">
                    <!-- Hidden file input (multiple files allowed) -->
                    <input type="file" id="fileInput" name="files[]" multiple style="display: none;"
                        onchange="updateFileLabel()">

                    <!-- Label with inline styles for the custom file upload button -->
                    <label for="fileInput"
                        style="background-color:rgb(0, 0, 0); color: white; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease;">
                        Choose Files
                    </label>

                    <!-- File name text -->
                    <span id="file-upload-text" style="font-size: 16px; color: #555; margin-left: 10px;">No files
                        chosen</span>
                </div>

                <input type="submit" name="add_post" class="postBTN" value="Post">
            </form>

            <div class="interactionHeader">
                <button onclick="window.location.href='home.php'" class="cancelPostBTN">Cancel Post</button>
            </div>
        </div>

        <script>
            function updateFileLabel() {
                const fileInput = document.getElementById('fileInput');
                const fileUploadText = document.getElementById('file-upload-text');

                const files = fileInput.files;
                if (files.length > 0) {
                    const fileNames = Array.from(files).map(file => file.name).join(', ');
                    fileUploadText.textContent = fileNames;
                    fileUploadText.style.color = '#333';  // Change text color when files are chosen
                } else {
                    fileUploadText.textContent = 'No files chosen';
                    fileUploadText.style.color = '#aaa';  // Color when no files are selected
                }
            }
        </script>
</body>

</html>