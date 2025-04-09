<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: black;
            color: white;
            
        }
        .post{
            display: flex;
            justify-self: center;
            align-items: start;
            flex-direction: column;
            text-align: justify;
            background-color: #1e1e1e;
            padding: 20px;
            gap:20px;
            margin: 20px;
        }
        .pfp{
            width: 40px;
            height: 40px;
            background-color: gray;
            display: grid;
            place-content: center;
        }
        .postHeader{
            display: flex;
            justify-content: start;
            align-items: center;
            gap: 20px;
        }
        .interactionHeader{
            display: flex;
            gap: 20px;
        }
    </style>

</head>

<body>
    <div class="post">
        <div class="postHeader">

            <div class="pfp">IMG</div>

                <div>Username</div>
                <div>Post Title</div>

        </div>
        <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti corrupti enim provident porro? Unde inventore enim doloribus reiciendis autem sunt? Nisi praesentium nam ipsum consequuntur adipisci, vitae magnam optio perspiciatis vero laborum veniam incidunt id eveniet quis dolor? Nam, quisquam.</div>
        <div class="interactionHeader">
            <div class="like">like</div>
            <div class="comment">comment</div>
            <div class="share">share</div>
        </div>
    </div>
</body>

</html>

<?php

?>