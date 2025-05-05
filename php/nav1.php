<?php
ob_start();

if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
include("db_conn.php");

if (!isset($_SESSION['student_no'])) {
  header("Location: loginpage.php");
  exit();
}

$student_no = $_SESSION['student_no'];
$account_id = $_SESSION['account_id'];
?>


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
      background: linear-gradient(to right, #112336, #3787a7);
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      height: 80px;
      padding: 20px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      gap: 20px;
      overflow: hidden;
    }

    .logo {
      text-decoration: none;
      color: white;
      font-size: 32px;
      font-weight: bold;
      white-space: nowrap;
    }


    .actions {
      display: flex;
      align-items: center;
      gap: 20px;
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
    <a href="home.php" class="logo" ;>
      <img src="http://localhost/ClassConnectURSB/icons/cc_logo.png" alt="Class Connect Logo"
        style="height: 200px; margin-top: 20px; margin-left: -50px;">
    </a>



    <div class="actions">
      <a href="userPage.php">
        <div class="pfp">
          <?php
          $sqlpfp = "SELECT profile_pic FROM student_tb WHERE account_id = '$account_id'";
          $resultpfp = mysqli_query($conn, $sqlpfp);
          $rowpfp = mysqli_fetch_assoc($resultpfp);

          $profile_picture = !empty($rowpfp['profile_pic']) ? $rowpfp['profile_pic'] : '../bg/sample10.png';
          ?>
          <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-img">
        </div>
      </a>
    </div>
  </nav>
</body>

</html>