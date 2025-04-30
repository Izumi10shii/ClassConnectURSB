<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Class Connect</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      transition: all 0.3s ease;
    }

    .homeHeader {
      background: linear-gradient(to right, #002766, #0051ff);
      display: flex;
      align-items: center;
      justify-content: space-between;
      width: 100%;
      height: 80px;
      padding: 20px 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      gap: 20px;
    }

    .logo {
      text-decoration: none;
      color: white;
      font-size: 32px;
      font-weight: bold;
      white-space: nowrap;
    }


    .actions {
      display: flex;
      align-items: center;
      gap: 20px;
    }
    .pfp {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      background-image: url('../bg/sample10.png');
      background-size: cover;
      background-position: center;
      cursor: pointer;
    }

    @keyframes rainbowMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
  </style>
</head>

<body>
  <nav class="homeHeader">
    <a href="home.php" class="logo">Class Connect</a>



    <div class="actions">
      <a href="userPage.php">
        <div class="pfp"></div>
      </a>
    </div>
  </nav>
</body>

</html>
