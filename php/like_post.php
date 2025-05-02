<?php
session_start();
include 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    // Ensure the session is valid
    if (!isset($_SESSION['username'])) {
        die("You need to be logged in to like or unlike a post.");
    }

    $username = $_SESSION['username'];
    $account_id = $_SESSION['account_id']; 
    $post_id = intval($_POST['post_id']);  // Sanitize the post_id

    // Sanitize the username
    $username = mysqli_real_escape_string($conn, $username);

    // Check if the user already liked the post
    $check_sql = "SELECT * FROM post_likes_tb WHERE username = '$username' AND post_id = $post_id";
    $check_result = mysqli_query($conn, $check_sql);

    if (mysqli_num_rows($check_result) == 0) {
        // Add a like
        $insert_sql = "INSERT INTO post_likes_tb (username, account_id, post_id) VALUES ('$username', '$account_id', $post_id)";
        if (mysqli_query($conn, $insert_sql)) {
            // Increment the likes_count in post_tb
            $update_likes_sql = "UPDATE post_tb SET likes_count = likes_count + 1 WHERE post_id = $post_id";
            mysqli_query($conn, $update_likes_sql);
        } else {
            die("Error inserting like: " . mysqli_error($conn));
        }
    } else {
        // Remove the like
        $delete_sql = "DELETE FROM post_likes_tb WHERE username = '$username' AND post_id = $post_id";
        if (mysqli_query($conn, $delete_sql)) {
            // Decrement the likes_count in post_tb
            $update_likes_sql = "UPDATE post_tb SET likes_count = likes_count - 1 WHERE post_id = $post_id";
            mysqli_query($conn, $update_likes_sql);
        } else {
            die("Error removing like: " . mysqli_error($conn));
        }
    }

    // Redirect back to the referring page
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
}
?>
