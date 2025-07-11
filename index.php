<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()!==PHP_SESSION_ACTIVE){
  session_start();
}

require 'php/connect.php';
$pdo=connect_db();

$user_type=$_SESSION['type'] ?? '';

if($user_type==='admin'){
  header("Location: ./templates/admin_page.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <link rel="stylesheet" href="./public/css/index.css">
  <script src="./public/js/sidebar.js" defer></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="./templates/user_info.php">USER</a>
        <a href="./templates/games_page.php">GAMES</a>
        <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
    </div> 

    <div id="main">
        <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
        
        <div class="content-wrapper">
            <h2>Welcome to the Game Hosting Website!</h2>
            <p>Use the menu on the left to navigate through the pages.</p>
            <ul>
                <li><strong>USER:</strong> Check your profile information.</li>
                <li><strong>GAMES:</strong> See the list of available games to download.</li>
            </ul>
        </div>
    </div>
</body>
</html>