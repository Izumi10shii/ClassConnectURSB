<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassConnect</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <div class="page-wrapper">
        <div class="frontpage">
            <div class="content">
                <div class="title">CLASS CONNECT</div>
                <div class="subtitle">A Web-Based System Dedicated For 
                    University of Rizal System - Binangonan Students</div>
                <button class="custom-button" onclick="navigateWithEffect('php/loginpage.html')">LOGIN</button>
                <button class="custom-button" onclick="navigateWithEffect('php/registerpage.html')">REGISTER</button>
            </div>
            
            <div class="pic" id="imageBanner">
                <button class="prev-arrow" onclick="prevImage(event)">&#10094;</button>
                <button class="next-arrow" onclick="nextImage(event)">&#10095;</button>
                <div class="dots-container-wrapper">
                    <div class="dots-container" id="dotsContainer"></div>
                </div>
            </div>
            
        </div>
    </div>

</body>

<script src="script.js"></script>
</html>
