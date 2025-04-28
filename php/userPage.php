<?php
include("db_conn.php");
session_start();
//temp

$username = "Rodsef";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/userPage.css">
</head>

<body>

    <?php
    include("nav.php");
    include("userSidebar.php");
    ?>
    <div class="HomeContainer">

<?php
//Retrive from studendb

$getUser = "SELECT * FROM student_tb WHERE username = '$username'";
$result = mysqli_query($conn, $getUser);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $student_no = $row['student_no'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $program = $row['program'];
        $year = $row['year'];
        $section = $row['section'];
   

?>
        <div class="scrollContainer">

            <div class="communityPageInfo">
                <div class="communityRow">
                    <div class="goLeft">
                        <div class="PagePfp"></div>
                        <h1><?php echo $username?></h1>
                    </div>
                    <div class="goRight">
                        <button>Edit Profile</button>
                    </div>
                </div>

                <div class="profileDetails">
                    <div class="profileInfo">
                        <h3>Profile</h3>
                        <li><?php echo $student_no?></li>
                        <li><?php echo ("$fname $lname")?></li>
                        <li><?php echo $email?></li>
                        <li><?php echo $program ?></li>
                        <li><?php echo ("$year-$section")?></li>

                    </div>
                    <div class="followersRow">
                        <p>100 Posts</p>
                        <p>1k Comments</p>
                    </div>
                </div>
                <?php
                 }
                } else {
                    echo "No user found.";
                }
                ?>

                <!--
                <div class="interests">
                    <h3>Interests</h3>
                    <li>ITEM1</li>
                    <li>ITEM2</li>
                    <li>ITEM3</li>
                </div>
-->
            </div>

            <div class="userRow">
                <button>Posts</button>
                <button>Comments</button>
            </div>

            <div>

            <?php
            
            ?>
            <!--POST OR COMMENTS DISPLAY-->

            </div>
        </div>


</body>

</html>