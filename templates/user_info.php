<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../templates/user_login_page.php");
    exit;
}

require '../php/connect.php';

$pdo=connect_db();
$stmt=$pdo->prepare("SELECT * FROM users WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user=$stmt->fetch(PDO::FETCH_ASSOC);

if(!$user){
    session_destroy();
    header("Location: ./user_register_page.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>USER INFO</title>
        <link rel="stylesheet" href="../public/css/index.css"> 
        <script src="../public/js/sidebar.js" defer></script>
    </head>
    <body>
        <div id="mySidebar" class="sidebar">
            <a href="../index.php">HOME</a>
            <a href="games_page.php">GAMES</a>
            <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
        </div> 

        <div id="main">
            <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
            <div class="content-wrapper">
                <div class="user-info-header">
                    <div class="user-pic-container">
                        <?php $imagePath = !empty($user['user_img']) ? '../' . htmlspecialchars($user['user_img']) : '../public/assets/default_pics/placeholder.png'; ?>
                        <img src="<?= $imagePath ?>" alt="User Profile Image">
                    </div>
                    <div class="user-details">
                        <ul>
                            <li><strong>ID:</strong> <?= htmlspecialchars($user['user_id']) ?></li>
                            <li><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></li>
                            <li><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></li>
                            <li><a href="../php/user_logout.php">Logout</a></li>
                        </ul>
                    </div>
                </div>

                <div class="form-container">
                    <h3>Update Information</h3>
                    <form action="../php/user_update.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="username">New Username:</label>
                            <input type="text" id="username" name="username" placeholder="Leave blank to keep current">
                        </div>
                        <div class="form-group">
                            <label for="email">New Email:</label>
                            <input type="email" id="email" name="email" placeholder="Leave blank to keep current">
                        </div>
                        <div class="form-group">
                            <label for="password">New Password:</label>
                            <input type="password" id="password" name="password" placeholder="Leave blank to keep current">
                        </div>
                        <div class="form-group">
                            <label for="user_img">New Profile Image:</label>
                            <input type="file" id="user_img" name="user_image">
                        </div>
                        <button type="submit" name="user_update" onclick="return confirm('Are you sure you want to update your info?')">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>