<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
            min-height: 100vh;
            background: linear-gradient(to right, #0D1B2A, #023047);
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
            width: 93%;
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
            display: flex;
            justify-content: space-between;
            /* Added this for right-side image */
            align-items: center;
            /* Ensure vertical alignment */
            padding-right: 10px;
            /* Space between text and image */
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
            color: white;
        }

        .lsu img {
            width: 24px;
            height: 24px;
        }

        .sticky-buttons {
            position: fixed;
            z-index: 20;
        }

        .iconss {
            width: 35px;
            height: 35px;
        }

        .iconlink {
            margin: 400px auto;
            padding: 0px 0 0 0;

        }

        .iconcont {
            display: flex;
            flex-direction: row;
            font-style: italic;
            font-size: 0.95rem;
            gap: 40px;
        }

        .titleCC {
            color: white;
            font-weight: bold;
            font-size: 38px;
            margin-bottom: 30px;
            top: 0;
            justify-self: start;
            text-align: center;
            margin-left: 7.5px;
        }

        @media screen and (max-width: 768px) {
    .leftSidebar {
        position: relative;
        flex-direction: row;
        flex-wrap: wrap;
        width: 100%;
        min-height: auto;
        padding: 10px;
        box-shadow: none;
    }

    .titleCC {
        text-align: left;
        font-size: 24px;
        margin-bottom: 10px;
        width: 100%;
        margin-left: 10px;
    }

    .sticky-buttons {
        position: relative;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        gap: 10px;
        width: 100%;
        margin-top: 10px;
    }

    .lsu {
        flex: 1 1 calc(50% - 20px);
        margin: 5px;
        font-size: 0.95rem;
        padding: 8px;
        text-align: center;
        justify-content: center;
    }

    .lsu img {
        margin-left: 8px;
    }

    .iconlink {
        margin: 20px auto;
        padding: 10px 0;
        width: 100%;
        text-align: center;
    }

    .iconcont {
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }
}

    </style>
</head>

<body>
    <div class="leftSidebar">
        <div class="leftSideUp">
            <div class="titleCC">Class Connect</div>

            <div class="sticky-buttons">
                <a href="home.php">
                    <div class="homebtn lsu">
                        Home
                        <img src="http://localhost/ClassConnectURSB/icons/home.png" alt="Home">
                    </div>
                </a>
                <a href="saved_posts.php">
                    <div class="savedpost lsu">
                        Saved Posts
                        <img src="http://localhost/ClassConnectURSB/icons/saved_post.png" alt="Saved Posts">
                    </div>
                </a>
                <a href="file_storage.php">
                    <div class="popularbtn lsu">
                        File Storage
                        <img src="http://localhost/ClassConnectURSB/icons/file_storage.png" alt="File Storage">
                    </div>
                </a>
                <a href="userPage.php">
                    <div class="popularbtn lsu">
                        Profile
                        <img src="http://localhost/ClassConnectURSB/icons/profile.png" alt="Profile">
                    </div>
                </a>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1): ?>
                    <a href="adminDashboard.php">
                        <div class="popularbtn lsu">
                            Admin Dashboard
                            <img src="http://localhost/ClassConnectURSB/icons/admin_dashboard.png" alt="Profile">
                        </div>
                    </a>
                <?php endif; ?>
            </div>


        </div>

        <div class="iconlink">
            <div class="iconcont">
                <a href="https://www.facebook.com">
                    <img class="iconss" src="http://localhost/ClassConnectURSB/icons/facebook.png" alt="Facebook">
                </a>
                <a href="https://mail.google.com/mail/?view=cm&to=ursbclassconnect@gmail.com" target="_blank">
                    <img class="iconss" src="http://localhost/ClassConnectURSB/icons/gmail.png" alt="Gmail">
                </a>
                <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0">
                    <img class="iconss" src="http://localhost/ClassConnectURSB/icons/youtube.png" alt="YouTube">
                </a>
            </div>
        </div>

    </div>

</body>

</html>