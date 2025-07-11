<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()!==PHP_SESSION_ACTIVE){
  session_start();
}

include '../php/connect.php';
$pdo=connect_db();

$user_type=$_SESSION['type'] ?? '';

if($user_type!=='admin'){
  header("Location: ../index.php?admin=error");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ADMIN PANEL</title>
  <link rel="stylesheet" href="../public/css/index.css">
  <script src="../public/js/sidebar.js" defer></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="../index.php">HOME</a>
        <a href="user_info.php">USER</a>
        <a href="games_page.php">GAMES</a>
        <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
    </div>

    <div id="main">
        <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
        <div class="content-wrapper">
            <h2>Admin Panel</h2>
            <p>Use the buttons below to manage users and games.</p>
            <div class="admin-actions">
                <form action="../php/user_show.php" method="post">
                    <button type="submit" class="button-style">Show Users</button>
                </form>
           </div>
        </div>
    </div>
</body>
</html>