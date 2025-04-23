<?php
include("db_conn.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/home.css">

</head>

<body>


    <?php
    //get postData from post_tb

    $getPost = "SELECT * FROM post_tb";
    $result = mysqli_query($conn, $getPost);

    if ($result && mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $user_id = $row['user_id'];
            $title = $row['title'];
            $description =  $row['description'];
        
    
    ?>
    <div class="post">
        <div class="postHeader">
            <div class="pfp">
                <img src="../bg/sample8.png" alt="Profile Picture">
            </div>
            <div class="postHeaderPoster">
                <div class="postHeaderCol">
                    <p>ITE7</p>
                    <div><strong><?php echo htmlspecialchars($user_id); ?></strong></div>
                </div>
                <p>1hr ago</p>
            </div>
        </div>
        <h2><?php echo htmlspecialchars($title); ?></h2>
        <div>
            <p><?php echo htmlspecialchars($description); ?></p>
        </div>
        <div class="interactionHeader">
            <button class="like">like</button>
            <button class="commentBTN">comment</button>
            <button class="share">share</button>
        </div>
    </div>

    <?php 
        }
    }else{
        echo"<p>NO posts available.<p>";
    }
    ?>

</body>

</html>

<?php

?>