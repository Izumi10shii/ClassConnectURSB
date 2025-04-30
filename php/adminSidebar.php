<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        a {
            text-decoration: none;
        }

        .leftSidebar {
            position: sticky;
            top: 0;
            align-self: flex-start;
            height: 1000px;
            min-height: 100vh;

            background: url("../bg/sample7.png") no-repeat center center;
            background-size: cover;
            background-attachment: fixed;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 2px 0 6px rgba(0, 0, 0, 0.1);

            padding: 20px;
            width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: start;

        }

        .lsu {
            margin: 20px;
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 10px;
            width: 90%;
            color: white;
            text-align: left;
            font-weight: bold;
            background-color: rgba(255,
                    255,
                    255,
                    0.1);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease, opacity 0.3s ease;
            opacity: 0.85;
            border: 1px solid #ffffff;
        }

        .lsu:hover {
            background: linear-gradient(45deg, #fffb00, #dd2a7b, #8134af, #515bd4);
            color: white;
            transform: scale(1.03);
            animation: rainbowMove 3s linear infinite;
            background-size: 200% 200%;
            border: 1px solid white;
        }

        .lsu a {
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>
    <div class="leftSidebar">
        <div class="leftSideUp">


            <a href="home.php">
                <div class="homebtn lsu">
                    Home
                </div>
            </a>



            <a href="adminDashboard.php?page=user_management">
                <div class="explorebtn lsu"> User Management</div>
            </a>



            <a href="adminDashboard.php?page=post_management">
                <div class="popularbtn lsu">Post Management </div>
            </a>



            <a href="adminDashboard.php?page=reports_management">
                <div class="popularbtn lsu"> Reports Management </div>
            </a>

            <a href="adminDashboard.php?page=backup_restore">
                <div class="popularbtn lsu">Settings</div>
            </a>

        </div>
    </div>
</body>

</html>