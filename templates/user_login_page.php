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
        <title>USER LOGIN</title>
        <link rel="stylesheet" href="../public/css/index.css">
        <script src="../public/js/sidebar.js" defer></script>
    </head>
    <body>
        <div id="mySidebar" class="sidebar">
            <a href="./user_register_page.php">REGISTER</a>
            <a href="../index.php">HOME</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">
            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
            <div class="content-wrapper">
                <div class="form-container">
                    <h3>LOGIN USER</h3>
                    <form action="../php/user_login.php" method="post">
                        <div class="form-group">
                            <label for="username">USERNAME</label>
                            <input type="text" id="username" name="username" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">PASSWORD</label>
                            <input type="password" id="password" name="password" required>
                        </div>

                        <button type="submit" name="user_login">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>