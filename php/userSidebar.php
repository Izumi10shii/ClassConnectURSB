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
            width: 90%;
            color: white;
            text-align: left;
            font-weight: bold;
            background-color: rgba(255, 255, 255, 0.1);
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
            <div class="homebtn lsu">
                <a href="home.php">Home</a>
            </div>
            <div class="savedpost lsu">
                <a href="saved_posts.php">Saved Posts</a>
            </div>
            <div class="popularbtn lsu"><a href="file_storage.php">File Storage</a></div>

            <div class="popularbtn lsu">
                <a href="adminDashboard.php">
                    Admin Dashboard
                </a>
            </div>
            <a href="userPage.php">

                <div class="popularbtn lsu">Profile</div>
            </a>
        </div>
    </div>

</body>

</html>