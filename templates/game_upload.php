<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GAME UPLOAD</title>
        <link rel="stylesheet" href="../public/css/index.css">
        <script src="../public/js/sidebar.js" defer></script>
    </head>
    <body>
        <div id="mySidebar" class="sidebar">
            <a href="user_info.php">USER</a>
            <a href="../index.php">HOME</a>
            <a href="games_page.php">GAMES</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">
            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
            <div class="content-wrapper">
                <div class="form-container">
                    <h3>UPLOAD GAME</h3>
                    <form action="../php/game_insert.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">TITLE</label>
                            <input type="text" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="game_desc">DESCRIPTION</label>
                            <textarea id="game_desc" name="game_desc" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="genre">GENRE</label>
                            <input type="text" id="genre" name="genre" required>
                        </div>
                        <div class="form-group">
                            <label for="cover">COVER IMAGE</label>
                            <input type="file" id="cover" name="cover" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label for="game_file">GAME FILE (.zip, .rar)</label>
                            <input type="file" id="game_file" name="game_file" required>
                        </div>
                        <button type="submit">UPLOAD GAME</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>