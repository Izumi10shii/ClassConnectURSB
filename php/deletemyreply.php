<?php
session_start();
include("db_conn.php");

if (isset($_GET['reply_id']) && isset($_GET['post_id']) && isset($_SESSION['account_id'])) {
    $reply_id = intval($_GET['reply_id']);
    $post_id = intval($_GET['post_id']);
    $account_id = $_SESSION['account_id'];

    // Sanitize inputs
    $reply_id = mysqli_real_escape_string($conn, $reply_id);
    $post_id = mysqli_real_escape_string($conn, $post_id);
    $account_id = mysqli_real_escape_string($conn, $account_id);

    // Check if the reply exists and belongs to the user
    $checkQuery = "SELECT * FROM comment_replies_tb WHERE reply_id = $reply_id AND account_id = '$account_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Delete the reply
        $deleteQuery = "DELETE FROM comment_replies_tb WHERE reply_id = $reply_id";
        if (mysqli_query($conn, $deleteQuery)) {
            // Redirect back to the original post
            header("Location: postPage.php?post_id=$post_id");
            exit();
        } else {
            echo "Error: Could not delete the reply. Please try again.";
        }
    } else {
        echo "You are not authorized to delete this reply or it does not exist.";
    }
} else {
    echo "Invalid request.";
}
?>
