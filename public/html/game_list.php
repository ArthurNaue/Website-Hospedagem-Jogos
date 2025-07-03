<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../../php/connect.php';
$pdo = connect_db();

$stmt = $pdo->query("SELECT game_id, title, cover FROM games ORDER BY publi_date DESC");
$games = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Games</title>
  <link rel="stylesheet" href="../css/user_info.css">
  <style>
    body {
      background-color: #e6ceac;
      font-family: Arial, sans-serif;
    }
    .game-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
      gap: 20px;
      padding: 20px;
    }
    .game-card {
      background-color: #fff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
      text-align: center;
      transition: transform 0.2s;
    }
    .game-card:hover {
      transform: scale(1.03);
    }
    .game-card img {
      width: 100%;
      height: 150px;
      object-fit: cover;
    }
    .game-card h3 {
      padding: 10px;
      font-size: 16px;
    }
    .game-card a {
      text-decoration: none;
      color: inherit;
      display: block;
    }
  </style>
</head>
<body>

  <div style="text-align:center;">
    <h1>Games</h1>
    <a href="../../index.php"><button>Back</button></a>
  </div>

  <div class="game-grid">
    <?php foreach ($games as $game): ?>
      <a href="game_info.php?game_id=<?= $game['game_id'] ?>">
        <div class="game-card">
          <img src="../<?= htmlspecialchars($game['cover']) ?>" alt="<?= htmlspecialchars($game['title']) ?>">
          <h3><?= htmlspecialchars($game['title']) ?></h3>
        </div>
      </a>
    <?php endforeach; ?>
  </div>

</body>
</html>
