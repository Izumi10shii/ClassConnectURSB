<?php
include("db_conn.php");
session_start();

if (isset($_GET['comment_id']) && is_numeric($_GET['comment_id'])) {
    $comment_id = intval($_GET['comment_id']); // Sanitize comment_id

    // Step 1: Get the post_id associated with the comment
    $getPostIdQuery = "SELECT post_id FROM comment_tb WHERE comment_id = $comment_id";
    $postIdResult = mysqli_query($conn, $getPostIdQuery);

    if ($postIdResult && mysqli_num_rows($postIdResult) > 0) {
        $postIdRow = mysqli_fetch_assoc($postIdResult);
        $post_id = $postIdRow['post_id']; // Get the post_id

        // Step 2: Delete the comment from the database
        $deleteQuery = "DELETE FROM comment_tb WHERE comment_id = $comment_id";
        if (mysqli_query($conn, $deleteQuery)) {
            // Step 3: Decrement the comments_count in the post_tb table
            $updateCountQuery = "UPDATE post_tb SET comments_count = comments_count - 1 WHERE post_id = $post_id";
            if (mysqli_query($conn, $updateCountQuery)) {
                // Reset the AUTO_INCREMENT value for comment_tb
                $resetAutoIncrementQuery = "ALTER TABLE comment_tb AUTO_INCREMENT = 1";
                mysqli_query($conn, $resetAutoIncrementQuery);
                
                // Redirect back to the post management page
                header("Location: adminDashboard.php?page=post_management");
                exit();
            } else {
                echo "Error updating comments count: " . mysqli_error($conn);
            }
        } else {
            echo "Error deleting comment: " . mysqli_error($conn);
        }
    } else {
        echo "No post found for comment_id: $comment_id.";
    }
} else {
    echo "Invalid comment ID.";
}

mysqli_close($conn);
?>
