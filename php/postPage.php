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
  <link rel="stylesheet" href="../css/postPage.css?v=2" />
</head>

<body>
  <nav class="homeHeader">
    <a href="home.php">
      <h1>Class Connect</h1>
    </a>
    <input class="search" type="text" placeholder="Search" />
    <button class="addPostBtn">Add new Post</button>
    <a href="userPage.html">
      <div class="pfp profile"></div>
    </a>
  </nav>

  <div class="HomeContainer">
    <div class="leftSidebar">
      <div class="leftSideUp">
        <div class="homebtn lsu">Home</div>
        <div class="popularbtn lsu">Profile</div>

        <div class="explorebtn lsu">
          <a href="explorePage.php">
            Explore Discussions
          </a>
        </div>

        <div class="popularbtn lsu">File Storage</div>

        <div class="popularbtn lsu">
          <a href="adminUsersList.php">
            Registered Users
          </a>
        </div>

        <div class="popularbtn lsu">
          <a href="adminPostsList.php">
            Post Management
          </a>
        </div>

        <div class="popularbtn lsu">Settings</div>
      </div>
      <div class="leftSideDown">
        <div>
          <div></div>
          <div></div>
          <div></div>
        </div>
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
            $like_count = $row['likes_count']; // Use the likes_count field directly
            $comments_count = $row['comments_count']; // Use the comments_count field directly
      
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
                <p>ITE7</p>
                <div><?php echo htmlspecialchars($username); ?></div>
              </div>
              <p>1hr ago</p>
            </div>
          </div>
          <h2><?php echo htmlspecialchars($title); ?></h2>
          <div><?php echo htmlspecialchars($description); ?></div>
        <?php else: ?>
          <p>Post details are not available.</p>
        <?php endif; ?>

        <div class="interactionHeader">
          <!-- Form to handle like/unlike -->
          <form method="POST" action="like_post.php" style="display: inline;">
            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
            <button type="submit" class="like-btn">
              <?php echo $userLiked ? "👎 Unlike" : "👍 Like"; ?>
            </button>
          </form>
          <span><?php echo "Likes :" .$like_count; ?></span>
          <button class="commentBTN" onclick="event.stopPropagation();">Comment</button>
          <span><?php echo  "Comments: " . $comments_count; ?></span>
          <button class="share" onclick="event.stopPropagation();">share</button>
        </div>
      </div>

      <div class="commentSection">
        <form action="?post_id=<?php echo $post_id; ?>" method="POST" class="commentForm">
          <input class="inputComment" name="comment_desc" type="text" placeholder="Add Comment" required />
          <button class="cancelBTN" type="button">Cancel</button>
          <input class="addComment" type="submit" value="Comment">
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
</body>

</html>