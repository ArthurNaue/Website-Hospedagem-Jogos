<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()!==PHP_SESSION_ACTIVE){
    session_start();
}

if(!isset($_SESSION['user_id'])){
    header("Location: ../templates/user_login_page.php");
    exit;
}

require '../../php/connect.php';

$pdo=connect_db();
$stmt=$pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    header("Location: ../templates/user_register_page.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>USER INFO</title>
        <link rel="stylesheet" href="../css/user_info.css">
        <script src="../js/sidebar.js"></script>
        <script src="../js/user.js"></script>
    </head>
    <body style="background-color: #e6ceac;">
        <div id="mySidebar" class="sidebar">
            <a href="user_register_page.php">REGISTER</a>
            <a href="user_login_page.php">LOGIN</a>
            <a href="../../index.php">HOME</a>
            <a href="games_page.php">GAMES</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 
        <div id="main">
            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>

            <div class="user">
                <img src="../<?= htmlspecialchars($user['user_img']) ?>" alt="User Image" style="height: 100%; width: 100%; position: absolute; left: 0vh; top: 0vh;">
           </div>

            <br><br><br><br><br><br><br><br><br><br><br><br>

            <ul>
                <li>ID: <?= htmlspecialchars($user['user_id']) ?></li>
                <li>Username: <?= htmlspecialchars($user['username']) ?></li>
                <li>Email: <?= htmlspecialchars($user['email']) ?></li>
                <a href="../../php/user_logout.php">Logout</a>
            </ul>

            <h2>Update Users:</h3>

            <div>
                <form action="../../php/user-update.php" method="post" enctype="multipart/form-data">

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email">

                <br>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password">

                <br>

                <label for="user_img">Profile Image:</label>
                <input type="file" id="user_img" name="user_image">

                <br>

                <button type="submit" name="user_update" onclick="return confirm('Are you sure you want to update this user?')">Update</button>
                </form>
            </div>
        </div>
    </body>
</html>