<?php
include("db_conn.php");
session_start();

// Check if post_id is set in the request
if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];

    // Fetch all file URLs associated with this post
    $getFilesQuery = "SELECT file_url FROM post_files_tb WHERE post_id = $post_id";
    $fileResult = mysqli_query($conn, $getFilesQuery);

    if ($fileResult && mysqli_num_rows($fileResult) > 0) {
        // Loop through each file and delete it from the server
        while ($fileRow = mysqli_fetch_assoc($fileResult)) {
            $file_url = $fileRow['file_url'];

            // Assuming your files are stored in a folder called 'uploads'
            $file_path = "../uploads/" . basename($file_url);

            if (file_exists($file_path)) {
                unlink($file_path); // Delete the file from the server
            }
        }

        // Now, delete the records in the database
        $deleteFilesQuery = "DELETE FROM post_files_tb WHERE post_id = $post_id";
        mysqli_query($conn, $deleteFilesQuery); // Delete files records from the database
    }

    // Delete the post itself from the post_tb
    $deletePostQuery = "DELETE FROM post_tb WHERE post_id = $post_id";
    if (mysqli_query($conn, $deletePostQuery)) {
        // Reset the AUTO_INCREMENT value for post_tb
        $resetAutoIncrementQuery = "ALTER TABLE post_tb AUTO_INCREMENT = 1";
        mysqli_query($conn, $resetAutoIncrementQuery);
        
        // Redirect to a page that shows the remaining posts or a confirmation page
        header("Location: home.php"); // For example, redirect to the homepage
        exit();
    } else {
        echo "Error deleting post: " . mysqli_error($conn);
    }
} else {
    echo "Invalid post ID.";
}
?>
