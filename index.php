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

  <h3>Register User:</h3>

  <div>
    <form action="php/user-register.php" method="post" enctype="multipart/form-data">
      <label for="username">Name:</label>
      <input type="text" id="username" name="username" required>
      
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="user_img">User img: </label>
      <input type="file" id="user_img" name="user_image" required>

      <button type="submit" name="user_register">Send</button>
    </form>
  </div>

  
  <ul></ul>

  <div>
    <form action="php/user-delete.php" method="post">
      <label for="user_id">User ID to delete:</label>
      <input type="text" id="user_id" name="user_id" required>

      <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
    </form>
  </div>

  <h3>Show Users:</h3>

  <div>
    <form action="php/user-show.php" method="post" enctype="multipart/form-data">
      <button type="submit">Show users:</button>
    </form>
  </div>

  <h3>Update Users:</h3>

  <div>
    <form action="php/user-update.php" method="post" enctype="multipart/form-data">
      <label for="user_id">User ID:</label>
      <input type="text" id="user_id" name="user_id" required>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="user_img">Profile Image:</label>
      <input type="file" id="user_img" name="user_image" required>

      <button type="submit" name="user_update" onclick="return confirm('Are you sure you want to update this user?')">Update</button>
    </form>
  </div>

</div>
</body>
</html>