<?php
include("db_conn.php");
session_start();
$user = $_SESSION['username'];
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
        <a href="#">
            <h1>Class Connect</h1>
        </a>
        <input class="search" type="text" placeholder="Search">
        <a href="addPost.php">
            <button class="addPostBtn">Create Post</button>
        </a>
        <a href="userPage.php">
            <div class="pfp profile">
                <img src="../bg/sample10.png" alt="Profile Picture">
            </div>
        </a>

    </nav>


    <!-- Sidebar Items -->
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

        <!-- Posts Section -->
        <div class="scrollContainer">
            <?php
            include("postComponent.php"); // Use postComponent.php exclusively
            ?>
        </div>
    </div>
</body>

</html>