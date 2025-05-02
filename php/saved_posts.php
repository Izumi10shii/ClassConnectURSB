<?php
include("db_conn.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


$username = $_SESSION['username'] ?? null;
$account_id = $_SESSION['account_id'] ?? null;

// Handle UNSAVE if confirmed
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['confirm_unsave_post_id'])) {
    $unsavePostId = intval($_POST['confirm_unsave_post_id']);

    $deleteBookmark = "DELETE FROM bookmarks_tb WHERE account_id = '$account_id' AND post_id = $unsavePostId";
    mysqli_query($conn, $deleteBookmark);

    header("Location: saved_posts.php");
    exit();
}

// Fetch saved posts
$bookmarkQuery = "SELECT p.*, s.username, s.profile_pic
FROM bookmarks_tb b
JOIN post_tb p ON b.post_id = p.post_id
JOIN student_tb s ON p.account_id = s.account_id
WHERE b.account_id = '$account_id'
ORDER BY b.bookmark_id DESC
";

$result = mysqli_query($conn, $bookmarkQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Saved Posts</title>
    <link rel="stylesheet" href="../css/saved_posts.css">
    <link rel="icon" href="../icons/cc_logo.png" type="image/x-icon">
</head>

<body>

    <?php include("nav1.php"); ?>

    <div class="HomeContainer">

        <div class="leftsidebar">
            <?php include("userSidebar.php"); ?>
        </div>



        <!-- Content -->
        <div class="content">
            <h2>Saved Posts</h2>

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($post = mysqli_fetch_assoc($result)): ?>
                    <div class="post">
                        <div class="postHeader">
                            <strong><?php echo htmlspecialchars($post['username']); ?></strong>
                            <small><?php echo htmlspecialchars($post['created_at']); ?></small>
                        </div>

                        <h3><?php echo htmlspecialchars($post['title']); ?></h3>
                        <p><?php echo htmlspecialchars($post['description']); ?></p>

                        <!-- If there is an image -->
                        <?php if (!empty($post['image_path'])): ?>
                            <div class="postImage">
                                <img src="../uploads/<?php echo htmlspecialchars($post['image_path']); ?>" alt="Attached Image"
                                    style="max-width: 100%; height: auto; margin-top:10px;">
                            </div>
                        <?php endif; ?>

                        <!-- If there is a file -->
                        <?php if (!empty($post['file_path'])): ?>
                            <div class="postFile" style="margin-top:10px;">
                                <a href="../uploads/<?php echo htmlspecialchars($post['file_path']); ?>" target="_blank">Download
                                    Attachment</a>
                            </div>
                        <?php endif; ?>

                        <a href="postPage.php?post_id=<?php echo $post['post_id']; ?>">View Post</a>

                        <!-- UNSAVE button (trigger modal) -->
                        <button onclick="openModal(<?php echo $post['post_id']; ?>)"
                            style="background-color: red; color: white; border: none; padding: 5px 10px; margin-top:10px; cursor:pointer; margin-left: 20px;">
                            Unsave
                        </button>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No saved posts yet 😢</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal -->
    <div id="unsaveModal" class="modal">
        <div class="modal-content">
            <h3>Are you sure you want to unsave this post?</h3>
            <form method="POST">
                <input type="hidden" id="confirm_unsave_post_id" name="confirm_unsave_post_id" value="">
                <button type="submit"
                    style="padding: 5px 10px; background: red; color: white; border: none; margin-top:10px;">Yes,
                    Unsave</button>
                <button type="button" onclick="closeModal()"
                    style="padding: 5px 10px; background: gray; color: white; border: none; margin-top:10px;">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function openModal(postId) {
            document.getElementById('unsaveModal').style.display = 'flex';
            document.getElementById('confirm_unsave_post_id').value = postId;
        }

        function closeModal() {
            document.getElementById('unsaveModal').style.display = 'none';
        }
    </script>
</body>

</html>