<?php
include("db_conn.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['account_id'])) {
    header("Location: loginpage.php");
    exit;
}

// Grab the search term if any, so it's available for the input field and passed to postComponent
$search = isset($_GET['search']) ? $_GET['search'] : '';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css">
    <link rel="icon" href="../icons/cc_logo.png" type="image/x-icon">
</head>

<body>
    <nav class="homeHeader">
        <a href="home.php" class="logo">
            <img src="http://localhost/ClassConnectURSB/icons/cc_logo.png" alt="Class Connect Logo"
                style="height: 200px; margin-top: 20px; margin-left: -50px;">

        </a>

        <!-- Search bar -->
        <form class="searchForm" method="GET" action="" style="text-align: center; margin-top: 20px;">
            <input class="search" type="text" name="search" placeholder="Search by title..."
                value="<?php echo htmlspecialchars($search); ?>" style="width: 50%; padding: 10px;">
        </form>

        <div class="actions">
            <a href="addPost.php" class="addPostBtn">Create Post</a>
            <a href="userPage.php">
                <div class="pfp">
                    <?php
                    $account_id = $_SESSION['account_id'];
                    $sql = "SELECT profile_pic FROM student_tb WHERE account_id = '$account_id'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $profile_picture = !empty($row['profile_pic']) ? $row['profile_pic'] : '../bg/sample10.png';
                    ?>
                    <img src="<?php echo $profile_picture; ?>" alt="Profile Picture" class="profile-imgs">
                </div>
            </a>
        </div>
    </nav>

    <div class="HomeContainer">
        <?php include("userSidebar.php"); ?>
        <div class="scrollContainer">
        <div class="selectTag">

<label for="dropdown">Choose Topics:</label>
<select id="dropdown" name="dropdown">
    <option value="option1">Ethics</option>
    <option value="option2">ITE 7</option>
    <option value="option3">IT 4</option>
    <option value="option3">IT 5</option>
    <option value="option3">IT 6</option>
    <option value="option3">OOP</option>
    <option value="option3">IT 7</option>
    <option value="option3">PE 4</option>
</select>
</div>                

            <?php
            // Inject search into included file
            $_GET['search'] = $search;
            include("postComponent.php");
            ?>
        </div>
    </div>
</body>

</html>