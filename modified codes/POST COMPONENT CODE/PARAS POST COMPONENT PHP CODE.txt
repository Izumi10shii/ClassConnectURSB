<?php
include("db_conn.php");
session_start();
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
            $files = []; // Reset the files array for each post

            if ($filesResult && mysqli_num_rows($filesResult) > 0) {
                while ($fileRow = mysqli_fetch_assoc($filesResult)) {
                    $files[] = $fileRow['file_url'];
                }
            }

            // Check if this user already liked it
            $currentUser = $_SESSION['username'];
            $checkLike = mysqli_query($conn, "SELECT * FROM post_likes_tb WHERE post_id = $post_id AND username = '$currentUser'");
            $userLiked = mysqli_num_rows($checkLike) > 0;
            ?>

            <div class="post"
                onclick="window.location.href='/ClassConnectURSB/php/postPage.php?post_id=<?php echo ($post_id); ?>&user_id=<?php echo ($username); ?>'">
                <div class="postHeader">
                    <div class="pfp">
                        <img src="../bg/sample8.png" alt="Profile Picture">
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
                <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
                    <?php foreach ($files as $file): ?>
                        <?php
                        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
                        if (strtolower($fileExtension) === 'pdf'): ?>
                            <!-- Display PDF -->
                            <embed src="<?php echo $file; ?>" type="application/pdf" style="width: 200px; height: 200px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <?php else: ?>
                            <!-- Display Image -->
                            <img src="<?php echo $file; ?>" alt="Post File" style="width: 200px; height: 200px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <div class="interactionHeader">
                    <!-- Form to handle like/unlike -->
                    <form method="POST" action="like_post.php" style="display: inline;">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <button type="submit" class="like-btn">
                            <?php echo $userLiked ? "👎 Unlike" : "👍 Like"; ?>
                        </button>
                    </form>
                    <span><?php echo "Likes: " . $like_count; ?></span>
                    <button class="commentBTN">comment</button>
                    <span><?php echo "Comments: " . $comments_count; ?></span>
                    <button class="share" onclick="event.stopPropagation();">share</button>
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