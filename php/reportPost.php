<?php
include("db_conn.php");
//session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $username = mysqli_real_escape_string($conn, $_SESSION['username']); // Secure session value

    if (!empty($post_id) && !empty($reason)) {
        $query = "INSERT INTO post_reports_tb (post_id, username, reason) 
                  VALUES ('$post_id', '$username', '$reason')";

        if (mysqli_query($conn, $query)) {
            header("Location: home.php");
            exit();
        } else {
            echo "Error reporting post: " . mysqli_error($conn);
        }
    } else {
        echo "Missing information.";
    }
} else {
    echo "Invalid request.";
}
?>
