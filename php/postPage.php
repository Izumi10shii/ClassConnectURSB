<?php
include("db_conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Home</title>
  <link rel="stylesheet" href="../css/postPage.css?v=2" />
</head>

<body>
  <nav class="homeHeader">
    <h1>Class Connect</h1>
    <input class="search" type="text" placeholder="Search" />
    <button class="addPostBtn">Add new Post</button>
    <a href="userPage.html">
      <div class="pfp profile"></div>
    </a>
  </nav>

  <div class="HomeContainer">
    <div class="leftSidebar">
      <div class="leftSideUp">
        <li class="lsu">Home</li>
        <li class="lsu">Explore</li>
        <li class="lsu">Popular</li>
      </div>
      <div class="leftSideDown">
        <h2>Communities</h2>
        <div>
          <div>
            <a href="communityPage.html">
              <div class="pfp"></div>
              <div>IT5 - OOP</div>
            </a>
          </div>
          <div>
            <div class="pfp"></div>
            <div>IT6 - DBMS</div>
          </div>
          <div>
            <div class="pfp"></div>
            <div>ITE 7 - AppDev</div>
          </div>
        </div>
      </div>
    </div>

    <div class="scrollContainer">
      <!-- Include post PHP components -->

      <?php
      $post_id = $_GET['post_id'] ?? null; // Get post_id from URL parameter

      if ($post_id && is_numeric($post_id)) { // Validate post_id
        $post_id = intval($post_id); // Sanitize post_id
        //echo "<p>Debug: Received post_id = $post_id</p>"; // Debug output

        $getPostID = "SELECT * FROM post_tb WHERE post_id = $post_id";
        $result = mysqli_query($conn, $getPostID);

        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $title = $row['title'];
            $description = $row['description'];
            //echo "<p>Debug: Post found - Title: $title, User ID: $user_id</p>"; // Debug output
          }
        } else {
          //echo "<p>Debug: No post found for post_id: $post_id</p>"; // Debug output
        }
      } else {
        //echo "<p>Debug: Invalid or missing post ID.</p>"; // Debug output
      }
      ?>

      <div class="post">
        <?php if (isset($user_id) && isset($title) && isset($description)): ?>
          <div class="postHeader">
            <div class="pfp"></div>
            <div class="postHeaderPoster">
              <div class="postHeaderCol">
                <p>ITE7</p>
                <div><?php echo htmlspecialchars($user_id); ?></div>
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
          <button class="like">like</button>
          <button class="commentBTN">comment</button>
          <button class="share">share</button>
        </div>
      </div>

      <div class="commentSection">
        <input class="inputComment" type="text" placeholder="Add Comment" />
        <button>Cancel</button>
        <button>Comment</button>

        <div class="comment">
          <div class="commentUserRow">
            <div class="pfp"></div>
            <div>Username</div>
            <div>1hr ago</div>
          </div>
          <div>Sample comment text...</div>
          <div class="commentBTNRow">
            <button class="like">like</button>
            <button class="commentBTN">comment</button>
          </div>
        </div>

      </div>
    </div>
<!--
    <div class="rightSidebar">
      <h2>Friends</h2>
      <div>
        <div class="pfp"></div>
        <div>Person 1</div>
      </div>
      <div>
        <div class="pfp"></div>
        <div>Person 2</div>
      </div>
      <div>
        <div class="pfp"></div>
        <div>Person 3</div>
      </div>
      <button>Inbox</button>
    </div>
  </div>
        -->
</body>

</html>