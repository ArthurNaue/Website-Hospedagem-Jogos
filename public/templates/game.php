<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../php/connect.php';
$pdo = connect_db();

if (!isset($_GET['game_id'])) {
    header("Location: ../../index.php");
    exit;
}

session_start();

$game_id = $_GET['game_id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM games WHERE game_id = ?");
$stmt->execute([$game_id]);
$game = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$game) {
    header("Location: game_pages.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Info</title>
    <link rel="stylesheet" href="../css/user_info.css">
    <script src="../js/sidebar.js"></script>
    <script src="../js/user.js"></script>
</head>
<body style="background-color: #e6ceac;">
<div id="mySidebar" class="sidebar">
    <a href="user_register_page.php">REGISTER</a>
    <a href="user_login_page.php">LOGIN</a>
    <a href="../../index.php">HOME</a>
    <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
</div>
<div id="main">
    <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>

    <div class="user">
        <img src="../<?= htmlspecialchars($game['cover']) ?>" alt="Game Cover" style="max-width:200px; max-height:200px;">
    </div>

    <br><br><br><br><br><br><br><br><br><br><br><br>

    <ul>
        <li><strong>ID:</strong> <?= htmlspecialchars($game['game_id']) ?></li>
        <br>
        <li><strong>Title:</strong> <?= htmlspecialchars($game['title']) ?></li>
        <br>
        <li><strong>Genre:</strong> <?= htmlspecialchars($game['genre']) ?></li>
        <br>
        <li><strong>Description:</strong><br><?= nl2br(htmlspecialchars($game['game_desc'])) ?></li>
        <br>
        <li><strong>Published:</strong> <?= htmlspecialchars($game['publi_date']) ?></li>
    </ul>

    <h3>UPDATE</h3>
    <?php if ($user_id === $game['posted_by']): ?>
        <form action="../../php/game_update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="game_id" value="<?= $game['game_id'] ?>">
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" value="<?= htmlspecialchars($game['title']) ?>"><br><br>

            <label for="game_desc">Description:</label><br>
            <textarea id="game_desc" name="game_desc" rows="4" cols="50"><?= htmlspecialchars($game['game_desc']) ?></textarea><br><br>

            <label for="genre">Genre:</label><br>
            <input type="text" id="genre" name="genre" value="<?= htmlspecialchars($game['genre']) ?>"><br><br>

            <label for="cover">New Cover (optional):</label><br>
            <input type="file" id="cover" name="cover" accept="image/*"><br><br>

            <button type="submit" name="game_update" onclick="return confirm('Are you sure you want to update this game?')">Update Game</button>
        </form>

        <br>

        <form action="../../php/game_delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this game?');">
            <input type="hidden" name="game_id" value="<?= htmlspecialchars($game['game_id']) ?>">
            <button type="submit">Delete Game</button>
        </form>
    <?php endif; ?>

    <br>

    <form action="../../php/game_download.php" method="POST">
        <input type="hidden" name="game_id" value="<?= htmlspecialchars($game['game_id']) ?>">
        <button type="submit">Download Game</button>
    </form>
</div>
</body>
</html>
