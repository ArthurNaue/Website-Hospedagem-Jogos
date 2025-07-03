<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../php/connect.php';

$pdo=connect_db();
$sql="SELECT title, game_desc, publi_date, cover, genre, game_file, posted_by FROM games";
$stmt=$pdo->query($sql);
$row=$stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GAME UPLOAD</title>
        <link rel="stylesheet" href="../css/index.css">
        <script src="../js/sidebar.js"></script>
    </head>
    <body style="background-color: #e6ceac;">
        <div id="mySidebar" class="sidebar">
            <a href="./user_info.php">USER</a>
            <a href="../../index.php">HOME</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">

            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>

            <h3>UPLOAD GAME</h3>

            <div>
                <form action="../../php/game_insert.php" method="post" enctype="multipart/form-data">
                    <label for="title">TITLE</label><br>
                    <input type="text" id="title" name="title" required><br>

                    <label for="game_desc">DESCRIPTION</label><br>
                    <textarea id="game_desc" name="game_desc" rows="4" cols="50" required></textarea><br>

                    <label for="genre">GENRE</label><br>
                    <input type="text" id="genre" name="genre" required><br><br>

                    <label for="cover">COVER IMAGE</label><br>
                    <input type="file" id="cover" name="cover" accept="image/*"><br><br>

                    <label for="game_file">GAME FILE</label><br>
                    <input type="file" id="game_file" name="game_file" required><br><br>

                    <button type="submit">UPLOAD</button>
                </form>
            </div>
        </div>
    </body>
</html>