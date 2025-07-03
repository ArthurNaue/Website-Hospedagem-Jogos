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
        <title>USER LOGIN</title>
        <link rel="stylesheet" href="../../public/css/index.css">
        <script src="../../public/js/sidebar.js"></script>
    </head>
    <body style="background-color: #e6ceac;">
        <div id="mySidebar" class="sidebar">
            <a href="./user_register_page.php">REGISTER</a>
            <a href="../../index.php">HOME</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">

            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>

            <h3>LOGIN USER</h3>

            <div>
                <form action="../../php/user_login.php" method="post" enctype="multipart/form-data">
                    <label for="username">USERNAME</label>

                    <br>

                    <input type="text" id="username" name="username" required>

                    <br>
                    
                    <label for="password">PASSWORD</label>

                    <br>

                    <input type="password" id="password" name="password" required>

                    <br>
                    <br>

                    <button type="submit" name="user_login">LOGIN</button>
                </form>
            </div>
        </div>
    </body>
</html>