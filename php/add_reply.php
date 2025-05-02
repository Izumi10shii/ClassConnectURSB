<?php
session_start();
include("db_conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reply_desc'], $_POST['comment_id'], $_POST['post_id'])) {
    $reply_desc = mysqli_real_escape_string($conn, $_POST['reply_desc']);
    $comment_id = intval($_POST['comment_id']);
    $post_id = intval($_POST['post_id']);  // Ensures post_id is captured
    $username = $_SESSION['username'];
    $account_id = $_SESSION['account_id'];

    // Query to insert the reply into the database
    $addReplyQuery = "INSERT INTO comment_replies_tb (parent_comment_id, post_id, account_id, username, reply_desc) 
                      VALUES ('$comment_id', '$post_id', $account_id, '$username', '$reply_desc')";

    if (mysqli_query($conn, $addReplyQuery)) {
        header("Location: postPage.php?post_id=$post_id");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
