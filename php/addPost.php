<?php
include("db_conn.php");
//session_start(); to keep user logged in

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/addPost.css">
</head>

<body>
<nav class="homeHeader">
<a href="home.php">
  <h1>Class<span style="opacity: 0;">.</span>Connect</h1>
</a>
    <input class="search" type="text" placeholder="Search">
    <button class="addPostBtn">Add new Post</button>
    <a href="userPage.html">
        <!-- Profile pictur -->
        <div class="pfp profile"></div>
    </a>
</nav>


    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <li>Home</li>
                <li>Explore</li>
                <li>Popular</li>
            </div>

            <div class="leftSideDown">
                <!-- COMMUNITY BAKS  -->
                <div class="communitiesBox">
                    <h2>Communities</h2>
                    <div>
                        <a href="communityPage.html">
                            <div class="pfp"></div>
                            <div>IT5 - OOP</div>
                        </a>
                    </div>
                    <div>
                        <div class="pfp"></div>
                        <div>IT6 - DBMS</div>
                    </div>
                    <div>
                        <div class="pfp"></div>
                        <div>ITE 7 - AppDev</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="scrollContainer">


        <?php
        //stores post to db
        // $user = $_SESSION['username'];
        


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_post'])){

    $title = $_POST['titleInput'] ?? '';
    $description = $_POST['bodyInput'] ?? '';
    $user = "test"; //session
    
    if (!empty($title) && !empty($description)) {
        $newPost = "INSERT INTO post_tb(user_id, title, description) VALUES('$user', '$title', '$description')";

        if (mysqli_query($conn, $newPost)) {
            // Success
            echo "<script>console.log('Post added successfully');</script>";
            header('Location: home.php');
        } else {
            // Log the error for debugging
            error_log("Database Error: " . mysqli_error($conn));
        }

    }

   
}

        ?>
        
        
        
        
        <div class="post">
                <h1>Create Post</h1>
                <button>Select Community</button>

                <form action="" method="post">
                    <input type="text" name="titleInput" id="titleInput" placeholder="Title">
                    <textarea id="bodyInput" name="bodyInput" placeholder="Body"></textarea>
                    <input type="submit" name="add_post" class="postBTN" value="Post">
                </form>



                <div class="interactionHeader">
                    <button class="saveDraftBTN">Save Draft</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
