<?php
session_start();
include("db_conn.php");

if (isset($_GET['post_id']) && isset($_SESSION['account_id'])) {
    $post_id = intval($_GET['post_id']); // Ensure post_id is an integer
    $account_id = $_SESSION['account_id']; // Logged-in user's account_id

    // Sanitize the input to avoid SQL injection
    $post_id = mysqli_real_escape_string($conn, $post_id);
    $account_id = mysqli_real_escape_string($conn, $account_id);

    // Check if the post exists and if the current user is the owner of the post
    $checkQuery = "SELECT * FROM post_tb WHERE post_id = $post_id AND account_id = '$account_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // If the user is the owner, proceed with deletion
        $deleteQuery = "DELETE FROM post_tb WHERE post_id = $post_id";
        
        if (mysqli_query($conn, $deleteQuery)) {
            // Redirect back to the post page after successful deletion
            header("Location:  home.php");
            exit();
        } else {
            echo "Error: Could not delete the post. Please try again.";
        }
    } else {
        // If the user is not authorized or the post doesn't exist
        echo "You are not authorized to delete this post or the post does not exist.";
    }
} else {
    echo "Invalid request. Please make sure you're logged in and the post ID is provided.";
}
?>
