<?php
include 'db_conn.php';
$post_id = $_GET['post_id'];
$result = mysqli_query($conn, "SELECT COUNT(*) AS like_count FROM post_likes_tb WHERE post_id = $post_id");
$row = mysqli_fetch_assoc($result);
echo $row['like_count'];
?>