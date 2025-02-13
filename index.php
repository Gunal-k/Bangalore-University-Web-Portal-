<!-- 
Project Name: Bangalore University Web Portal
Author: Gunal K
Created on: October 2024
License: MIT License
Description: This is a university web portal for students to view academic records and access resources.

Copyright © 2025 Gunal K. All Rights Reserved.
Unauthorized copying, modification, or distribution of this code is strictly prohibited.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/headfoot.css">
    <link rel="icon" href="assets/kn_seal.png" type="image/x-icon">
    <script>
        function loadPage(page) {
            const contentDiv = document.getElementById('content');
            fetch(page + '.php')
                .then(response => {
                    if (!response.ok) throw new Error('Page not found');
                    return response.text();
                })
                .then(html => {
                    contentDiv.innerHTML = html;
                })
                .catch(error => {
                    console.error('Error loading page:', error);
                    window.location.href = 'login.php';
                });
        }
    </script>
</head>
<style>
    .head{
        display: flex;
        justify-content: flex-end;
    }
    .head button{
        margin-right: 50px;
    }
</style>
<body>
<header>
    <span id="main">
        <img src="assets/education (1).png" alt="Bangalore University" class="logo">
        <h2>Bangalore University</h2>
    </span>
    <div class="head">
        <button onclick="loadPage('Home')">Home</button>
        <button onclick="loadPage('about')" >About</button>
        <button onclick="loadPage('join')" >Join</button>
        <button onclick="loadPage('courses')" >Courses</button>
        <button onclick="loadPage('contact')" >Contact</button>
        <button onclick="window.location.href='login.php'" class="login">Login</button>
    </div>
</header>
<div id="content">
    <?php
    include 'Home.php';
    ?>
</div>
<footer>
    <div class="foot">
        <div class="name">
            <h3>Bangalore <span class="Uni">University</span></h3>
            <div class="item">
                <div class="itemw">
                    <div class="row1">
                        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">Home</a>
                        <a href="#">Terms of Use</a>
                    </div>
                    <div class="row2">
                        <a href="https://www.google.com/maps/dir//Bengaluru+University" target="_blank">Directions</a>
                        <a href="#">Privacy</a>
                    </div>
                    <div class="row3">
                        <a href="https://www.google.co.in/search?q=bangalore+university&sca_esv=3ba6c21c49c51756&source=hp&ei=iwkfZ7W7CuCR4-EPqqi28As&iflsig=AL9hbdgAAAAAZx8Xm97DyrWnQuyQ5IPVhA80HzFCF27Q&gs_ssp=eJzj4tTP1TdINzRJrzBg9BJJSsxLT8zJL0pVKM3LLEstKs4sqQQArrcLdg&oq=bangalore+universot&gs_lp=Egdnd3Mtd2l6IhNiYW5nYWxvcmUgdW5pdmVyc290KgIIADIKEC4YgAQYsQMYCjIHEAAYgAQYCjIHEAAYgAQYCjIQEC4YgAQYxwEYChiOBRivATIHEAAYgAQYCjIHEAAYgAQYCjIKEAAYgAQYsQMYCjIHEAAYgAQYCjIHEAAYgAQYCjIHEAAYgAQYCkjhJ1D8BFirHHABeACQAQCYAasCoAGdGaoBBjAuMTcuMrgBA8gBAPgBAZgCFKAC4xyoAgrCAhAQABgDGOUCGOoCGIwDGI8BwgITEC4YAxjlAhjHAxjqAhiMAxiPAcICEhAAGAMY5QIY6gIYChiMAxiPAcICEBAuGAMY5QIY6gIYjAMYjwHCAggQABiABBixA8ICCxAAGIAEGLEDGIMBwgIOEC4YgAQYsQMYgwEYigXCAg4QABiABBixAxiDARiKBcICDhAuGIAEGLEDGNEDGMcBwgIFEAAYgATCAgsQLhiABBixAxiDAcICCBAuGIAEGLEDwgIFEC4YgATCAg4QLhiABBjHARiOBRivAcICERAuGIAEGLEDGMcBGI4FGK8BwgIQEAAYgAQYsQMYgwEYRhiAApgDLJIHCDEuMTMuNS4xoAfW9wE&sclient=gws-wiz" target="_blank">Search</a>
                        <a href="#">Copyright</a>
                    </div>
                    <div class="row4">
                        <a href="#">Trademarks</a>
                        <a href="#">Accessibility</a>
                    </div>
                </div>
            </div>
            <div class="contact">
                <h4>Contact Us</h4>
                <div class="cont">
                    <div class="r1"><img src="assets/mail.png" alt="mail"><a href="mailto:bangaloreuniversity.edu@gmail.com">bangaloreuniversity.edu@gmail.com</a></div>
                    <div class="r2"><img src="assets/call.png" alt="call"><a href="#">1800 3996 4123</a></div>
                    <div class="r3"><img src="assets/pin.png" alt=""><a href="#">Bangalore</a></div>
                </div>
            </div>
        </div>
    </div>
    <p>&copy; <?php echo date('Y')?> Bangalore University, All rights reserved</p>
</footer>
</body>
</html>
