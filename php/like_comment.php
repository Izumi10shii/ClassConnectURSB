<?php
session_start();
include("db_conn.php");

if (isset($_POST['comment_id']) && isset($_SESSION['account_id'])) {
    $comment_id = intval($_POST['comment_id']);
    $account_id = $_SESSION['account_id'];

    // Check if user already liked
    $checkQuery = "SELECT * FROM comment_likes_tb WHERE comment_id = $comment_id AND account_id = '$account_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Unlike
        $deleteQuery = "DELETE FROM comment_likes_tb WHERE comment_id = $comment_id AND account_id = '$account_id'";
        mysqli_query($conn, $deleteQuery);
    } else {
        // Like
        $insertQuery = "INSERT INTO comment_likes_tb (comment_id, account_id, like_date) VALUES ($comment_id, '$account_id', NOW())";
        mysqli_query($conn, $insertQuery);
    }

    // Redirect back to the post page
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    header("Location: postPage.php?post_id=$post_id");
    exit();
}
?>
