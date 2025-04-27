<?php
include("db_conn.php");
session_start();

$username = $_SESSION['username'] ?? null;

// Handle UNSAVE if confirmed
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['confirm_unsave_post_id'])) {
    $unsavePostId = intval($_POST['confirm_unsave_post_id']);

    $deleteBookmark = "DELETE FROM bookmarks_tb WHERE username = '$username' AND post_id = $unsavePostId";
    mysqli_query($conn, $deleteBookmark);

    header("Location: saved_posts.php");
    exit();
}

// Fetch saved posts
$bookmarkQuery = "SELECT post_tb.* FROM bookmarks_tb 
                  JOIN post_tb ON bookmarks_tb.post_id = post_tb.post_id 
                  WHERE bookmarks_tb.username = '$username'
                  ORDER BY bookmarks_tb.bookmark_id DESC";

$result = mysqli_query($conn, $bookmarkQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Saved Posts</title>
    <link rel="stylesheet" href="../css/saved_posts.css">
</head>

<body>

    <nav class="homeHeader">
        <a href="#">
            <h1>Class Connect</h1>
        </a>
        <input class="search" type="text" placeholder="Search">
        <a href="addPost.php">
            <button class="addPostBtn">Create Post</button>
        </a>
        <a href="userPage.php">
            <div class="pfp profile">
                <img src="../bg/sample10.png" alt="Profile Picture">
            </div>
        </a>

    </nav>


    <!-- Sidebar Items -->
    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <div class="homebtn lsu">
                    <a href="home.php">Home</a>
                </div>
                <div class="savedpost lsu">
                    <a href="saved_posts.php">Saved Posts</a>
                </div>

                <div class="explorebtn lsu">
                    <a href="explorePage.php">
                        Explore Discussions
                    </a>
                </div>

                <div class="popularbtn lsu">File Storage</div>

                <div class="popularbtn lsu">
                    <a href="adminDashboard.php">
                        Admin Dashboard
                    </a>
                </div>

                <div class="popularbtn lsu">Settings</div>
            </div>
        </div>

        <div>
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
                            style="background-color: red; color: white; border: none; padding: 5px 10px; margin-top:10px; cursor:pointer;">
                            Unsave
                        </button>

                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No saved posts yet 😢</p>
            <?php endif; ?>
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