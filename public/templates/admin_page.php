<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../../php/connect.php';
$pdo=connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
  <link rel="stylesheet" href="../css/index.css">
  <script src="../js/sidebar.js"></script>
</head>
<body style="background-color: #e6ceac;">
<div id="mySidebar" class="sidebar">
    <a href="user_info.php">USER</a>
    <a href="games_page.php">GAMES</a>
    <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
    </div> 
<div id="main">
  <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
  <div>
    <form action="../../php/user-show.php" method="post" enctype="multipart/form-data">
      <button type="submit">Show users</button>
    </form>
  </div>
</div>
</body>
</html>