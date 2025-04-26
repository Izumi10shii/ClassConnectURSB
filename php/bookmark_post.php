<?php
include("db_conn.php");
session_start();

// Get the current user and post ID
$currentUser = $_SESSION['username'];
$post_id = $_POST['post_id'] ?? null; // Post ID from the form

if ($post_id) {
    // Check if the post is already bookmarked
    $checkBookmark = mysqli_query($conn, "SELECT * FROM bookmarks_tb WHERE post_id = $post_id AND username = '$currentUser'");
    $userBookmarked = mysqli_num_rows($checkBookmark) > 0;

    if ($userBookmarked) {
        // If already bookmarked, unbookmark (remove from DB)
        $removeBookmark = "DELETE FROM bookmarks_tb WHERE post_id = $post_id AND username = '$currentUser'";
        if (mysqli_query($conn, $removeBookmark)) {
            // Success: Post is unbookmarked
            header("Location: postPage.php?post_id=$post_id"); // Redirect back to the post page
            exit;
        }
    } else {
        // If not bookmarked, bookmark the post
        $addBookmark = "INSERT INTO bookmarks_tb (post_id, username) VALUES ($post_id, '$currentUser')";
        if (mysqli_query($conn, $addBookmark)) {
            // Success: Post is bookmarked
            header("Location: postPage.php?post_id=$post_id"); // Redirect back to the post page
            exit;
        }
    }
}
?>
