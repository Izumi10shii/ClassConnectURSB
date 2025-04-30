<?php
include("db_conn.php");

session_start();
if (empty($_SESSION['student_no'])) {
    header("Location: loginpage.php");
    exit();
}

$student_no = $_SESSION['student_no'];

// Logout functionality
if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();
    session_destroy();

    // Redirect to the login page
    header("Location: loginpage.php");
    exit();
}


// Fetch OTP setting from the database
$otpQuery = "SELECT otp_enabled FROM student_tb WHERE student_no = '$student_no'";
$otpResult = mysqli_query($conn, $otpQuery);
$otpEnabled = mysqli_fetch_assoc($otpResult)['otp_enabled'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['update_otp_setting'])) {
        $otpEnabled = isset($_POST['otp_enabled']) ? 1 : 0;
        $updateOtpQuery = "UPDATE student_tb SET otp_enabled = '$otpEnabled' WHERE student_no = '$student_no'";
        if (mysqli_query($conn, $updateOtpQuery)) {
            $message = "OTP settings updated successfully.";
        } else {
            $message = "Error updating OTP settings: " . mysqli_error($conn);
        }
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $fname = mysqli_real_escape_string($conn, $_POST['fname']);
        $lname = mysqli_real_escape_string($conn, $_POST['lname']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $program = mysqli_real_escape_string($conn, $_POST['program']);
        $year = mysqli_real_escape_string($conn, $_POST['year']);
        $section = mysqli_real_escape_string($conn, $_POST['section']);

        // Update query
        $updateQuery = "UPDATE student_tb 
                        SET username='$username', fname='$fname', lname='$lname', email='$email', program='$program', year='$year', section='$section'
                        WHERE student_no='$student_no'";

        if (mysqli_query($conn, $updateQuery)) {
        } else {
            $message = "Error updating profile: " . mysqli_error($conn);
        }
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
    $getUser = "SELECT * FROM student_tb WHERE student_no = '$student_no'";
    $result = mysqli_query($conn, $getUser);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $username = $row['username'];
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

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="modal" style="display: none;">
        <div class="modal-content">
            <span class="close">&times;</span>

            <form id="editProfileForm" method="POST" action="">
                <div class="form-flex">
                    <!-- Column 1 -->
                    <div class="form-column">
                        <label for="student_no">Student Number:</label>
                        <input type="text" id="student_no" name="student_no" value="<?php echo $student_no; ?>"
                            disabled>

                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" value="<?php echo $username; ?>" required>

                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" value="<?php echo $fname; ?>" required>

                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" value="<?php echo $lname; ?>" required>
                    </div>

                    <!-- Column 2 -->
                    <div class="form-column">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" value="<?php echo $email; ?>" required>

                        <label for="program">Program:</label>
                        <select id="program" name="program" required>
                            <option value="" disabled>Select your program</option>
                            <option value="Information Technology" <?= $program == 'Information Technology' ? 'selected' : '' ?>>Information Technology</option>
                            <option value="Information Systems" <?= $program == 'Information Systems' ? 'selected' : '' ?>>
                                Information Systems</option>
                            <option value="Accountancy" <?= $program == 'Accountancy' ? 'selected' : '' ?>>Accountancy
                            </option>
                            <option value="Office Administration" <?= $program == 'Office Administration' ? 'selected' : '' ?>>Office Administration</option>
                            <option value="Marketing Management" <?= $program == 'Marketing Management' ? 'selected' : '' ?>>Marketing Management</option>
                            <option value="Financial Management" <?= $program == 'Financial Management' ? 'selected' : '' ?>>Financial Management</option>
                            <option value="Human Resource Development" <?= $program == 'Human Resource Development' ? 'selected' : '' ?>>Human Resource Development</option>
                        </select>

                        <label for="year">Year:</label>
                        <select id="year" name="year" required>
                            <option value="" disabled>Select your Year</option>
                            <option value="1" <?= $year == 1 ? 'selected' : '' ?>>First Year</option>
                            <option value="2" <?= $year == 2 ? 'selected' : '' ?>>Second Year</option>
                            <option value="3" <?= $year == 3 ? 'selected' : '' ?>>Third Year</option>
                            <option value="4" <?= $year == 4 ? 'selected' : '' ?>>Fourth Year</option>
                        </select>

                        <label for="section">Section:</label>
                        <select id="section" name="section" required>
                            <option value="" disabled>Select your Section</option>
                            <option value="1" <?= $section == 1 ? 'selected' : '' ?>>1</option>
                            <option value="2" <?= $section == 2 ? 'selected' : '' ?>>2</option>
                            <option value="3" <?= $section == 3 ? 'selected' : '' ?>>3</option>
                            <option value="4" <?= $section == 4 ? 'selected' : '' ?>>4</option>
                            <option value="5" <?= $section == 5 ? 'selected' : '' ?>>5</option>
                        </select>
                    </div>
                </div>

                <button type="submit" style="margin-top: 15px;">Save Changes</button>
            </form>
        </div>
    </div>


    <!-- Confirmation Modal for Logout -->
    <div id="logOutModal" class="modal">
        <div class="modal-content">
            <h3>Are you sure you want to logout?</h3>
            <button id="confirmLogout">Yes, Logout</button>
            <button id="cancelLogout">Cancel</button>
        </div>
    </div>



    <div class="HomeContainer">
        <?php include("userSidebar.php"); ?>

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
                        <ul>
                            <li>Student Number: <?php echo $student_no ?></li>
                            <li>Name: <?php echo ("$fname $lname") ?></li>
                            <li>Email: <?php echo $email ?></li>
                            <li>Program: <?php echo $program ?></li>
                            <li>Year and Section: <?php echo ("$year-$section") ?></li>
                        </ul>
                    </div>

                    <div class="options">
                        <!-- OTP Toggle Setting -->
                        <div class="otpSettingCard">
                            <form method="POST">
                                <label class="toggle-button">
                                    <input type="checkbox" name="otp_enabled" <?= isset($row['otp_enabled']) && $row['otp_enabled'] == 1 ? 'checked' : '' ?>>
                                    <span class="slider"></span>
                                    Enable OTP on login
                                </label>
                                <button type="submit" name="update_otp_setting">Save</button>
                            </form>
                        </div>

                        <div class="logoutCard">
                            <form id="logoutForm" method="POST">
                                <label>Logout</label>
                                <button type="button" id="logoutBtnNew">Logout</button>
                            </form>
                        </div>


                    </div>

                </div>

                <div class="userRow">
                    <button>Posts</button>
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
    </div>

    <script>
        // Get modal elements for Edit Profile and Logout
        var editProfileModal = document.getElementById("editProfileModal");
        var editProfileBtn = document.getElementById("editProfileBtn");
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the "Edit Profile" button, open the modal
        editProfileBtn.onclick = function () {
            editProfileModal.style.display = "block";
        }

        // When the user clicks "x" (close), close the modal
        span.onclick = function () {
            editProfileModal.style.display = "none";
        }

        // When the user clicks anywhere outside the modal, close it
        window.onclick = function (event) {
            if (event.target == editProfileModal) {
                editProfileModal.style.display = "none";
            }
        }

        // Get modal elements for Logout confirmation (Renamed modal to logOutModal)
        var logOutModal = document.getElementById("logOutModal"); // Updated modal name
        var logoutBtn = document.getElementById("logoutBtnNew");  // Target the renamed logout button
        var cancelLogout = document.getElementById("cancelLogout");
        var confirmLogout = document.getElementById("confirmLogout");

        // Show the modal when logout button is clicked
        logoutBtn.onclick = function () {
            logOutModal.style.display = "block";
        }

        // Close the modal when the user clicks "Cancel"
        cancelLogout.onclick = function () {
            logOutModal.style.display = "none";
        }

        // Logout when user confirms
        confirmLogout.onclick = function () {
            document.getElementById("logoutForm").submit(); // Submit the form to logout
        }

        // Close the modal if the user clicks outside of it
        window.onclick = function (event) {
            if (event.target == logOutModal) {
                logOutModal.style.display = "none";
            }
        }


    </script>
    </div>
</body>

</html>