<?php
// Include database connection
include("db_conn.php");

// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Get logged-in user's account ID and student number
$account_id = $_SESSION['account_id'] ?? null;
$student_no = $_SESSION['student_no'] ?? null;

// Get search term and tag from GET request
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$tag = isset($_GET['tag']) ? mysqli_real_escape_string($conn, $_GET['tag']) : '';

// Base query to fetch posts
$getPost = "SELECT p.*, a.username 
            FROM post_tb p 
            JOIN student_tb a ON p.account_id = a.account_id 
            WHERE 1";

// Append conditions for search and tag filters
if (!empty($search)) {
    $getPost .= " AND p.title LIKE '%$search%'";
}
if (!empty($tag)) {
    $getPost .= " AND p.tag = '$tag'";
}

// Order posts by most recent
$getPost .= " ORDER BY p.post_id DESC";

// Execute the query
$result = mysqli_query($conn, $getPost);

// Check if posts exist
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        // Extract post details
        $post_id = $row['post_id'];
        $username = $row['username'];
        $title = $row['title'];
        $description = $row['description'];
        $created_at = $row['created_at'];
        $comments_count = $row['comments_count'];
        $like_count = $row['likes_count'];
        $tag = $row['tag'];

        // Fetch associated files for the post
        $getFiles = "SELECT file_url FROM post_files_tb WHERE post_id = $post_id";
        $filesResult = mysqli_query($conn, $getFiles);
        $files = [];
        if ($filesResult && mysqli_num_rows($filesResult) > 0) {
            while ($fileRow = mysqli_fetch_assoc($filesResult)) {
                $files[] = $fileRow['file_url'];
            }
        }

        // Check if the logged-in user liked the post
        $checkLike = mysqli_query($conn, "SELECT * FROM post_likes_tb WHERE post_id = $post_id AND account_id = '$account_id'");
        $userLiked = mysqli_num_rows($checkLike) > 0;

        // Fetch profile picture of the post owner
        $sqlpfpPostOwner = "SELECT s.profile_pic 
                            FROM post_tb p
                            JOIN student_tb s ON p.account_id = s.account_id
                            WHERE p.post_id = '$post_id'";
        $resultpfpPostOwner = mysqli_query($conn, $sqlpfpPostOwner);
        $rowpfpPostOwner = mysqli_fetch_assoc($resultpfpPostOwner);
        $profile_picture_post_owner = !empty($rowpfpPostOwner['profile_pic']) ? $rowpfpPostOwner['profile_pic'] : '../bg/sample10.png';

        // Fetch profile picture of the logged-in user
        $sqlpfpLoggedInUser = "SELECT profile_pic FROM student_tb WHERE account_id = '$account_id'";
        $resultpfpLoggedInUser = mysqli_query($conn, $sqlpfpLoggedInUser);
        $rowpfpLoggedInUser = mysqli_fetch_assoc($resultpfpLoggedInUser);
        $profile_picture_logged_in_user = !empty($rowpfpLoggedInUser['profile_pic']) ? $rowpfpLoggedInUser['profile_pic'] : '../bg/sample10.png';
        ?>

        <!-- Post container -->
        <div class="post"
            onclick="window.location.href='/ClassConnectURSB/php/postPage.php?post_id=<?php echo ($post_id); ?>&account_id=<?php echo urlencode($username); ?>'">
            <!-- Post header with profile picture and username -->
            <div class="postHeader">
                <div class="pfp">
                    <img src="<?php echo $profile_picture_post_owner; ?>" alt="Profile Picture" class="profile-img">
                </div>
                <div class="postHeaderPoster">
                    <div class="postHeaderCol">
                        <div><strong><?php echo htmlspecialchars($username); ?></strong></div>
                    </div>
                    <?php
                    // Format the post creation date
                    $formattedDate = date("F j, Y \a\\t g:i A", strtotime($created_at));
                    ?>
                    <div class="datetime"><?php echo $formattedDate; ?></div>
                </div>
            </div>

            <!-- Post title -->
            <h2><?php echo htmlspecialchars($title); ?></h2>

            <!-- Post tag -->
            <?php if (!empty($tag)): ?>
                <div class="tag" style="font-size: 14px; color: #666; margin-bottom: 8px;">
                    🏷️ Tag: <?php echo htmlspecialchars($tag); ?>
                </div>
            <?php endif; ?>

            <!-- Post description -->
            <div>
                <p><?php echo htmlspecialchars($description); ?></p>
            </div>

            <!-- Post files (images or documents) -->
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

            <!-- Interaction buttons (like and comment) -->
            <div class="interactionHeader">
                <!-- Like button -->
                <form method="POST" action="like_post.php" style="display: inline;">
                    <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                    <button type="submit" class="like-btn">
                        <img src="<?php echo $userLiked ? '../icons/dislike.svg' : '../icons/like.svg'; ?>"
                            alt="<?php echo $userLiked ? 'Unlike' : 'Like'; ?>">
                        <span><?php echo $like_count; ?></span>
                    </button>
                </form>

                <!-- Comment button -->
                <button class="commentBTN">
                    <img class="cmnt" src="../icons/comment.svg" alt="Comment">
                    <span><?php echo $comments_count; ?></span>
                </button>
            </div>
        </div>

        <?php
    }
} else {
    // Display message if no posts are found
    echo "<p style='text-align:center; margin-top:50px;'>No posts found 😢</p>";
}
?>