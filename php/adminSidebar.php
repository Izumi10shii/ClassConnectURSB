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
            height: 3000px; /* Temp */
            min-height: 100vh;
            overflow-y: auto;
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
            width: 84%;
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
            top: 200px;
            z-index: 20px;
        }

        .titleCC {
            color: white;
            font-weight: bold;
            font-size: 38px;
            margin-bottom: 30px;
            top: 0;
            justify-self: start;
            text-align: center;
        }

        .iconlink {
            padding: 0px 0 0 0;
            margin: 20px auto;
        }

        .iconcont {
            display: flex;
            gap: 40px;
            flex-direction: row;
            font-style: italic;
            font-size: 3rem;
            justify-content: center;
        }

        .iconss {
            width: 35px;
            height: 35px;
        }
    </style>
</head>

<body>
    <div class="leftSidebar">
        <div class="titleCC">Class Connect</div>
        <div class="leftSideUp">


            <a href="home.php">

                <div class="homebtn lsu">
                    Home
                    <img src="http://localhost/ClassConnectURSB/icons/home.png" alt="Home">
                </div>
            </a>



            <a href="adminDashboard.php?page=user_management">
                <div class="explorebtn lsu"> User Management
                    <img src="http://localhost/ClassConnectURSB/icons/user_management.png" alt="Home">
                </div>
            </a>



            <a href="adminDashboard.php?page=post_management">
                <div class="popularbtn lsu">Post Management
                    <img src="http://localhost/ClassConnectURSB/icons/post_management.png" alt="Home">
                </div>
            </a>



            <a href="adminDashboard.php?page=reports_management">
                <div class="popularbtn lsu"> Reports Management
                    <img src="http://localhost/ClassConnectURSB/icons/reports_management.png" alt="Home">
                </div>
            </a>

            <a href="adminDashboard.php?page=backup_restore">
                <div class="popularbtn lsu">Backup and Restore
                    <img src="http://localhost/ClassConnectURSB/icons/backup_n_restore.png" alt="Home">
                </div>
            </a>

            <a href="adminDashboard.php?page=audit_trail">
            
                <div class="popularbtn lsu"> Audit Trail
                <img src="http://localhost/ClassConnectURSB/icons/audit_trail.png" alt="Home">
                </div>
            </a>
            

            <div class="iconlink">
                <div class="iconcont">
                    <a href="https://www.facebook.com" target="_blank">
                        <img class="iconss" src="http://localhost/ClassConnectURSB/icons/facebook.png" alt="Facebook">

                    </a>
                    <a href="https://mail.google.com/mail/?view=cm&to=ursbclassconnect@gmail.com" target="_blank">
                        <img class="iconss" src="http://localhost/ClassConnectURSB/icons/gmail.png" alt="Gmail">

                    </a>
                    <a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" target="_blank">
                        <img class="iconss" src="http://localhost/ClassConnectURSB/icons/youtube.png" alt="YouTube">

                    </a>
                </div>
            </div>

            
        </div>
    </div>
</body>

</html>