<?php
include("db_conn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmarks</title>
    <link rel="stylesheet" href="../css/saved_posts.css">
</head>

<body>
    <nav class="homeHeader">
        <a href="#">
            <h1>Class Connect</h1>
        </a>
    </nav>


    <!-- Sidebar Items -->
    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <div class="homebtn lsu">Home</div>
                <div class="savedpost lsu">Saved Posts</div>

                <div class="explorebtn lsu">
                    <a href="explorePage.php">
                        Explore Discussions
                    </a>
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


    </div>
</body>

</html>