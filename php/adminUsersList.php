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
            }
            else {          
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
    $program = $_POST['program'];
    $year = $_POST['year'];
    $section = $_POST['section'];

    $checkUsername = mysqli_query($conn, "SELECT * FROM student_tb WHERE username = '$username' AND student_no != '$student_no'");
    if (mysqli_num_rows($checkUsername) > 0) {
        $error = 'username_taken';
    }

    elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student_tb WHERE email = '$email' AND student_no != '$student_no'")) > 0) {
        $error = 'email_taken';
    }

    elseif (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM student_tb WHERE student_no = '$student_no' AND student_no != '$student_no'")) > 0) {
        $error = 'studno_taken';
    }

    else {
        $updateQuery = "UPDATE student_tb 
                        SET username = '$username', fname = '$fname', lname = '$lname', email = '$email', 
                            program = '$program', year = '$year', section = '$section' 
                        WHERE student_no = '$student_no'";

        if (mysqli_query($conn, $updateQuery)) {
            echo "<script>alert('User updated successfully!'); window.location.href = 'adminUsersList.php';</script>";
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
        echo "<script>window.onload = function() { showSuccessPopup(); };</script>";
    } else {
        echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
    }
}


// Handle Edit User
if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];

    $editQuery = "SELECT * FROM student_tb WHERE student_no = '$edit_id'";
    $editResult = mysqli_query($conn, $editQuery);

    if ($editResult && mysqli_num_rows($editResult) > 0) {
        $editData = mysqli_fetch_assoc($editResult);
    } else {
        echo "<script>alert('User not found.'); window.location.href = 'adminUsersList.php';</script>";
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

            <h2>Registered users</h2>
            <button id="addUserBTN" class="addUserBTN">Add</button>
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
                                        <a href="javascript:void(0);" 
                                           class="deleteBTN" 
                                           id="deleteBTN"
                                           onclick="confirmDeletion('<?php echo $row['student_no']; ?>');">Delete</a>
                                        <a href="adminUsersList.php?edit_id=<?php echo $row['student_no']; ?>" class="editBTN">Edit</a>
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

    <!-- ADD USER -->
    <form id="addUserForm" action="" method="post" class="addUserContainer" style="display: none;">
        <h2>Add New User</h2>

        <?php
        if (!empty($error)) {
            if ($error == 'password_mismatch') {
                echo "<p class='error-message'>Passwords do not match. Please try again.</p>";
            } elseif ($error == 'username_taken') {
                echo "<p class='error-message'>Username is already taken. Please choose a different one.</p>";
            } elseif ($error == 'email_taken') {
                echo "<p class='error-message'>Email is already registered. Please use another one.</p>";
            } elseif ($error == 'studno_taken') {
                echo "<p class='error-message'>Student No is already registered. Please use another one.</p>";
            }
            unset($_SESSION['error_message']);
        }

        ?>

        <label for="">Student No
            <input id="student_no" name="student_no" type="text" placeholder="Student No" required>
        </label>

        <label for="">Username
            <input id="username" name="username" type="text" placeholder="Username" required>
        </label>

        <label for="">First Name
            <input id="fname" name="fname" type="text" placeholder="First Name" required>
        </label>

        <label for="">Last Name
            <input id="lname" name="lname" type="text" placeholder="Last Name" required>
        </label>

        <label for="">Email
            <input id="email" name="email" type="email" placeholder="Email" required>
        </label>

        <label for="">Password
            <input id="password" name="password" type="text" placeholder="Password" required>
        </label>
        <label for="">Program
            <input id="program" name="program" type="text" placeholder="Program" required>
        </label>

        <label for="">Year
            <input id="year" name="year" type="text" placeholder="Year" required>
        </label>

        <label for="">Section
            <input id="section" name="section" type="text" placeholder="Section" required>
        </label>

        <button class="submitNewUser" type="submit" name="add_user" class="submitBTN">Add New User</button>
    </form>

    <!-- Edit User Form -->
    <form id="editUserForm" action="" method="post" class="editUserContainer" style="display: <?php echo isset($editData) ? 'flex' : 'none'; ?>;">
        <h2>Edit User</h2>
        
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

        <input type="hidden" id="edit_student_no" name="student_no" value="<?php echo isset($editData['student_no']) ? $editData['student_no'] : ''; ?>">

        <label for="edit_username">Username</label>
        <input id="edit_username" name="username" type="text" value="<?php echo isset($editData['username']) ? $editData['username'] : ''; ?>" required>

        <label for="edit_fname">First Name</label>
        <input id="edit_fname" name="fname" type="text" value="<?php echo isset($editData['fname']) ? $editData['fname'] : ''; ?>" required>

        <label for="edit_lname">Last Name</label>
        <input id="edit_lname" name="lname" type="text" value="<?php echo isset($editData['lname']) ? $editData['lname'] : ''; ?>" required>

        <label for="edit_email">Email</label>
        <input id="edit_email" name="email" type="email" value="<?php echo isset($editData['email']) ? $editData['email'] : ''; ?>" required>

        <label for="edit_program">Program</label>
        <input id="edit_program" name="program" type="text" value="<?php echo isset($editData['program']) ? $editData['program'] : ''; ?>" required>

        <label for="edit_year">Year</label>
        <input id="edit_year" name="year" type="text" value="<?php echo isset($editData['year']) ? $editData['year'] : ''; ?>" required>

        <label for="edit_section">Section</label>
        <input id="edit_section" name="section" type="text" value="<?php echo isset($editData['section']) ? $editData['section'] : ''; ?>" required>

        <button type="submit" name="edit_user" class="confirmBtn">Save Changes</button>
        <a href="adminUsersList.php" class="cancelBtn">Cancel</a>
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
        document.getElementById('addUserBTN').addEventListener('click', function () {
            const form = document.getElementById('addUserForm');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'flex'; // Show the form
            } else {
                form.style.display = 'none'; // Hide the form
            }
        });

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
            window.location.href = 'adminUsersList.php'; 
        }

    </script>
</body>

</html>