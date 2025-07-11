<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>USER REGISTER</title>
        <link rel="stylesheet" href="../public/css/index.css">
        <script src="../public/js/sidebar.js" defer></script>
    </head>
    <body>
        <div id="mySidebar" class="sidebar">
            <a href="./user_login_page.php">LOGIN</a>
            <a href="../index.php">HOME</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">
            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
            <div class="content-wrapper">
                <div class="form-container">
                    <h3>REGISTER USER</h3>
                    <form action="../php/user_register.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">NAME</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email">EMAIL</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <div class="form-group">
                            <label for="user_img">PROFILE PICTURE</label>
                            <input type="file" id="user_img" name="user_image">
                        </div>

                        <button type="submit" name="user_register">REGISTER</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>