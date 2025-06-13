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
  <title>Website-test</title>
  <link rel="stylesheet" href="./public/css/style.css">
</head>
<body>
<form action="php/user-register.php" method="post">
  <label for="username">Name:</label>
  <input type="text" id="username" name="username" required>
  
  <label for="email">Email:</label>
  <input type="email" id="email" name="email" required>
  
  <label for="password">Password:</label>
  <input type="password" id="password" name="password" required>

  <button type="submit" name="user_register">Send</button>
</form>

<form action="php/user-show.php" method="get">
  <button type="submit">Show Users</button>
</form>

<form action="php/user-delete.php" method="post">
  <label for="user_id">User ID to delete:</label>
  <input type="text" id="user_id" name="user_id" required>

  <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
</form>

</body>
</html>