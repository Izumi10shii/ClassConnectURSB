<?php
include("db_conn.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Post Page</title>
  <link rel="stylesheet" href="../css/postPage.css" />
</head>

<body>
  <nav class="homeHeader">
    <a href="home.php">
      <h1>Class Connect</h1>
    </a>
    <input class="search" type="text" placeholder="Search" />
    <button class="addPostBtn">Add new Post</button>
    <a href="userPage.php">
      <div class="pfp profile"></div>
    </a>
  </nav>

  <div class="HomeContainer">
    <div class="leftSidebar">
      <div class="leftSideUp">
        <div class="homebtn lsu"><a href="home.php">Home</a></div>
        <div class="popularbtn lsu">Profile</div>

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
    
    <div class="scrollContainer">
      <?php
      $post_id = $_GET['post_id'] ?? null; // Get post_id from URL parameter
      
      if ($post_id && is_numeric($post_id)) { // Validate post_id
        $post_id = intval($post_id); // Sanitize post_id
      
        $getPostID = "SELECT * FROM post_tb WHERE post_id = $post_id";
        $result = mysqli_query($conn, $getPostID);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $title = $row['title'];
            $description = $row['description'];
            $created_at = $row['created_at'];
            $like_count = $row['likes_count']; // Use the likes_count field directly
            $comments_count = $row['comments_count']; // Use the comments_count field directly
      
            // Fetch images for the post
            $getImages = "SELECT file_url FROM post_files_tb WHERE post_id = $post_id";
            $imagesResult = mysqli_query($conn, $getImages);
            $images = [];
            if ($imagesResult && mysqli_num_rows($imagesResult) > 0) {
              while ($imageRow = mysqli_fetch_assoc($imagesResult)) {
                $images[] = $imageRow['file_url'];
              }
            }

            // Check if this user already liked it
            $currentUser = $_SESSION['username'];
            $checkLike = mysqli_query($conn, "SELECT * FROM post_likes_tb WHERE post_id = $post_id AND username = '$currentUser'");
            $userLiked = mysqli_num_rows($checkLike) > 0;
          }
        }
      }

      if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_desc'])) {
        $username = $_SESSION['username'] ?? null; // Use session username
        $post_id = $_GET['post_id'] ?? null;
        $comment_desc = $_POST['comment_desc'];

        if ($username && $post_id && $comment_desc) {
          $addComment = "INSERT INTO comment_tb(username, post_id, comment_desc) VALUES ('$username', '$post_id', '$comment_desc')";
          if (mysqli_query($conn, $addComment)) {
            // Increment the comments_count in post_tb
            $updateCommentsCount = "UPDATE post_tb SET comments_count = comments_count + 1 WHERE post_id = $post_id";
            mysqli_query($conn, $updateCommentsCount);
          }
        }
      }

      // Fetch comments for the post
      if (isset($post_id)) {
        $getComments = "SELECT * FROM comment_tb WHERE post_id = $post_id ORDER BY created_at DESC";
        $commentsResult = mysqli_query($conn, $getComments);
      }
      ?>

      <div class="post">
        <?php if (isset($username) && isset($title) && isset($description)): ?>
          <div class="postHeader">
            <div class="pfp"></div>
            <div class="postHeaderPoster">
              <div class="postHeaderCol">
                <div><strong><?php echo htmlspecialchars($username); ?></strong></div>
                <div><?php echo htmlspecialchars($created_at); ?></div>
              </div>
            </div>

            <!-- Report and Bookmark Buttons -->
            <div class="postActions">
              <!-- Report Button -->
              <button onclick="showReportForm(<?php echo $post_id; ?>)" class="report-btn">
                <img src="../icons/flag.svg" alt="Report">
              </button>

              <!-- Bookmark Button (submit form) -->
              <form method="POST" action="bookmark_post.php" style="display: inline;">
                <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
                <button type="submit" class="bookmark-btn">
                  <img src="../icons/bookmark.svg" alt="Bookmark">
                </button>
              </form>

            </div>

            <!-- Hidden Report Form -->
            <div id="reportModal-<?php echo $post_id; ?>" class="report-modal">
              <div class="report-modal-content">
                <form action="reportPost.php" method="POST">
                  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                  <textarea class="reason" name="reason" placeholder="Write your reason..." required></textarea>
                  <div class="modal-buttons">
                    <button type="submit">Submit</button>
                    <button type="button" onclick="hideReportForm(<?php echo $post_id; ?>)">Cancel</button>
                  </div>
                </form>
              </div>
            </div>

          </div>
          <h2><?php echo htmlspecialchars($title); ?></h2>
          <div><?php echo htmlspecialchars($description); ?></div>

          <!-- Display images -->
          <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-top: 10px;">
            <?php foreach ($images as $file): ?>
              <?php
              $fileExtension = pathinfo($file, PATHINFO_EXTENSION);
              if (strtolower($fileExtension) === 'pdf'): ?>
                <!-- Display PDF -->
                <embed src="<?php echo $file; ?>" type="application/pdf"
                  style="width: 400px; height: 400px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
              <?php else: ?>
                <!-- Display Image -->
                <img src="<?php echo $file; ?>" alt="Post File"
                  style="width: 400px; height: 400px; object-fit: cover; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
              <?php endif; ?>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p>Post details are not available.</p>
        <?php endif; ?>

        <div class="interactionHeader">
          <!-- Form to handle like/unlike -->
          <form method="POST" action="like_post.php" style="display: inline;">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <button type="submit" class="like-btn">
              <img src="<?php echo $userLiked ? '../icons/dislike.svg' : '../icons/like.svg'; ?>"
                alt="<?php echo $userLiked ? 'Unlike' : 'Like'; ?>">
            </button>
          </form>
          <span><?php echo "Likes :" . $like_count; ?></span>
          <button class="commentBTN" onclick="event.stopPropagation();"><img src="../icons/comment.svg" alt=""></button>
          <span><?php echo "Comments: " . $comments_count; ?></span>
          <button class="share" onclick="event.stopPropagation();"><img src="../icons/savelink.svg" alt=""></button>
        </div>
      </div>

      <div class="commentSection">
        <form action="?post_id=<?php echo $post_id; ?>" method="POST" class="commentForm">
          <input class="inputComment" name="comment_desc" type="text" placeholder="Add Comment" required />
          <button class="addComment" type="submit"><img src="../icons/comment.svg" alt=""></button>
        </form>

        <?php if (isset($commentsResult) && mysqli_num_rows($commentsResult) > 0): ?>
          <?php while ($comment = mysqli_fetch_assoc($commentsResult)): ?>
            <div class="comment">
              <div class="commentUserRow">
                <div class="pfp"></div>
                <div><?php echo htmlspecialchars($comment['username']); ?></div>
              </div>
              <div><?php echo htmlspecialchars($comment['comment_desc']); ?></div>
              <div class="commentBTNRow">
                <button class="like">Like</button>
                <button class="commentBTN">Comment</button>
              </div>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p>No comments available for this post.</p>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <script>
    function showReportForm(postId) {
      const modal = document.getElementById('reportModal-' + postId);
      if (modal) {
        modal.style.display = 'flex';
      }
    }

    function hideReportForm(postId) {
      const modal = document.getElementById('reportModal-' + postId);
      if (modal) {
        modal.style.display = 'none';
      }
    }
  </script>


</body>

</html>