<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        html{
            overflow-x: hidden;
        }
        body {
            background-color: black;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .homeHeader{
            display: flex;
            width: 100vw;
            justify-content: end;
        }
        .addPostBtn{
            background-color: #1e1e1e;
            padding: 10px;
            color: white;
            border: none;
            margin: 10px 40px;
        }
    </style>
</head>

<body>
    <h1>Class Connect</h1>
    <div class="homeHeader">
        <button class="addPostBtn">Add new Post</button>
    </div>
    <?php
    include("postComponent.php");
    include("postComponent.php");
    include("postComponent.php");
    ?>
</body>

</html>