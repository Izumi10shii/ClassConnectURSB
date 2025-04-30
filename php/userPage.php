<?php
include("db_conn.php");
session_start();

$username = (isset($_SESSION["username"])) ? $_SESSION["username"] : "";

// Handle Profile Update (if form is submitted)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $program = mysqli_real_escape_string($conn, $_POST['program']);
    $year = mysqli_real_escape_string($conn, $_POST['year']);
    $section = mysqli_real_escape_string($conn, $_POST['section']);

    // SQL query to update profile
    $updateQuery = "UPDATE student_tb 
                    SET fname='$fname', lname='$lname', email='$email', program='$program', year='$year', section='$section'
                    WHERE username='$username'";

    if (mysqli_query($conn, $updateQuery)) {
        $message = "Profile updated successfully!";
    } else {
        $message = "Error updating profile: " . mysqli_error($conn);
    }
}
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

    // Fetch current user details from the database
    $getUser = "SELECT * FROM student_tb WHERE username = '$username'";
    $result = mysqli_query($conn, $getUser);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $student_no = $row['student_no'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
        $program = $row['program'];
        $year = $row['year'];
        $section = $row['section'];
    } else {
        echo "No user found.";
        exit;
    }
    ?>


    <div class="HomeContainer">

        <div class="scrollContainer">
            <div class="communityPageInfo">
                <div class="communityRow">
                    <div class="goLeft">
                        <div class="PagePfp"></div>
                        <h1><?php echo $username ?></h1>
                    </div>
                    <div class="goRight">
                        <button id="editProfileBtn">Edit Profile</button>
                    </div>
                </div>

                <div class="profileDetails">
                    <div class="profileInfo">
                        <h3>Profile</h3>
                        <li><?php echo $student_no ?></li>
                        <li><?php echo ("$fname $lname") ?></li>
                        <li><?php echo $email ?></li>
                        <li><?php echo $program ?></li>
                        <li><?php echo ("$year-$section") ?></li>
                    </div>

                </div>
                <div class="userRow">
                    <button>Posts</button>
                    <!--<button>Comments</button>-->
                </div>
                <div class="displayUserContent">

                    <?php
                    $getPosts = "SELECT * FROM post_tb WHERE username = '$username'";
                    $result = mysqli_query($conn, $getPosts);

                    include("postComponent.php");
                    ?>
                </div>
            </div>




        </div>

        <!-- Edit Profile Modal -->
        <div id="editProfileModal" class="modal" style="display: none;">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="editProfileForm" method="POST" action="">
                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" required>

                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" required>

                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                    <label for="program">Program:</label>
                    <input type="text" id="program" name="program" value="<?php echo $program; ?>" required>

                    <label for="program">Program:</label>
                    <select id="program" name="program" required>
                        <option value="" disabled selected>Select your program</option>
                        <option value="Information Technology">Information Technology</option>
                        <option value="Information Systems">Information Systems</option>
                        <option value="Accountancy">Accountancy</option>
                        <option value="Office Administration">Office Administration</option>
                        <option value="Marketing Management">Marketing Management</option>
                        <option value="Financial Management">Financial Management</option>
                        <option value="Human Resource Development">Human Resource Development</option>
                    </select>



                    <label for="year">Year:</label>
                    <select id="year" name="year" required>
                        <option value="" disabled selected>Select your Year</option>
                        <option value="1">First Year</option>
                        <option value="2">Second Year</option>
                        <option value="3">Third Year</option>
                        <option value="4">Fourth Year</option>
                    </select><br>

                    <button type="submit">Save Changes</button>
                </form>
                <?php if (isset($message))
                    echo "<p>$message</p>"; ?>
            </div>
        </div>

        <script>
            // Get modal elements
            var modal = document.getElementById("editProfileModal");
            var btn = document.getElementById("editProfileBtn");
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the "Edit Profile" button, open the modal
            btn.onclick = function () {
                modal.style.display = "block";
            }

            // When the user clicks "x" (close), close the modal
            span.onclick = function () {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside the modal, close it
            window.onclick = function (event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
    </div>
</body>

</html>