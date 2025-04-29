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
    <?php
    include("nav.php");
    //include("userSidebar.php");
    ?>


<div class="scrollContainer">

<?php
    include("userSidebar.php");
?>
            <div class="HomeContainer">
            
            <div class="exploreContainer">

                <!-- Posts Section -->
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