<?php
session_start();
include("db_conn.php");

if (!isset($_SESSION['student_no'])) {
    header("Location: loginpage.php");
    exit();
}

$student_no = $_SESSION['student_no'];
$upload_dir = "../uploads/profile_pics/";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_pic'])) {
    $file = $_FILES['profile_pic'];

    // Check for file upload errors
    if ($file['error'] != 0) {
        $error = urlencode("Error uploading the file.");
        header("Location: userPage.php?upload_message=$error");
        exit();
    }

    // Validate file type (ensure it's an image)
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    if (!in_array($file['type'], $allowed_types)) {
        $error = urlencode("Invalid file type. Only JPEG, PNG, and GIF are allowed.");
        header("Location: userPage.php?upload_message=$error");
        exit();
    }

    // Check file size (limit to 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        $error = urlencode("File should not exceed 5MB.");
        header("Location: userPage.php?upload_message=$error");
        exit();
    }

    $filename = $student_no . "_" . basename($file['name']);
    $target_file = $upload_dir . $filename;

    // Move the file to the target directory
    if (!move_uploaded_file($file['tmp_name'], $target_file)) {
        $error = urlencode("Failed to upload the file.");
        header("Location: userPage.php?upload_message=$error");
        exit();
    }

    // Update the profile picture in the database
    $updateQuery = "UPDATE student_tb SET profile_pic = '$target_file' WHERE student_no = '$student_no'";
    if (mysqli_query($conn, $updateQuery)) {
        $success = urlencode("Profile picture updated successfully!");
        header("Location: userPage.php?upload_message=$success");
        exit();
    } else {
        $error = urlencode("Error updating profile picture: " . mysqli_error($conn));
        header("Location: userPage.php?upload_message=$error");
        exit();
    }
}
?>
