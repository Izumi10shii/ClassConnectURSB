<?php
include("db_conn.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$account_id = $_SESSION['account_id'] ?? null;
$student_no = $_SESSION['student_no'] ?? null;

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

if (!empty($search)) {
    $getPost = "SELECT p.*, a.username 
                FROM post_tb p 
                JOIN student_tb a ON p.account_id = a.account_id 
                WHERE p.title LIKE '%$search%' 
                ORDER BY p.post_id DESC";
} else {
    $getPost = "SELECT p.*, a.username 
                FROM post_tb p 
                JOIN student_tb a ON p.account_id = a.account_id 
                ORDER BY p.post_id DESC";
}

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

        // Fetch files
        $getFiles = "SELECT file_url FROM post_files_tb WHERE post_id = $post_id";
        $filesResult = mysqli_query($conn, $getFiles);
        $files = [];
        if ($filesResult && mysqli_num_rows($filesResult) > 0) {
            while ($fileRow = mysqli_fetch_assoc($filesResult)) {
                $files[] = $fileRow['file_url'];
            }
        }

        // Check if user liked
        $checkLike = mysqli_query($conn, "SELECT * FROM post_likes_tb WHERE post_id = $post_id AND account_id = '$account_id'");
        $userLiked = mysqli_num_rows($checkLike) > 0;

        // Profile pic of post owner
        $sqlpfpPostOwner = "SELECT s.profile_pic 
                            FROM post_tb p
                            JOIN student_tb s ON p.account_id = s.account_id
                            WHERE p.post_id = '$post_id'";
        $resultpfpPostOwner = mysqli_query($conn, $sqlpfpPostOwner);
        $rowpfpPostOwner = mysqli_fetch_assoc($resultpfpPostOwner);
        $profile_picture_post_owner = !empty($rowpfpPostOwner['profile_pic']) ? $rowpfpPostOwner['profile_pic'] : '../bg/sample10.png';

        // Profile pic of logged in user
        $sqlpfpLoggedInUser = "SELECT profile_pic FROM student_tb WHERE account_id = '$account_id'";
        $resultpfpLoggedInUser = mysqli_query($conn, $sqlpfpLoggedInUser);
        $rowpfpLoggedInUser = mysqli_fetch_assoc($resultpfpLoggedInUser);
        $profile_picture_logged_in_user = !empty($rowpfpLoggedInUser['profile_pic']) ? $rowpfpLoggedInUser['profile_pic'] : '../bg/sample10.png';
?>

        <div class="post"
            onclick="window.location.href='/ClassConnectURSB/php/postPage.php?post_id=<?php echo ($post_id); ?>&account_id=<?php echo urlencode($username); ?>'">
            <div class="postHeader">
                <div class="pfp">
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
                <form method="POST" action="like_post.php" style="display: inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <button type="submit" class="like-btn">
                        <img src="<?php echo $userLiked ? '../icons/dislike.svg' : '../icons/like.svg'; ?>"
                            alt="<?php echo $userLiked ? 'Unlike' : 'Like'; ?>">
                        <span><?php echo $like_count; ?></span>
                    </button>
                </form>

                <button class="commentBTN">
                    <img class="cmnt" src="../icons/comment.svg" alt="Comment">
                    <span><?php echo $comments_count; ?></span>
                </button>
            </div>
        </div>

<?php
    }
} else {
    echo "<p style='text-align:center; margin-top:50px;'>No posts found with that title 😢</p>";
}
?>
