<?php include("..\php\db_conn.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Audit Trail</title>
    <link rel="stylesheet" href="../css/audit_trail.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            color: white;
            background-color: #121212;
            font-family: Arial, sans-serif;
        }

        nav {
            border-radius: 10px;
            background-color: #1e1e1e;
            padding: 15px 20px;
            text-align: center;
        }

        nav a {
            margin: 0 15px;
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.2s;
        }

        nav a:hover {
            color: #00bfff;
        }

        section {
            display: none;
            /* Initially hide all sections */
            margin: 40px auto;
            max-width: 1000px;
            padding: 20px;
            background-color: #1e1e1e;
            border-radius: 10px;
        }

        h2 {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #2a2a2a;
            color: #f1f1f1;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #444;
            text-align: left;
        }

        th {
            background-color: #333;
        }

        button {
            margin-top: 10px;
            padding: 8px 16px;
            border: none;
            background-color: #00bfff;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #009fd8;
        }
    </style>
    <script>
        function showSection(id) {
            // Hide all sections
            const sections = document.querySelectorAll('section');
            sections.forEach(section => section.style.display = 'none');

            // Show the clicked section
            const section = document.getElementById(id);
            if (section) {
                section.style.display = 'block';
            }
        }
    </script>
</head>

<body>

    <nav>
        <a href="javascript:void(0)" onclick="showSection('login')">Login Logs</a>
        <a href="javascript:void(0)" onclick="showSection('post')">Post Logs</a>
        <a href="javascript:void(0)" onclick="showSection('delete-post')">Delete Post Logs</a>
        <a href="javascript:void(0)" onclick="showSection('comment')">Comment Logs</a>
        <a href="javascript:void(0)" onclick="showSection('delete-comment')">Delete Comment Logs</a>
    </nav>

    <section id="login">
        <h2>User Login Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Username</th>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-05-03 13:00</td>
                    <td>placeholder_user</td>
                    <td>Success</td>
                    <td>User logged in.</td>
                </tr>
            </tbody>
        </table>
        <a href="pdf_pages/user_login_logs.php" target="_blank">
            <button>Generate Log</button>
        </a>
    </section>

    <?php

$getPostAudit = "
    SELECT 
        created_at, 
        account_id, 
        post_id, 
        title, 
        description 
    FROM post_tb
    ORDER BY post_tb.created_at DESC
";

$result = mysqli_query($conn, $getPostAudit);

?>

<section id="post">
    <h2>User Post Logs</h2>
    <table>
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Username</th>
                <th>Post ID</th>
                <th>Title</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['account_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['post_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['title']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No records found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="pdf_pages/user_post_logs.php" target="_blank">
        <button>Generate Log</button>
    </a>
</section>



    <section id="delete-post">
        <h2>User Delete Post Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Username</th>
                    <th>Post ID</th>
                    <th>Status</th>
                    <th>Reason</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-05-03 13:20</td>
                    <td>placeholder_user</td>
                    <td>45</td>
                    <td>Success</td>
                    <td>Post violated guidelines.</td>
                </tr>
            </tbody>
        </table>
        <a href="pdf_pages/user_delete_post_logs.php" target="_blank">
            <button>Generate Log</button>
        </a>
    </section>
    <?php

$getCommentsAudit = "
    SELECT 
        comment_tb.created_at, 
        comment_tb.account_id, 
        comment_tb.post_id, 
        comment_tb.comment_id, 
        comment_tb.comment_desc
    FROM comment_tb
    ORDER BY comment_tb.created_at DESC
";

$result = mysqli_query($conn, $getCommentsAudit);
?>
<section id="comment">
    <h2>User Comment Logs</h2>
    <table>
        <thead>
            <tr>
                <th>Timestamp</th>
                <th>Username</th> <!-- Will show account_id unless you join with user table -->
                <th>Post ID</th>
                <th>Comment ID</th>
                <th>Comment Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['created_at']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['account_id']) . "</td>"; // Change to 'username' if joining
                    echo "<td>" . htmlspecialchars($row['post_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['comment_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['comment_desc']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No comment logs found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="pdf_pages/user_comment_logs.php" target="_blank">
        <button>Generate Log</button>
    </a>
</section>

    <section id="delete-comment">
        <h2>User Delete Comment Logs</h2>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Username</th>
                    <th>Post ID</th>
                    <th>Comment ID</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2025-05-03 13:40</td>
                    <td>placeholder_user</td>
                    <td>88</td>
                    <td>123</td>
                </tr>
            </tbody>
        </table>
        <a href="pdf_pages/user_delete_comment_logs.php" target="_blank">
            <button>Generate Log</button>
        </a>
    </section>

</body>

</html>