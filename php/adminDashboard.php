<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/adminDashboard.css">
</head>

<body>

    <?php include("nav1.php"); ?>

    <div class="HomeContainer">
        <?php
        include("adminSidebar.php");
        ?>
        <div class="contentSection">
            <!-- Dynamic Content Section -->
            <?php
            // Check the URL parameter to load content dynamically
            if (isset($_GET['page'])) {
                $page = $_GET['page'];

                // Include different PHP files based on the page parameter
                if ($page == 'user_management') {
                    include('adminUsersList.php');
                } elseif ($page == 'post_management') {
                    include('adminPostsList.php');
                } elseif ($page == 'reports_management') {
                    include('adminReportsList.php');
                } elseif ($page == 'backup_restore') {
                    include('db_backup_restore.php');
                } else {
                }
            } else {
                echo '<h1>Welcome to the Admin Dashboard</h1><br><h2>Select a section from the sidebar.</h2>';
            }
            ?>
        </div>
    </div>
</body>

</html>