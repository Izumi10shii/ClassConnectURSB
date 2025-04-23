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
    <h1>Class Connect</h1>
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
            <div class="post">
                <h1>Create Post</h1>
                <button>Select Community</button>

                <input type="text" name="" id="titleInput" placeholder="Title">
                <textarea id="bodyInput" placeholder="Body"></textarea>


                <div class="interactionHeader">
                    <button class="saveDraftBTN">Save Draft</button>
                    <button class="postBTN">Post</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
