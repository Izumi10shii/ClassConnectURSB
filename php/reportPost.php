<?php
include("db_conn.php");
//session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = mysqli_real_escape_string($conn, $_POST['post_id']);
    $reason = mysqli_real_escape_string($conn, $_POST['reason']);
    $username = mysqli_real_escape_string($conn, $_SESSION['username']); // Secure session value
    $account_id = mysqli_real_escape_string($conn, $_SESSION['account_id']); // Secure session value
    $reported_at = mysqli_real_escape_string($conn, date("Y-m-d H:i:s")); // Current timestamp

    if (!empty($post_id) && !empty($reason)) {
        $query = "INSERT INTO post_reports_tb (post_id, account_id, reason, reported_at) 
                  VALUES ('$post_id', '$account_id', '$reason', '$reported_at')";

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
