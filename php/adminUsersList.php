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

// Handle Delete User
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteQuery = "DELETE FROM student_tb WHERE student_no = '$delete_id'";
    mysqli_query($conn, $deleteQuery);
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
    <title>Document</title>
    <link rel="stylesheet" href="../css/adminUsersList.css">
</head>

<body>

    <div class="userListContainer">

        <div class="header">

            <h2>Registered users</h2>
            <button class="addUserBTN">add</button>
        </div>


        <div class="table">

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col">
                        <h2>Student No</h2>
                        <p><?php echo $row['student_no']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Username</h2>
                        <p><?php echo $row['username']; ?></p>
                    </div>
                    <div class="col">
                        <h2>First Name</h2>
                        <p><?php echo $row['fname']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Last Name</h2>
                        <p><?php echo $row['lname']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Email</h2>
                        <p><?php echo $row['email']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Program</h2>
                        <p><?php echo $row['program']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Year & Section</h2>
                        <p><?php echo $row['year'] . " - " . $row['section']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Date Created</h2>
                        <p><?php echo $row['created_at']; ?></p>
                    </div>
                    <div class="col">
                        <h2>Action</h2>
                        <div class="actionRow">
                            <a href="?delete_id=<?php echo $row['student_no']; ?>" class="deleteBTN">Delete</a>
                            <a href="#" class="editBTN">Edit</a>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No users found.</p>
            <?php endif; ?>

        </div>
    </div>

    <!--
Add User Popup
    -->

    <form action="" method="post" class="addUserContainer">
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

        }
        unset($_SESSION['error_message']);
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
</body>

</html>