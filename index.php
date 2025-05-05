<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Information -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassConnect</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Frontpage Section -->
        <div class="frontpage">
            <!-- Content Section -->
            <div class="content">
                <div class="title">CLASS CONNECT</div>
                <div class="subtitle">A Web-Based System Dedicated For 
                    University of Rizal System - Binangonan Students</div>
                <button class="custom-button" onclick="navigateWithEffect('php/loginpage.php')">LOGIN</button>
                <button class="custom-button" onclick="navigateWithEffect('php/registerpage.php')">REGISTER</button>
            </div>
            
            <!-- Image Banner Section -->
            <div class="pic" id="imageBanner">
                <!-- Navigation Arrows -->
                <button class="prev-arrow" onclick="prevImage(event)">&#10094;</button>
                <button class="next-arrow" onclick="nextImage(event)">&#10095;</button>
                <!-- Dots Navigation -->
                <div class="dots-container-wrapper">
                    <div class="dots-container" id="dotsContainer"></div>
                </div>
            </div>
        </div>
    </div>

</body>

<!-- JavaScript -->
<script src="script.js"></script>
</html>
