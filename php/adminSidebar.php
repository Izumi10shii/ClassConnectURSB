<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .leftSidebar {
            position: sticky;
            top: 0;
            align-self: flex-start;
            height: 100vh;
            overflow-y: auto;
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
            animation: fadeIn 1s ease;
        }

        .lsu {
            margin: 20px;
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 10px;
            width: 80%;
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
            <a href="adminUsersList.php">

                <a href="home.php">
                <div class="homebtn lsu">
                    Home
                </div>
                </a>
            </a>

            <div class="explorebtn lsu">
                <a href="adminDashboard.php?page=user_management">
                    User Management
                </a>
            </div>

            <div class="popularbtn lsu">
                <a href="adminDashboard.php?page=post_management">
                    Post Management
                </a>
            </div>

            <div class="popularbtn lsu">
                <a href="adminDashboard.php?page=reports_management">
                    Reports Management
                </a>
            </div>

            <div class="popularbtn lsu">Settings</div>
        </div>
    </div>
</body>

</html>