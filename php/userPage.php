<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/userPage.css?=v2">
</head>

<body>
    <nav class="homeHeader">
        <h1>Class Connect</h1>
        <input class="search" type="text" placeholder="Search" />
        <button class="addPostBtn">Add new Post</button>
        <a href="userPage.html">
            <div class="pfp profile"></div>
        </a>
    </nav>

    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <div class="homebtn lsu">Home</div>
                <div class="popularbtn lsu">Profile</div>

                <div class="explorebtn lsu">
                    <a href="explorePage.php">
                        Explore Discussions
                    </a>
                </div>

                <div class="popularbtn lsu">File Storage</div>

                <div class="popularbtn lsu">
                    <a href="adminUsersList.php">
                        Registered Users
                    </a>
                </div>

                <div class="popularbtn lsu">
                    <a href="adminPostsList.php">
                        Post Management
                    </a>
                </div>

                <div class="popularbtn lsu">Settings</div>
            </div>
            <div class="leftSideDown">
                <div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <!--
            <?php
            include("postComponent.php");
            ?>
            -->

        <div class="scrollContainer">

            <div class="communityPageInfo">
                <div class="communityRow">

                    <div class="PagePfp">

                    </div>

                    <h1>username</h1>
                    <button class="actionBtn">Follow</button>
                    <button class="actionBtn">Chat</button>

                </div>

                <div class="interests">
                    Interests
                </div>
            </div>

            <div class="userRow">
                <button>Posts</button>
                <button>Comments</button>
            </div>

            <!--
            <div class="post">
                <div class="postHeader">
                    <div class="pfp"></div>
                    <div class="postHeaderPoster">
                        <div class="postHeaderCol">
                            <p>ITE7</p>
                            <div>username</div>
                        </div>
                        <p>1hr ago</p>
                    </div>
                </div>
                <h2>Trying out Flutter lately — pretty solid so far.</h2>
                <div>Getting used to how everything's a widget, but the layout system actually makes a lot of sense once
                    you mess with it a bit. Built a small UI just to test stuff like navigation and basic theming. Not
                    bad at all.
                    Still figuring out the best way to handle state, but it’s clicking slowly.
                    If anyone’s got clean Flutter repos or go-to tutorials, I’m all ears.</div>

                    --
                <div class="interactionHeader">
                    <button class="like">like</button>
                    <button class="commentBTN">comment</button>
                    <button class="share">share</button>
                </div>
-->
        </div>
        <!--
                <div class="commentSection">
                    <h4>Add Comment</h4>
                    <div class="addComment">
                        <textarea name="" id=""></textarea>
                        <button class="sendCommentBTN">send</button>
                    </div>
                    
                </div>
           

        </div>
 -->

        <div class="rightSidebar">
            <h2>username</h2>
            <p>2k Followers</p>
            <p>100 Posts</p>
            <p>1k Posts</p>

            <br>
            <h2>Profile</h2>
            <p>John Doe</p>
            <p>BSIT 2-1A</p>
        </div>
    </div>


</body>

</html>