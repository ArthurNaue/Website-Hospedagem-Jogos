<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../php/connect.php';
$pdo = connect_db();

try {
    $stmt = $pdo->query("SELECT games.*, users.username FROM games JOIN users ON games.posted_by = users.user_id ORDER BY publi_date DESC");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar jogos: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAMES</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/index.css">
    <script src="../js/sidebar.js"></script>
</head>
<body style="background-color: #e6ceac;">
    <div id="mySidebar" class="sidebar">
        <a href="../../index.php">HOME</a>
        <a href="user_info.php">USER</a>
        <a href="https://github.com/ArthurNaue/Website-Hospedagem-Jogos">GITHUB</a>
    </div>

    <div id="main">
        <button id="button" class="openbtn" onclick="openOrCloseNav()">OPEN</button>
        <h2>Games Page</h2>
        <a href="game_upload.php">UPLOAD A GAME</a>
        <hr>

        <?php if (count($games) > 0): ?>
            <?php foreach ($games as $game): ?>
               <a href="game.php?game_id=<?= $game['game_id'] ?>" style="text-decoration: none;">
                    <div id="game-info" style="border-bottom: 1px solid; padding-bottom: 15px;">
                        <h3><?= htmlspecialchars($game['title']) ?></h3>
                        <p>Genre: <?= htmlspecialchars($game['genre']) ?></p>
                        <p>Posted by: <?= htmlspecialchars($game['username']) ?></p>

                        <?php if (!empty($game['cover'])): ?>
                            <img src="../<?= htmlspecialchars($game['cover']) ?>" alt="Game Cover" style="max-width: 100px; max-height: 100px;">
                        <?php endif; ?>

                        <br><br>
                        <form method="post" action="../../php/game_download.php">
                            <input type="hidden" name="game_id" value="<?= $game['game_id'] ?>">
                            <button type="submit">Download Game</button>
                        </form>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No games found.</p>
        <?php endif; ?>
    </div>
</body>
</html>