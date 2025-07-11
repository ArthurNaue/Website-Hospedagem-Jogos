<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require '../php/connect.php';
$pdo = connect_db();

try {
    $stmt = $pdo->query("SELECT games.*, users.username FROM games JOIN users ON games.posted_by = users.user_id ORDER BY publi_date DESC");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao buscar jogos: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAMES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/index.css">
    <script src="../public/js/sidebar.js" defer></script>
</head>
<body>
    <div id="mySidebar" class="sidebar">
        <a href="../index.php">HOME</a>
        <a href="user_info.php">USER</a>
        <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
    </div>

    <div id="main">
        <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
        <div class="content-wrapper">
            <h2>All Games</h2>
            <a href="game_upload.php" class="button-style" style="margin-bottom: 20px; display: inline-block;">UPLOAD A GAME</a>
            
            <div class="games-grid">
                <?php if (count($games) > 0): ?>
                    <?php foreach ($games as $game): ?>
                        <div class="game-card">
                            <a href="game.php?game_id=<?= $game['game_id'] ?>" style="text-decoration: none; color: inherit; flex-grow: 1;">
                                <?php if (!empty($game['cover'])): ?>
                                    <img src="../<?= htmlspecialchars($game['cover']) ?>" alt="Cover for <?= htmlspecialchars($game['title']) ?>">
                                <?php endif; ?>
                                <h3><?= htmlspecialchars($game['title']) ?></h3>
                                <p><strong>Genre:</strong> <?= htmlspecialchars($game['genre']) ?></p>
                                <p><strong>Posted by:</strong> <?= htmlspecialchars($game['username']) ?></p>
                            </a>
                            
                            <form action="../php/game_download.php" method="POST" class="download-form">
                                <input type="hidden" name="game_id" value="<?= htmlspecialchars($game['game_id'])?>">
                                <button type="submit" class="button-style" style="width: 100%;">Download</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No games found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>