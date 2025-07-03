<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../php/connect.php';

$pdo=connect_db();
$sql="SELECT username, email, hashpswd FROM users";
$stmt=$pdo->query($sql);
$row=$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>USER REGISTER</title>
        <link rel="stylesheet" href="../css/index.css">
        <script src="../js/sidebar.js"></script>
    </head>
    <body style="background-color: #e6ceac;">
        <div id="mySidebar" class="sidebar">
            <a href="./user_login_page.php">LOGIN</a>
            <a href="../../index.php">HOME</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">

            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>

            <h3>REGISTER USER</h3>

            <div>
                <form action="../../php/user-register.php" method="post" enctype="multipart/form-data">
                    <label for="username">NAME</label>

                    <br>

                    <input type="text" id="username" name="username" required>

                    <br>
                    
                    <label for="email">EMAIL</label>

                    <br>

                    <input type="email" id="email" name="email" required>

                    <br>
                    
                    <label for="password">PASSWORD</label>

                    <br>

                    <input type="password" id="password" name="password" required>

                    <br>
                    <br>

                    <label for="user_img">PROFILE PICTURE</label>

                    <br>

                    <input type="file" id="user_img" name="user_image">

                    <br>
                    <br>

                    <button type="submit" name="user_register">REGISTER</button>
                </form>
            </div>
        </div>
    </body>
</html>