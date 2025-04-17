<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/communityPage.css">
</head>

<body>
    <nav class="homeHeader">
        <h1>Class Connect</h1>
        <input class="search" type="text" placeholder="search">
        <button class="addPostBtn">Add new Post</button>
        <a href="profilepage.html">
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
                <h2>Communities</h2>
                <div>
                    <div>

                        <div class="pfp"></div>
                        <div>IT5 - OOP</div>
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

            <div class="communityPageInfo">
                <div class="BGContainer">
                    BG Image
                </div>

                <div class="communityRow">

                    <div class="PagePfp">

                    </div>
                    <h1>Page Name</h1>
                    <button>Create Post</button>
                    <button>Join</button>
                </div>

            </div>

            <div class="communityHighlights">
                <div class="communityHighlightsRow">
                    <h2>Community Highlights</h2>
                    <button>Sort By</button>
                </div>

                <div class="postRow">

                    <div class="CHpost">
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
                        <div>Getting used to how everything's a widget, but the layout system actually makes a lot of
                            sense
                            once
                            you mess with it a bit.
                        </div>
                        <p>10 likes</p>
                        <p>1 comments</p>
                    </div>
                    <div class="CHpost">
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
                        <div>Getting used to how everything's a widget, but the layout system actually makes a lot of
                            sense
                            once
                            you mess with it a bit.
                        </div>
                        <p>10 likes</p>
                        <p>1 comments</p>
                    </div>

                </div>





            </div>


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
            <h2>Page Name</h2>
            <p>2k Followers</p>
            <div>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magni id maiores dignissimos optio libero
                iusto amet, aspernatur nemo hic? Cumque provident maiores facere nisi tempore magni expedita, assumenda,
                autem corporis perferendis sint, voluptates veniam explicabo ab dolore nostrum exercitationem? Aperiam,
                iste! Molestiae maxime blanditiis esse architecto et inventore explicabo!</div>
        </div>
    </div>


</body>

</html>