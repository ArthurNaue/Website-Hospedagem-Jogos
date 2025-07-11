<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../php/connect.php';
$pdo = connect_db();

if (!isset($_GET['game_id'])) {
    header("Location: ../../index.php");
    exit;
}

session_start();

$game_id = $_GET['game_id'];
$user_id = $_SESSION['user_id'] ?? null; 

$stmt = $pdo->prepare("SELECT g.*, u.username FROM games g JOIN users u ON g.posted_by = u.user_id WHERE g.game_id = ?");
$stmt->execute([$game_id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    header("Location: games_page.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($game['title']) ?></title>
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
        <h2><?= htmlspecialchars($game['title']) ?></h2>

        <?php if (!empty($game['cover'])): ?>
            <img src="../<?= htmlspecialchars($game['cover']) ?>" alt="Cover for <?= htmlspecialchars($game['title']) ?>" class="game-detail-cover">
        <?php endif; ?>

        <p class="game-description"><strong>Genre:</strong> <?= htmlspecialchars($game['genre']) ?></p>
        <p class="game-description"><strong>Posted by:</strong> <?= htmlspecialchars($game['username']) ?> on <?= date('d/m/Y', strtotime($game['publi_date'])) ?></p>
        
        <h3>Description</h3>
        <p class="game-description"><?= nl2br(htmlspecialchars($game['game_desc'])) ?></p>

        <form action="../php/game_download.php" method="POST" style="margin-bottom: 20px;">
            <input type="hidden" name="game_id" value="<?= htmlspecialchars($game['game_id']) ?>">
            <button type="submit" class="button-style">Download Game</button>
        </form>

        <?php if (isset($user_id) && ($user_id == $game['posted_by'] || ($_SESSION['type'] ?? '') === 'admin')): ?>
            <hr style="margin: 30px 0;">
            <div class="form-container">
                <h3>Manage Game</h3>
                <form action="../php/game_update.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="game_id" value="<?= $game['game_id'] ?>">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" id="title" name="title" value="<?= htmlspecialchars($game['title']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="game_desc">Description:</label>
                        <textarea id="game_desc" name="game_desc"><?= htmlspecialchars($game['game_desc']) ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre:</label>
                        <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($game['genre']) ?>">
                    </div>
                    <div class="form-group">
                        <label for="cover">New Cover (optional):</label>
                        <input type="file" id="cover" name="cover" accept="image/*">
                    </div>
                    <button type="submit" name="game_update" onclick="return confirm('Are you sure you want to update this game?')">Update Game</button>
                </form>

                <form action="../php/game_delete.php" method="POST" onsubmit="return confirm('ARE YOU SURE YOU WANT TO DELETE THIS GAME? THIS ACTION CANNOT BE UNDONE.');" style="margin-top: 20px;">
                    <input type="hidden" name="game_id" value="<?= htmlspecialchars($game['game_id']) ?>">
                    <button type="submit" class="button-style" style="background-color: #c0392b;">Delete Game Permanently</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</div>
</body>
</html>