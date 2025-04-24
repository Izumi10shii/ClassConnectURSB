<?php
include("db_conn.php");

// Fetch comments for the given post_id
if (isset($_GET['post_id']) && is_numeric($_GET['post_id'])) {
    $post_id = intval($_GET['post_id']);
    $getComments = "SELECT * FROM comment_tb WHERE post_id = $post_id ORDER BY created_at DESC";
    $commentsResult = mysqli_query($conn, $getComments);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/postPage.css?v=2">
</head>

<body>
  <?php if (isset($commentsResult) && mysqli_num_rows($commentsResult) > 0): ?>
    <?php while ($comment = mysqli_fetch_assoc($commentsResult)): ?>
      <div class="comment">
        <div class="commentUserRow">
          <div class="pfp"></div>
          <div><?php echo htmlspecialchars($comment['user_id']); ?></div>
          <div><?php echo htmlspecialchars($comment['created_at']); ?></div>
        </div>
        <div><?php echo htmlspecialchars($comment['comment_desc']); ?></div>
        <div class="commentBTNRow">
          <button class="like">like</button>
          <button class="commentBTN">comment</button>
        </div>
      </div>
    <?php endwhile; ?>
  <?php else: ?>
    <p>No comments available for this post.</p>
  <?php endif; ?>
</body>
</html>