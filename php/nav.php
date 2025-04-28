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
      justify-content: center;
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

    .search {
      width: 100%;
      margin-right: 10%;
      padding: 10px 20px;
      border-radius: 30px;
      border: none;
      font-size: 1rem;
      outline: none;
    }

    .actions {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .addPostBtn {
      background-color: white;
      color: #0051ff;
      padding: 8px 20px;
      font-weight: bold;
      border-radius: 20px;
      border: 1px solid white;
      text-decoration: none;
      transition: 0.3s ease;
      cursor: pointer;
      white-space: nowrap;
    }

    .addPostBtn:hover {
      background: linear-gradient(45deg, #fffb00, #dd2a7b, #8134af, #515bd4);
      color: white;
      transform: scale(1.05);
      border: 1px solid white;
      background-size: 200% 200%;
      animation: rainbowMove 3s linear infinite;
    }

    .pfp {
      width: 40px;
      height: 40px;
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


      <input class="search" type="text" placeholder="Search...">

    <div class="actions">
      <a href="addPost.php" class="addPostBtn">Create Post</a>
      <a href="userPage.php">
        <div class="pfp"></div>
      </a>
    </div>
  </nav>
</body>

</html>
