<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connect.php';
$pdo = connect_db();

if (isset($_POST['game_id'])) {
    $game_id = $_POST['game_id'];

    $stmt = $pdo->prepare("SELECT title, game_file FROM games WHERE game_id = ?");
    $stmt->execute([$game_id]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($game) {
        $file_path = $game['game_file'];

        if (file_exists($file_path)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            readfile($file_path);
            exit;
        }else{
        echo "Game not found.";
    }
}
}else{
    echo "No game ID provided.";
}
?>
