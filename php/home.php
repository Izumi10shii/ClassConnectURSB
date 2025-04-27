<?php
include("db_conn.php");
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
                <div class="homebtn lsu">
                    <a href="home.php">Home</a>
                </div>
                <div class="savedpost lsu">
                    <a href="saved_posts.php">Saved Posts</a>
                </div>

       

                <div class="popularbtn lsu">File Storage</div>

                <div class="popularbtn lsu">
                    <a href="adminDashboard.php">
                        Admin Dashboard
                    </a>
                </div>

                <div class="popularbtn lsu">Settings</div>
            </div>
        </div>

        <!-- Posts Section -->
        <div class="scrollContainer">

        <div class="exploreContainer">
            <h2>Select Discussions</h2>
            <h3>College Departments</h3>
            <div class="collegeDepartment">

                <label for="">
                    <input type="checkbox" id="CCS" name="CCS" value="CCS">
                    CCS
                </label>
                <label for="">
                    <input type="checkbox" id="FM" name="FM" value="FM">
                    COB
                </label>
                <label for="">
                    <input type="checkbox" id="COA" name="COA" value="COA">
                    COA
                </label>

                </label>       
            </div>
            <label for="dropdown">
                <h3>CCS Discussions</h3>
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