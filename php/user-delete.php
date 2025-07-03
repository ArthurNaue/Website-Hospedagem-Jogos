<?php
require 'connect.php';
$pdo = connect_db();

if (isset($_POST['user_id'])) {
    $game_id = intval($_POST['user_id']);

    $sql = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
    if ($sql->execute([$game_id])) {
        header("Location: ../public/templates/admin_page.php"); // ou a página que lista os jogos
        exit;
    } else {
        echo "Error deleting game.";
    }
} else {
    echo "Game ID not informed!";
}
?>