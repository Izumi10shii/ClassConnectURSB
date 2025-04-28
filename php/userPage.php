<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/userPage.css">
</head>

<body>

    <?php
    include("nav.php");
    include("userSidebar.php");
    ?>
    <div class="HomeContainer">


        <div class="scrollContainer">

            <div class="communityPageInfo">
                <div class="communityRow">
                    <div class="goLeft">
                        <div class="PagePfp"></div>
                        <h1>John Doe</h1>
                    </div>
                    <div class="goRight">
                        <button class="actionBtn">Follow</button>
                        <button class="actionBtn">Chat</button>
                    </div>
                </div>

                <div class="profileDetails">
                    <div class="followersRow">
                        <p>2k Followers</p>
                        <p>100 Posts</p>
                        <p>1k Comments</p>
                    </div>

                    <div class="profileInfo">
                        <h3>Profile</h3>
                        <p>BSIT 2-1A</p>
                        <p>dummy@email.com</p>
                        <p>BSIT 2-1A</p>
                    </div>
                </div>

                <div class="interests">
                    <h3>Interests</h3>
                    <li>ITEM1</li>
                    <li>ITEM2</li>
                    <li>ITEM3</li>
                </div>
            </div>

            <div class="userRow">
                <button>Posts</button>
                <button>Comments</button>
            </div>
        </div>


</body>

</html>