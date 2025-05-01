<?php

include("db_conn.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>

    <?php
    $getPost = "SELECT * FROM post_tb ORDER BY post_id DESC";
    $result = mysqli_query($conn, $getPost);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $post_id = $row['post_id'];
            $username = $row['username'];
            $title = $row['title'];
            $description = $row['description'];
            $created_at = $row['created_at'];
            $comments_count = $row['comments_count'];
            $like_count = $row['likes_count'];

            // Fetch images and files for the post
            $getFiles = "SELECT file_url FROM post_files_tb WHERE post_id = $post_id";
            $filesResult = mysqli_query($conn, $getFiles);
            $files = [];

            if ($filesResult && mysqli_num_rows($filesResult) > 0) {
                while ($fileRow = mysqli_fetch_assoc($filesResult)) {
                    $files[] = $fileRow['file_url'];
                }
            }

            // Handle username: fallback to 'Anonymous' if not logged in
            $currentUser = isset($_SESSION['username']) ? $_SESSION['username'] : 'Anonymous';

            // Check if this user already liked the post
            $checkLike = mysqli_query($conn, "SELECT * FROM post_likes_tb WHERE post_id = $post_id AND username = '$currentUser'");
            $userLiked = mysqli_num_rows($checkLike) > 0;

            // Fetch profile picture for the post creator
            $sqlpfpPostOwner = "SELECT profile_pic FROM student_tb WHERE username = '$username'";
            $resultpfpPostOwner = mysqli_query($conn, $sqlpfpPostOwner);
            $rowpfpPostOwner = mysqli_fetch_assoc($resultpfpPostOwner);

            $profile_picture_post_owner = !empty($rowpfpPostOwner['profile_pic']) ? $rowpfpPostOwner['profile_pic'] : '../bg/sample10.png';

            // Fetch profile picture for the logged-in user
            $student_no = $_SESSION['student_no'];
            $sqlpfpLoggedInUser = "SELECT profile_pic FROM student_tb WHERE student_no = '$student_no'";
            $resultpfpLoggedInUser = mysqli_query($conn, $sqlpfpLoggedInUser);
            $rowpfpLoggedInUser = mysqli_fetch_assoc($resultpfpLoggedInUser);

            $profile_picture_logged_in_user = !empty($rowpfpLoggedInUser['profile_pic']) ? $rowpfpLoggedInUser['profile_pic'] : '../bg/sample10.png';
            ?>

            <div class="post"
                onclick="window.location.href='/ClassConnectURSB/php/postPage.php?post_id=<?php echo ($post_id); ?>&user_id=<?php echo urlencode($username); ?>'">
                <div class="postHeader">
                    <div class="pfp">
                        <!-- Post Owner's Profile Picture -->
                        <img src="<?php echo $profile_picture_post_owner; ?>" alt="Profile Picture" class="profile-img">
                    </div>
                    <div class="postHeaderPoster">
                        <div class="postHeaderCol">
                            <div><strong><?php echo htmlspecialchars($username); ?></strong></div>
                        </div>
                        <div class="datetime"><?php echo htmlspecialchars($created_at); ?></div>
                    </div>
                </div>

                <h2><?php echo htmlspecialchars($title); ?></h2>
                <div>
                    <p><?php echo htmlspecialchars($description); ?></p>
                </div>

                <!-- Display all files -->
                <div class="files">
                    <?php foreach ($files as $file): ?>
                        <?php
                        $fileExtension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                        if ($fileExtension === 'pdf'): ?>
                            <embed class="docs" src="<?php echo htmlspecialchars($file); ?>" type="application/pdf">
                        <?php else: ?>
                            <img class="imgs" src="<?php echo htmlspecialchars($file); ?>" alt="Post File">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="interactionHeader">
                    <!-- Like/Unlike Button -->
                    <form method="POST" action="like_post.php" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                        <button type="submit" class="like-btn">
                            <img src="<?php echo $userLiked ? '../icons/dislike.svg' : '../icons/like.svg'; ?>"
                                alt="<?php echo $userLiked ? 'Unlike' : 'Like'; ?>">
                            <span><?php echo $like_count; ?></span>
                        </button>
                    </form>

                    <!-- Comment Button -->
                    <button class="commentBTN">
                        <img class="cmnt" src="../icons/comment.svg" alt="Comment">
                        <span><?php echo $comments_count; ?></span>
                    </button>
                </div>
            </div>

            <?php
        }
    } else {
        echo "<p>No posts available.</p>";
    }
    ?>

</body>

</html>
