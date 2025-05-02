<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Connect</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      transition: all 0.3s ease;
    }

    .homeHeader {
      background: linear-gradient(to right, #14131a, #282633);
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      height: 80px;
      padding: 20px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      gap: 20px;
    }

    .logo {
      text-decoration: none;
      color: white;
      font-size: 32px;
      font-weight: bold;
      white-space: nowrap;
    }

    .search {
      width: 40%;
      margin-right: -8%;
      padding: 10px 20px;
      border-radius: 30px;
      border: none;
      font-size: 1rem;
      outline: none;
      color: #1c1b24;
      background-color: #272735;
    }

    .actions {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .addPostBtn {
      background-color: white;
      color: #1c1b24;
      padding: 8px 20px;
      font-weight: bold;
      border-radius: 20px;
      border: 1px solid white;
      text-decoration: none;
      transition: 0.3s ease;
      cursor: pointer;
      white-space: nowrap;
    }

    .addPostBtn:hover {
      background: linear-gradient(45deg, #fffb00, #dd2a7b, #8134af, #515bd4);
      color: white;
      transform: scale(1.05);
      border: 1px solid white;
      background-size: 200% 200%;
      animation: rainbowMove 3s linear infinite;
    }

    .profile-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #ccc;
    }

    @keyframes rainbowMove {
      0% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }

      100% {
        background-position: 0% 50%;
      }
    }
  </style>
  
</head>

<body>
  <nav class="homeHeader">
  <a href="home.php" class="logo";>
  <img src="http://localhost/ClassConnectURSB/icons/cc_logo.png" alt="Class Connect Logo"  style="height: 200px; margin-top: 20px; margin-left: -50px;">
</a>


    <input class="search" type="text" placeholder="Search...">

    <div class="actions">
      <a href="addPost.php" class="addPostBtn">Create Post</a>
      <a href="userPage.php">
        <div class="pfp">
          <?php
          $student_no = $_SESSION['student_no'];
          $sql = "SELECT profile_pic FROM student_tb WHERE student_no = '$student_no'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);

          $profile_picture = !empty($row['profile_pic']) ? $row['profile_pic'] : '../bg/sample10.png';
          ?>
          <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-img">
        </div>
      </a>
    </div>
  </nav>
</body>

</html>