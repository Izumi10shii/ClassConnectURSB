<?php
// Include database connection
include("db_conn.php");

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect to login page if user is not logged in
if (!isset($_SESSION['account_id'])) {
    header("Location: loginpage.php");
    exit;
}

// Grab the search term and tag from the GET request, if any
$search = isset($_GET['search']) ? $_GET['search'] : '';
$tagFilter = isset($_GET['tag']) ? $_GET['tag'] : '';
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
    <!-- Navigation bar -->
    <nav class="homeHeader">
        <!-- Logo -->
        <a href="home.php" class="logo">
            <img src="http://localhost/ClassConnectURSB/icons/cc_logo.png" alt="Class Connect Logo"
                style="height: 200px; margin-top: 20px; margin-left: -30px;">
        </a>

        <!-- Search bar -->
        <form class="searchForm" method="GET" action="" style="text-align: center; margin-top: 20px;">
            <input class="search" type="text" name="search" placeholder="Search by title..."
                value="<?php echo htmlspecialchars($search); ?>" style="width: 50%; padding: 10px;">
            <input type="hidden" name="tag" value="<?php echo htmlspecialchars($tagFilter); ?>">
        </form>

        <!-- Action buttons -->
        <div class="actions">
            <!-- Link to create a new post -->
            <a href="addPost.php" class="addPostBtn">Create Post</a>
            <!-- Link to user profile page -->
            <a href="userPage.php">
                <div class="pfp">
                    <?php
                    // Fetch the profile picture of the logged-in user
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

    <!-- Main content container -->
    <div class="HomeContainer">
        <!-- Include the user sidebar -->
        <?php include("userSidebar.php"); ?>

        <!-- Scrollable container for posts -->
        <div class="scrollContainer">
            <!-- Dropdown for filtering posts by tag -->
            <form method="GET" action="" class="selectTag" style="margin-left: 20px; margin-bottom: 20px;">
                <label for="dropdown">Choose Topics:</label>
                <select id="dropdown" name="tag" onchange="this.form.submit()">
                    <option value="">-- All Tags --</option>
                    <option value="General" <?php if ($tagFilter === 'General') echo 'selected'; ?>>General</option>
                    <option value="Ethics" <?php if ($tagFilter === 'Ethics') echo 'selected'; ?>>Ethics</option>
                    <option value="ITE 7" <?php if ($tagFilter === 'ITE 7') echo 'selected'; ?>>ITE 7</option>
                    <option value="IT 4" <?php if ($tagFilter === 'IT 4') echo 'selected'; ?>>IT 4</option>
                    <option value="IT 5" <?php if ($tagFilter === 'IT 5') echo 'selected'; ?>>IT 5</option>
                    <option value="IT 6" <?php if ($tagFilter === 'IT 6') echo 'selected'; ?>>IT 6</option>
                    <option value="OOP" <?php if ($tagFilter === 'OOP') echo 'selected'; ?>>OOP</option>
                    <option value="IT 7" <?php if ($tagFilter === 'IT 7') echo 'selected'; ?>>IT 7</option>
                    <option value="PE 4" <?php if ($tagFilter === 'PE 4') echo 'selected'; ?>>PE 4</option>
                </select>
                <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
            </form>

            <!-- Include the post component to display posts -->
            <?php
            $_GET['search'] = $search;
            $_GET['tag'] = $tagFilter;
            include("postComponent.php");
            ?>
        </div>
    </div>
</body>

</html>
