<?php
include("db_conn.php");
session_start();

if (isset($_GET['comment_id']) && is_numeric($_GET['comment_id'])) {
    $comment_id = intval($_GET['comment_id']); // Sanitize comment_id

    // Delete the comment from the database
    $deleteQuery = "DELETE FROM comment_tb WHERE comment_id = $comment_id";

    if (mysqli_query($conn, $deleteQuery)) {
        // Redirect back to the referring page or a default page
        header("Location: adminDashboard.php?page=post_management");
        exit();
    } else {
        echo "Error deleting comment: " . mysqli_error($conn);
    }
} else {
    echo "Invalid comment ID.";
}

mysqli_close($conn);
?>
