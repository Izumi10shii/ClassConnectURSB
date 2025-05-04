<?php
include("db_conn.php");

// Handle Add User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $student_no = $_POST['student_no'];
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = md5($_POST['password']); // Hash the password using md5
    $email = $_POST['email'];
    $program = $_POST['program'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    // Check if username already exists
    $query = "SELECT * FROM student_tb WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $error = 'username_taken';
    } else {
        // Check if email already exists
        $email_query = "SELECT * FROM student_tb WHERE email = '$email'";
        $email_result = mysqli_query($conn, $email_query);

        if (mysqli_num_rows($email_result) > 0) {
            $error = 'email_taken';
        } else {

            $stud_query = "SELECT * FROM student_tb WHERE student_no = '$student_no'";
            $studno_result = mysqli_query($conn, $stud_query);

            if (mysqli_num_rows($studno_result) > 0) {
                $error = 'studno_taken';
            } else {
                $addQuery = "INSERT INTO student_tb (student_no, username, fname, lname, password, email, program, year, section, created_at) 
                VALUES ('$student_no', '$username', '$fname', '$lname', '$password', '$email', '$program', '$year', '$section', NOW())";

                mysqli_query($conn, $addQuery);
            }
        }
    }
}

// Handle Edit User
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    $student_no = $_POST['student_no'];
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $program = $_POST['program'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    $checkUsername = mysqli_query($conn, "SELECT * FROM student_tb WHERE username = '$username' AND student_no != '$student_no'");
    if (mysqli_num_rows($checkUsername) > 0) {
        $error = 'username_taken';
    } elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student_tb WHERE email = '$email' AND student_no != '$student_no'")) > 0) {
        $error = 'email_taken';
    } else {
        $updateQuery = "UPDATE student_tb 
                        SET username = '$username', fname = '$fname', lname = '$lname', email = '$email', 
                            program = '$program', year = '$year', section = '$section' 
                        WHERE student_no = '$student_no'";

        if (mysqli_query($conn, $updateQuery)) {
            header("Location: adminDashboard.php?page=user_management");
            exit;
        } else {
            echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
        }
    }
}


// Handle Delete User
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $deleteQuery = "DELETE FROM student_tb WHERE student_no = '$delete_id'";

    if (mysqli_query($conn, $deleteQuery)) {
        header("Location: adminDashboard.php?page=user_management");
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
    }
}


// Handle Edit User Data
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $editQuery = "SELECT * FROM student_tb WHERE student_no = '$edit_id'";
    $editResult = mysqli_query($conn, $editQuery);

    if ($editResult && mysqli_num_rows($editResult) > 0) {
        $editData = mysqli_fetch_assoc($editResult);
    } else {
        echo "<script>alert('User not found.'); window.location.href = 'adminDashboard.php';</script>";
    }
}


// Fetch Users
$query = "SELECT * FROM student_tb";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Admin) Registered Users</title>
    <link rel="stylesheet" href="../css/adminUsersList.css">
</head>

<body>

    <div class="userListContainer">

        <div class="header">

            <h2>Registered Users</h2>
            <button type="button" class="addUserBTN" onclick="showAddUserForm()">Add</button>
        </div>

        <div class="table-container">
            <table class="user-table">
                <thead>
                    <tr>
                        <th>Student No</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Year & Section</th>
                        <th>Date Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && mysqli_num_rows($result) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td><?php echo $row['student_no']; ?></td>
                                <td><?php echo $row['username']; ?></td>
                                <td><?php echo $row['fname']; ?></td>
                                <td><?php echo $row['lname']; ?></td>
                                <td><?php echo $row['email']; ?></td>
                                <td><?php echo $row['program']; ?></td>
                                <td><?php echo $row['year'] . " - " . $row['section']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td>
                                    <div class="actionRow">
                                        <a href="javascript:void(0);" class="deleteBTN" id="deleteBTN"
                                            onclick="confirmDeletion('<?php echo $row['student_no']; ?>');">Delete</a>
                                        <button type="button" class="editUserBTN"
                                            data-student_no="<?php echo $row['student_no']; ?>"
                                            data-username="<?php echo $row['username']; ?>"
                                            data-fname="<?php echo $row['fname']; ?>" data-lname="<?php echo $row['lname']; ?>"
                                            data-email="<?php echo $row['email']; ?>"
                                            data-password="<?php echo $row['password']; ?>"
                                            data-program="<?php echo $row['program']; ?>"
                                            data-year="<?php echo $row['year']; ?>"
                                            data-section="<?php echo $row['section']; ?>">
                                            Edit
                                        </button>

                                    </div>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add User Form -->
    <form id="addUserForm" action="" method="post" class="addUserContainer" style="display: none;">
        <h2 class="EditUser">Add New User</h2>

        <?php
        if (!empty($error)) {
            if ($error == 'password_mismatch') {
                echo "<p class='error-message'>Passwords do not match. Please try again.</p>";
            } elseif ($error == 'username_taken') {
                echo "<p class='error-message'>Username is already taken. Please choose a different one.</p>";
            } elseif ($error == 'email_taken') {
                echo "<p class='error-message'>Email is already registered. Please use another one.</p>";
            } elseif ($error == 'studno_taken') {
                echo "<p class='error-message'>Student Number: $student_no already has an Account.</p>";
            }
        }
        ?>

        <div id="addUserForm1">
            <div class="form-row">
                <label for="add_student_no">Student No</label>
                <input id="add_student_no" name="student_no" type="text" placeholder="Student No" required>

                <label for="add_username">Username</label>
                <input id="add_username" name="username" type="text" placeholder="Username" required>

                <label for="add_fname">First Name</label>
                <input id="add_fname" name="fname" type="text" placeholder="First Name" required>

                <label for="add_lname">Last Name</label>
                <input id="add_lname" name="lname" type="text" placeholder="Last Name" required>

            </div>

            <div class="form-row">
                <label for="add_email">Email</label>
                <input id="add_email" name="email" type="email" placeholder="Email" required>

                <label for="add_password">Password</label>
                <input id="add_password" name="password" type="text" placeholder="Password" required>

                <label for="add_program">Program</label>
                <select id="add_program" name="program" required>
                    <option value="" disabled selected>Select your program</option>
                    <option value="Information Technology">Information Technology</option>
                    <option value="Information Systems">Information Systems</option>
                    <option value="Accountancy">Accountancy</option>
                    <option value="Office Administration">Office Administration</option>
                    <option value="Marketing Management">Marketing Management</option>
                    <option value="Financial Management">Financial Management</option>
                    <option value="Human Resource Development">Human Resource Development</option>
                </select>

                <label for="add_year">Year</label>
                <select id="add_year" name="year" required>
                    <option value="" disabled selected>Select your Year</option>
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Fourth Year</option>
                </select>

                <label for="add_section">Section</label>
                <select id="add_section" name="section" required>
                    <option value="" disabled selected>Select your Section</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>


        <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px;">
            <button type="submit" name="add_user" class="confirmBtn">Add New User</button><br>
            <a href="javascript:void(0);" onclick="closeAddUserForm()" class="cancelBtn">Cancel</a>
        </div>
    </form>




    <!-- Edit User Form -->
    <form id="editUserForm" action="" method="post" class="addUserContainer1"
        style="display: <?php echo isset($editData) ? 'flex' : 'none'; ?>;">
        <h2 class="EditUser">Edit User</h2>

        <?php
        if (!empty($error)) {
            if ($error == 'username_taken') {
                echo "<p class='error-message'>Username is already taken. Please choose a different one.</p>";
            } elseif ($error == 'email_taken') {
                echo "<p class='error-message'>Email is already registered. Please use another one.</p>";
            } elseif ($error == 'studno_taken') {
                echo "<p class='error-message'>Student No is already registered. Please use another one.</p>";
            }
        }
        ?>

        <div id="editUserForm1">
            <div class="form-row">
               <!-- <label for="edit_student_no">Student Number</label> NOT SURE -->
                <input type="hidden" id="edit_student_no" name="student_no"
                    value="<?php echo isset($editData['student_no']) ? $editData['student_no'] : ''; ?>">

                <label for="edit_username">Username</label>
                <input id="edit_username" name="username" type="text"
                    value="<?php echo isset($editData['username']) ? $editData['username'] : ''; ?>" required>

                <label for="edit_fname">First Name</label>
                <input id="edit_fname" name="fname" type="text"
                    value="<?php echo isset($editData['fname']) ? $editData['fname'] : ''; ?>" required>

                <label for="edit_lname">Last Name</label>
                <input id="edit_lname" name="lname" type="text"
                    value="<?php echo isset($editData['lname']) ? $editData['lname'] : ''; ?>" required>

                <label for="year">Year:</label>
                <select id="year" name="year" required>
                    <option value="" disabled>Select your Year</option>
                    <option value="1">First Year</option>
                    <option value="2">Second Year</option>
                    <option value="3">Third Year</option>
                    <option value="4">Fourth Year</option>
                </select>

            </div>

            <div class="form-row">
                <label for="edit_email">Email</label>
                <input id="edit_email" name="email" type="email"
                    value="<?php echo isset($editData['email']) ? $editData['email'] : ''; ?>" required>

                <label for="edit_password">Password</label>
                <input id="edit_password" name="password" type="text"
                    value="<?php echo isset($editData['password']) ? $editData['password'] : ''; ?>" required>

                <label for="edit_program">Program</label>
                <input id="edit_program" name="program" type="text"
                    value="<?php echo isset($editData['program']) ? $editData['program'] : ''; ?>" required>

                <label for="section">Section:</label>
                <select id="section" name="section" required>
                    <option value="" disabled>Select your Section</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
        </div>



        <div style="margin-top: 20px; display: flex; justify-content: center; gap: 20px;">
            <button type="submit" name="edit_user" class="confirmBtn">Save Changes</button>
            <a href="adminDashboard.php?page=user_management" class="cancelBtn">Cancel</a>
        </div>

    </form>

    <!-- Confirmation Popup -->
    <div id="confirmPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <p>Are you sure you want to delete this user?</p>
            <div style="margin-top: 20px;">
                <button onclick="proceedDeletion()" class="confirmBtn">Yes</button>
                <button onclick="closeConfirmPopup()" class="cancelBtn">No</button>
            </div>
        </div>
    </div>

    <!-- Success Popup -->
    <div id="successPopup" class="popup" style="display: none;">
        <div class="popup-content">
            <p>User deleted successfully.</p>
            <div style="margin-top: 20px;">
                <button onclick="closeSuccessPopup()" class="confirmBtn">OK</button>
            </div>
        </div>
    </div>

    <script>
        let studentToDelete = null;

        function confirmDeletion(studentNo) {
            studentToDelete = studentNo;
            document.getElementById('confirmPopup').style.display = 'flex';
        }

        function closeConfirmPopup() {
            studentToDelete = null;
            document.getElementById('confirmPopup').style.display = 'none';
        }

        function proceedDeletion() {
            if (studentToDelete) {
                window.location.href = 'adminUsersList.php?delete_id=' + studentToDelete;
            }
        }

        function showSuccessPopup() {
            document.getElementById('successPopup').style.display = 'flex';
        }

        function closeSuccessPopup() {
            document.getElementById('successPopup').style.display = 'none';
            window.location.href = 'adminDashboard.php';
        }

        function showAddUserForm() {
            document.getElementById("addUserForm").style.display = "block";
        }

        function closeAddUserForm() {
            document.getElementById("addUserForm").style.display = "none";
        }

        document.querySelectorAll('.editUserBTN').forEach(button => {
            button.addEventListener('click', function () {
                // Show the modal
                document.getElementById('editUserForm').style.display = 'flex';

                // Set form values using dataset
                document.getElementById('edit_student_no').value = this.dataset.student_no;
                document.getElementById('edit_username').value = this.dataset.username;
                document.getElementById('edit_fname').value = this.dataset.fname;
                document.getElementById('edit_lname').value = this.dataset.lname;
                document.getElementById('edit_email').value = this.dataset.email;
                document.getElementById('edit_password').value = this.dataset.password;
                document.getElementById('edit_program').value = this.dataset.program;

                // Set year and section dropdowns
                document.getElementById('year').value = this.dataset.year;
                document.getElementById('section').value = this.dataset.section;
            });
        });
    </script>

</body>

</html>