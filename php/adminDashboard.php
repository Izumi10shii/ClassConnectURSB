<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/adminDashboard.css">
</head>

<body>
    <nav class="homeHeader">
        <a href="#">
            <h1>Class Connect</h1>
        </a>
        <h1>ADMIN DASHBOARD</h1>
    </nav>

    <!-- Sidebar Items -->
    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <div class="homebtn lsu"><a href="home.php">Home</a></div>

                <div class="explorebtn lsu">
                    <a href="adminDashboard.php?page=user_management">
                        User Management
                    </a>
                </div>

                <div class="popularbtn lsu">
                    <a href="adminDashboard.php?page=post_management">
                        Post Management
                    </a>
                </div>

                <div class="popularbtn lsu">
                    <a href="adminDashboard.php?page=reports_management">
                        Reports Management
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

        <!-- Dynamic Content Section -->
        <div class="contentSection">
            <?php
            // Check the URL parameter to load content dynamically
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                // Include different PHP files based on the page parameter
                if ($page == 'user_management') {
                    include('adminUsersList.php'); // This will load the user management page
                } elseif ($page == 'post_management') {
                    include('adminPostsList.php'); // This will load the post management page
                } elseif ($page == 'reports_management') {
                    include('adminReportsList.php'); // This will load the reports management page
                } else {
                    echo '<p>Welcome to the Admin Dashboard</p>';
                }
            } else {
                include('adminUsersList.php');
            }
            ?>
        </div>
    </div>
</body>

</html>
