<?php
session_start();
include("db_conn.php");

$account_id = $_SESSION['account_id'];

// Check if owner of post
$post_id = isset($_GET['post_id']) ? $_GET['post_id'] : null;

if ($post_id) {
  // Simple query to get the post from the database using the post_id
  $query = "SELECT * FROM post_tb WHERE post_id = $post_id";
  $result = mysqli_query($conn, $query);

  // Fetch the post data if available
  if (mysqli_num_rows($result) > 0) {
    $post = mysqli_fetch_assoc($result); // Fetch the post as an associative array
  } else {
    // Handle case if no post is found (optional)
    echo "Post not found.";
  }
} else {
  // Handle case if no post_id is passed (optional)
  echo "Invalid post ID.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment_desc'])) {
  $username = $_SESSION['username'] ?? null; // Use session username
  $account_id = $_SESSION['account_id'] ?? null; // Use session account_id
  $post_id = isset($_GET['post_id']) && is_numeric($_GET['post_id']) ? intval($_GET['post_id']) : null;
  $comment_desc = mysqli_real_escape_string($conn, $_POST['comment_desc']);

  if ($username && $post_id && $comment_desc) {
    $addComment = "INSERT INTO comment_tb(account_id, post_id, comment_desc) VALUES ('$account_id', '$post_id', '$comment_desc')";
    if (mysqli_query($conn, $addComment)) {
      // Increment the comments_count in post_tb
      $updateCommentsCount = "UPDATE post_tb SET comments_count = comments_count + 1 WHERE post_id = $post_id";
      mysqli_query($conn, $updateCommentsCount);
    }
  }

  header("Location: postPage.php?post_id=$post_id");
  exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Post Page</title>
  <link rel="stylesheet" href="../css/postPage.css" />
  <link rel="icon" href="../icons/cc_logo.png" type="image/x-icon">
</head>

<body>
  <?php include("nav1.php"); ?>

  <div class="HomeContainer">
    <div class="leftsidebar">
      <?php include("userSidebar.php"); ?>
    </div>


    <div class="scrollContainer">
      <?php
      $post_id = $_GET['post_id'] ?? null; // Get post_id from URL parameter

      if ($post_id && is_numeric($post_id)) { // Validate post_id
        $post_id = intval($post_id); // Sanitize post_id

        $getPostID = "SELECT p.*, a.username 
        FROM post_tb p 
        JOIN student_tb a ON p.account_id = a.account_id 
        WHERE p.post_id = $post_id";


        $result = mysqli_query($conn, $getPostID);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $username = $row['username'];
            $title = $row['title'];
            $tag = $row['tag'];
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

            // Check if this user already bookmarked it
            $currentUser = $_SESSION['account_id'];
            $checkBookmark = mysqli_query($conn, "SELECT * FROM bookmarks_tb WHERE post_id = $post_id AND account_id = '$account_id'");
            $userBookmarked = mysqli_num_rows($checkBookmark) > 0;

            // Check if this user already liked it
            $currentUser = $_SESSION['account_id'];
            $checkLike = mysqli_query($conn, "SELECT * FROM post_likes_tb WHERE post_id = $post_id AND account_id = '$account_id'");
            $userLiked = mysqli_num_rows($checkLike) > 0;
          }
        }
      }

      // Fetch comments for the post
      if (isset($post_id)) {
        $getComments = "
  SELECT c.*, s.profile_pic, s.username
  FROM comment_tb c
  JOIN student_tb s ON c.account_id = s.account_id
  WHERE c.post_id = $post_id
  ORDER BY c.created_at DESC
";


        $commentsResult = mysqli_query($conn, $getComments);
      }

      // Fetch the profile picture for the poster (author of the post)
      $sqlpfp = "SELECT s.profile_pic 
                    FROM post_tb p
                    JOIN student_tb s ON p.account_id = s.account_id
                    WHERE p.post_id = '$post_id'"; // Use the poster's username
      $resultpfp = mysqli_query($conn, $sqlpfp);
      $rowpfp = mysqli_fetch_assoc($resultpfp);

      // Use the poster's profile picture or a default if not available
      $profile_picture = !empty($rowpfp['profile_pic']) ? $rowpfp['profile_pic'] : '../bg/sample10.png';



      ?>

      <div class="post">
        <?php if (isset($username) && isset($title) && isset($description)): ?>
          <div class="postHeader">
            <div class="postHeaderRow">
              <div class="pfpic">
                <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-img">
              </div>
              <div class="postHeaderPoster">
                <div class="postHeaderCol">
                  <div><strong><?php echo htmlspecialchars($username); ?></strong></div>
                  <div><?php echo htmlspecialchars($created_at); ?></div>
                </div>
              </div>
              <div class="postActions">
                <!-- Delete post -->
                <?php if ($_SESSION['account_id'] == $post['account_id']) { ?>
                  <a class="deletemypost" href="deletemypost.php?post_id=<?php echo $post['post_id']; ?>"
                    onclick="return confirm('Are you sure you want to delete this post?');">
                    <button class="delete-post-btn">
                      <img src="../icons/delete.svg" alt="Delete Post" class="delete-icon">
                    </button>
                  </a>
                <?php } ?>

                <button onclick="showReportForm(<?php echo $post_id; ?>)" class="report-btn">
                  <img src="../icons/flag.svg" alt="Report">
                </button>
                <form method="POST" action="bookmark_post.php" style="display: inline;">
                  <input type="hidden" name="post_id" value="<?= $post_id ?>">
                  <button type="submit" class="bookmark-btn">
                    <img id="bookmarkIcon"
                      src="<?= $userBookmarked ? '../icons/bookmarkadd.svg' : '../icons/bookmark.svg' ?>" alt="Bookmark">
                  </button>
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
              <span><?php echo $like_count; ?></span>
            </button>
          </form>
          <button class="commentBTN">
            <img src="../icons/comment.svg" alt="">
            <span><?php echo $comments_count; ?></span>
          </button>
          <button class="share" onclick="copyURL(event)">
            <img src="../icons/savelink.svg" alt="">
          </button>
        </div>

        <!-- Report Modal -->
        <div id="reportModal-<?php echo $post_id; ?>" class="reportModal">
          <div class="reportModalContent">
            <h2>Report Post</h2>
            <form method="POST" action="reportPost.php">
              <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
              <label for="reason">Reason:</label>
              <input type="text" id="reason" name="reason" placeholder="Enter your reason..." required>

              <div class="reportModalButtons">
                <button type="submit" class="submitReport">Submit</button>
                <button type="button" onclick="hideReportForm(<?php echo $post_id; ?>)"
                  class="cancelReport">Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="commentSection">
        <form action="?post_id=<?php echo $post_id; ?>" method="POST" class="commentForm">
          <input class="inputComment" name="comment_desc" type="text" placeholder="Add a comment..." required />
          <button class="addComment" type="submit">
            <img src="../icons/comment.svg" alt="Send Comment">
          </button>
        </form>

        <?php if (isset($commentsResult) && mysqli_num_rows($commentsResult) > 0): ?>
          <?php while ($comment = mysqli_fetch_assoc($commentsResult)): ?>
            <div class="comment">
              <div class="commentUserRow">
                <div class="pfp">
                  <img src="<?php echo !empty($comment['profile_pic']) ? $comment['profile_pic'] : '../bg/sample10.png'; ?>"
                    class="profile-img" alt="Profile Picture">
                </div>
                <div class="commentUser">
                  <strong><?php echo htmlspecialchars($comment['username']); ?></strong>

                  <!-- Check if the logged-in user is the owner of the comment -->
                  <?php if (isset($_SESSION['account_id']) && $_SESSION['account_id'] == $comment['account_id']): ?>
                    <!-- Display delete button only for the original commenter -->
                    <a class="deletemycomment"
                      href="deletemycomment.php?comment_id=<?= $comment['comment_id'] ?>&post_id=<?= $post_id ?>"
                      onclick="return confirm('Are you sure you want to delete this comment?');">
                      <button class="delete-comment-btn">
                        <img src="../icons/delete.svg" alt="Delete Comment" class="delete-icon">
                      </button>
                    </a>
                  <?php endif; ?>

                </div>
              </div>

              <div class="commentText"><?php echo htmlspecialchars($comment['comment_desc']); ?></div>



              <!-- Reply Button -->
              <div class="commentActions">
                <!-- Like Button -->
                <form method="POST" action="like_comment.php" class="likeForm1">
                  <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">

                  <?php
                  $username = $_SESSION['username'];
                  $commentId = $comment['comment_id'];

                  // Check if user has already liked the comment
                  $checkLikeQuery = "SELECT * FROM comment_likes_tb WHERE comment_id = $commentId AND account_id = '$account_id'";
                  $checkLikeResult = mysqli_query($conn, $checkLikeQuery);



                  $likeCountQuery = "SELECT COUNT(*) AS like_count FROM comment_likes_tb WHERE comment_id = $commentId";
                  $likeCountResult = mysqli_query($conn, $likeCountQuery);
                  $likeCount = mysqli_fetch_assoc($likeCountResult)['like_count'];



                  if (mysqli_num_rows($checkLikeResult) > 0): ?>
                    <button type="submit" class="like-btn1 disliked">
                      <img src="../icons/dislike.svg" alt="Dislike" class="like-icon1">
                      <div class="likeCount1" style="margin-left: 8px;"><?php echo $likeCount; ?></div>
                    </button>
                  <?php else: ?>
                    <button type="submit" class="like-btn1">
                      <img src="../icons/like.svg" alt="Like" class="like-icon1">
                      <div class="likeCount1" style="margin-left: 8px;"><?php echo $likeCount; ?></div>
                    </button>
                  <?php endif; ?>
                </form>

                <!-- Reply Button -->
                <button class="reply-btn1" onclick="toggleReplyForm(<?php echo $comment['comment_id']; ?>)">
                  <img src="../icons/reply.svg" alt="Reply" class="reply-icon1">
                </button>
              </div>



              <!-- Reply Form (Initially hidden) -->
              <div class="replyForm" id="replyForm-<?php echo $comment['comment_id']; ?>" style="display: none;">
                <form action="add_reply.php" method="POST">
                  <input type="hidden" name="comment_id" value="<?php echo $comment['comment_id']; ?>">
                  <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                  <textarea class="replybox" name="reply_desc" placeholder="Add a reply..." required></textarea>
                  <button class="replybtn" type="submit">Reply</button>
                </form>
              </div>

              <!-- Display Replies -->
              <?php
              // Fetch replies for this comment
              $getReplies = "SELECT cr.*, u.username
FROM comment_replies_tb cr
JOIN student_tb u ON cr.account_id = u.account_id
WHERE cr.parent_comment_id = {$comment['comment_id']}
ORDER BY cr.created_at ASC;
";
              $repliesResult = mysqli_query($conn, $getReplies);


              if ($repliesResult && mysqli_num_rows($repliesResult) > 0) {
                while ($reply = mysqli_fetch_assoc($repliesResult)) {
              ?>
                  <div class="comment-reply">
                    <div class="reply-text-content">
                      <span class="reply-username"><?= htmlspecialchars($reply['username']) ?>:</span>
                      <span class="reply-text"><?= htmlspecialchars($reply['reply_desc']) ?></span>
                    </div>

                    <?php if (isset($_SESSION['account_id']) && $_SESSION['account_id'] == $reply['account_id']): ?>
                      <a class="deletemyreply"
                        href="deletemyreply.php?reply_id=<?= $reply['reply_id'] ?>&post_id=<?= $reply['post_id'] ?>"
                        onclick="return confirm('Are you sure you want to delete this reply?');">
                        <button class="delete-reply-btn">
                          <img src="../icons/delete.svg" alt="Delete Reply" class="delete-icon">
                        </button>
                      </a>
                    <?php endif; ?>
                  </div>
              <?php
                }
              }




              ?>
            </div>
          <?php endwhile; ?>
        <?php else: ?>
          <p class="noComments">No comments yet. Be the first to comment!</p>
        <?php endif; ?>
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

      function copyURL(event) {
        event.stopPropagation();

        const urlToCopy = window.location.href;

        navigator.clipboard.writeText(urlToCopy)
          .then(() => {
            alert('Link copied to clipboard! 📋'); // Optional: show message
          })
          .catch(err => {
            console.error('Failed to copy: ', err);
          });
      }

      function changeBookmarkIcon() {
        document.getElementById('bookmarkIcon').src = '../icons/bookmarkadd.svg';
      }

      function toggleReplyForm(commentId) {
        const replyForm = document.getElementById('replyForm-' + commentId);
        replyForm.style.display = (replyForm.style.display === 'none' || replyForm.style.display === '') ? 'block' : 'none';
      }
    </script>


</body>

</html>