<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'connect.php';
$pdo = connect_db();

if(isset($_POST['game_id'])){
    $game_id = $_POST['game_id'];
    $stmt = $pdo->prepare("SELECT title, game_file FROM games WHERE game_id = ?");//To avoid sql injection.
    $stmt->execute([$game_id]);//Insert in '?'.
    $game = $stmt->fetch(PDO::FETCH_ASSOC);//This variable stores the SQL SELECT returns.
    if($game){//If find the game.
        $file_path = '../' . $game['game_file'];//game_file contains the file path.

        $absolute_path = realpath($file_path);//Convert to absolute path.

        if($absolute_path && file_exists($absolute_path)){//If file exists in directory.
            header('Content-Type: application/octet-stream');//Tells the browser that it is a generic binary, so it will not try to open it, just download it.
            header('Content-Disposition: attachment; filename="' . basename($absolute_path) . '"');//Tells the browser that the content should be treated as an attachment, and suggests a filename to save it as.
            header('Content-Length: ' . filesize($absolute_path));//Define the file size for browser.
            readfile($absolute_path);//Read file_path content.
            exit;
        }else{
            echo "Game not found.";
        }
    }
}else{
    echo "No game ID provided.";
}
?>