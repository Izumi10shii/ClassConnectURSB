<?php
include("db_conn.php");
if (session_status() === PHP_SESSION_NONE) {
    session_start();

    if (!isset($_SESSION['student_no'])) {
        header("Location: login.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css">

</head>

<body>
    <nav class="homeHeader">
        <a href="home.php" class="logo">Class Connect</a>


        <input class="search" type="text" placeholder="Search...">

        <div class="actions">
            <a href="addPost.php" class="addPostBtn">Create Post</a>
            <a href="userPage.php">
                <div class="pfp"></div>
            </a>
        </div>
    </nav>

    <div class="HomeContainer">

        <?php
        include("userSidebar.php");
        ?>
        <div class="scrollContainer">

            <div class="exploreContainer">


                <div class="collegeDepartment">
                </div>
                <label for="dropdown">
                    <h2>Select Discussions</h2>
                </label>
                <select name="CCSdropdown" id="CCSdropdown">
                    <option value="">ITE 7</option>
                    <option value="">ITE 5</option>
                    <option value="">Software Engineering</option>
                </select>

            </div>

            <?php
            include("postComponent.php");
            ?>
        </div>
    </div>
</body>

</html>