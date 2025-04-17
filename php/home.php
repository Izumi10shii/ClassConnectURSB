<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/home.css">
</head>

<body>
    <nav class="homeHeader">
        <h1>Class Connect</h1>
        <input class="search" type="text" placeholder="search">
        <a href="addPost.html">
            <button class="addPostBtn">Add new Post</button>
        </a>
        <a href="userPage.html"><div class="pfp profile"></div></a>
    </nav>

    <div class="HomeContainer">
        <div class="leftSidebar">
            <div class="leftSideUp">
                <div class="homebtn lsu">Home</div>
                
                <div class="explorebtn lsu">
                    <a href="explorePage.html">
                        Explore
                    </a>
                </div>

                <div class="popularbtn lsu">Popular</div>

            </div>
            <div class="leftSideDown">
                <h2>Communities</h2>
                <div>
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

        <!--
            <?php
            include("postComponent.php");
            include("postComponent.php");
            include("postComponent.php");
            ?>
            -->

        <div class="scrollContainer">

            <a href="postPage.html">
            <div class="post">
                <div class="postHeader">
                    <div class="pfp">IMG</div>
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
                <div class="interactionHeader">
                    <button class="like">like</button>
                    <button class="commentBTN">comment</button>
                    <button class="share">share</button>
                </div>

            </div>
        </a>

        
            <div class="post">
                <div class="postHeader">
                    <div class="pfp">IMG</div>
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
                <div class="interactionHeader">
                    <button class="like">like</button>
                    <button class="commentBTN">comment</button>
                    <button class="share">share</button>
                </div>

            </div>
            <!--
                <div class="commentSection">
                    <h4>Add Comment</h4>
                    <div class="addComment">
                        <textarea name="" id=""></textarea>
                        <button class="sendCommentBTN">send</button>
                    </div>
                    
                </div>
            -->

        </div>


        <div class="rightSidebar">
            <h2>Friends</h2>
            <div>
                <div class="pfp"></div>
                <div>Person 1</div>
            </div>
            <div>
                <div class="pfp"></div>
                <div>Person 1</div>
            </div>
            <div>
                <div class="pfp"></div>
                <div>Person 1</div>
            </div>
            <button>Inbox</button>

        </div>
    </div>


</body>

</html>