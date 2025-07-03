<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connect.php';
$pdo = connect_db();

if (isset($_POST['game_id'])) {
    $game_id = intval($_POST['game_id']);

    $sql = $pdo->prepare('DELETE FROM games WHERE game_id = ?');
    if ($sql->execute([$game_id])) {
        header("Location: ../public/templates/games_page.php"); // ou a página que lista os jogos
        exit;
    } else {
        echo "Error deleting game.";
    }
} else {
    echo "Game ID not informed!";
}
?>