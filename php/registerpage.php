<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../css/registerpage.css">
</head>

<body>
    <div class="frontpage">
        <div class="content">
            <div class="title">Welcome to ClassConnect!</div>

            <?php
                if (isset($_GET['error']) && $_GET['error'] == 'password_mismatch') {
                    echo "<p style='color: red;'>Passwords do not match. Please try again.</p>";
                    }       
            ?>

            <form class="regbox" method="POST" action="confirm_registration.php">
                <div class="label-group">
                    <label for="userid">Student ID:</label>
                    <input type="text" name="userid" id="userid" class="user" placeholder="e.g., B2025-12345" required>
                </div>

                <div class="label-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="user" placeholder="e.g., john_doe" required>
                </div>

                <div class="label-group">
                    <label for="firstname">First Name:</label>
                    <input type="text" name="firstname" id="firstname" class="user" placeholder="e.g., Chris Pea" required>
                </div>

                <div class="label-group">
                    <label for="lastname">Last Name:</label>
                    <input type="text" name="lastname" id="lastname" class="user" placeholder="e.g., Bacon" required>
                </div>

                <div class="label-group">
                    <label for="password">Password:</label>
                    <div class="input-container">
                        <input type="password" name="password" id="password" class="pass" placeholder="********" required>
                        <span class="toggle-icon" id="togglePassword">
                            <!-- Eye icon for "Show" -->
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="label-group">
                    <label for="confirmpassword">Confirm Password:</label>
                    <div class="input-container">
                        <input type="password" id="confirmpassword" class="pass" placeholder="********" required>
                        <span class="toggle-icon" id="toggleConfirmPassword">
                            <!-- Eye icon for "Show" -->
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3">
                                <path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="label-group">
                    <label for="email">Email:</label>
                    <input type="text" name="email" id="email" class="user" placeholder="e.g., ursb@cc.com" required>
                </div>

                <div class="label-group">
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
                </div>

                <div class="label-group">
                    <label for="yearsec">Year & Section:</label>
                    <select id="yearsec" name="yearsec" required>
                        <option value="" disabled selected>Select your Year & Section</option>
                        <!-- 1st Year -->
                        <option value="1-1A">1-1A</option>
                        <option value="1-1B">1-1B</option>
                        <option value="1-2A">1-2A</option>
                        <option value="1-2B">1-2B</option>
                        <option value="1-3A">1-3A</option>
                        <option value="1-3B">1-3B</option>
                        <option value="1-4A">1-4A</option>
                        <option value="1-4B">1-4B</option>
                        <option value="1-5A">1-5A</option>
                        <option value="1-5B">1-5B</option>


                        <!-- 2nd Year -->
                        <option value="2-1A">2-1A</option>
                        <option value="2-1B">2-1B</option>
                        <option value="2-2A">2-2A</option>
                        <option value="2-2B">2-2B</option>
                        <option value="2-3A">2-3A</option>
                        <option value="2-3B">2-3B</option>

                        <!-- 3rd Year -->
                        <option value="3-1A">3-1A</option>
                        <option value="3-1B">3-1B</option>
                        <option value="3-2A">3-2A</option>
                        <option value="3-2B">3-2B</option>
                        <option value="3-3A">3-3A</option>
                        <option value="3-3B">3-3B</option>

                        <!-- 4th Year -->
                        <option value="4-1A">4-1A</option>
                        <option value="4-1B">4-1B</option>
                        <option value="4-2A">4-2A</option>
                        <option value="4-2B">4-2B</option>
                        <option value="4-3A">4-3A</option>
                        <option value="4-3B">4-3B</option>
                    </select>
                </div>

                <!--After Register - should send email with Welcome Message-->

                <button type="submit" class="submit">REGISTER NEW ACCOUNT</button>

                <div class="bottomtext">
                    <div class="login">Already a ClassConnect user? <a href="loginpage.php">Login</a> Here!</div>
                </div>
            </form>
        </div>

        <div class="pic"></div>
    </div>

    <script>
        // Toggle for Password Field
        const togglePassword = document.getElementById('togglePassword');
        const passwordField = document.getElementById('password');

        togglePassword.addEventListener('click', () => {
            const type = passwordField.type === 'password' ? 'text' : 'password';
            passwordField.type = type;

            // Toggle the SVG icon
            togglePassword.innerHTML = type === 'password'
                ? `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>`
                : `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>`;
        });

        // Toggle for Confirm Password Field
        const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
        const confirmpasswordField = document.getElementById('confirmpassword');

        toggleConfirmPassword.addEventListener('click', () => {
            const type = confirmpasswordField.type === 'password' ? 'text' : 'password';
            confirmpasswordField.type = type;

            // Toggle the SVG icon
            toggleConfirmPassword.innerHTML = type === 'password'
                ? `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>`
                : `<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m644-428-58-58q9-47-27-88t-93-32l-58-58q17-8 34.5-12t37.5-4q75 0 127.5 52.5T660-500q0 20-4 37.5T644-428Zm128 126-58-56q38-29 67.5-63.5T832-500q-50-101-143.5-160.5T480-720q-29 0-57 4t-55 12l-62-62q41-17 84-25.5t90-8.5q151 0 269 83.5T920-500q-23 59-60.5 109.5T772-302Zm20 246L624-222q-35 11-70.5 16.5T480-200q-151 0-269-83.5T40-500q21-53 53-98.5t73-81.5L56-792l56-56 736 736-56 56ZM222-624q-29 26-53 57t-41 67q50 101 143.5 160.5T480-280q20 0 39-2.5t39-5.5l-36-38q-11 3-21 4.5t-21 1.5q-75 0-127.5-52.5T300-500q0-11 1.5-21t4.5-21l-84-82Zm319 93Zm-151 75Z"/></svg>`;
        });
    </script>
</body>

</html>