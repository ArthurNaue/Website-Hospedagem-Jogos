<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'php/connect.php';

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
  <title>HOME</title>
  <link rel="stylesheet" href="./public/css/index.css">
  <script src="./public/js/sidebar.js"></script>
</head>
<body style="background-color: #e6ceac;">
<div id="mySidebar" class="sidebar">
    <a href="./public/html/user_info.html">USER</a>
    <a href="./public/html/games.html">GAMES</a>
    <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
    </div> 
<div id="main">
    <button id="button" class="openbtn" onclick="openOrCloseNav()">ABRIR</button>
    <div>
      <form action="php/user-register.php" method="post">
        <label for="username">Name:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit" name="user_register">Send</button>
      </form>
      <a href="php/user-delete.php?user_id=2" onclick="return confirm('Do you really want delete this user?')">Delete</a>
    </div>
</div>

    </body>
</html>