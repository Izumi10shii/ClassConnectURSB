<?php
session_start();
include("db_conn.php");

if (isset($_GET['comment_id']) && isset($_SESSION['username']) && isset($_GET['post_id'])) {
    $comment_id = intval($_GET['comment_id']);
    $post_id = intval($_GET['post_id']);
    $username = mysqli_real_escape_string($conn, $_SESSION['username']); // sanitize input
    $account_id = mysqli_real_escape_string($conn, $_SESSION['account_id']); // sanitize input

    // Correctly quote the string in the SQL query
    $checkQuery = "SELECT * FROM comment_tb WHERE comment_id = $comment_id AND account_id = '$account_id'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        // Step 1: Get the current comment count for the post
        $getPostQuery = "SELECT comments_count FROM post_tb WHERE post_id = $post_id";
        $postResult = mysqli_query($conn, $getPostQuery);

        if ($postResult && mysqli_num_rows($postResult) > 0) {
            $postRow = mysqli_fetch_assoc($postResult);
            $currentCommentCount = $postRow['comments_count'];

            // Step 2: Delete the comment from the database
            $deleteQuery = "DELETE FROM comment_tb WHERE comment_id = $comment_id";
            if (mysqli_query($conn, $deleteQuery)) {
                // Step 3: Decrement the comments_count in the post_tb table
                $updateCountQuery = "UPDATE post_tb SET comments_count = comments_count - 1 WHERE post_id = $post_id";
                if (mysqli_query($conn, $updateCountQuery)) {
                    // Redirect to the post page or another page after deletion
                    header("Location: postPage.php?post_id=" . $post_id);
                    exit();
                } else {
                    echo "Error: Could not update the comment count.";
                }
            } else {
                echo "Error: Could not delete the comment.";
            }
        } else {
            echo "Post not found.";
        }
    } else {
        echo "You are not authorized to delete this comment.";
    }
}
?>
