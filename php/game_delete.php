<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'connect.php';
$pdo=connect_db();

if(!isset($_SESSION['user_id'])){
    die("Denied acess");
}

if(isset($_POST['game_id'])){
    $game_id=intval($_POST['game_id']);//Stores the game id to work check him.
    $user_id=$_SESSION['user_id'];
    $user_type=$_SESSION['user_type'] ?? 'user';

    $stmt=$pdo->prepare("SELECT posted_by FROM games WHERE game_id = ?");
    $stmt->execute([$game_id]);
    $game=$stmt->fetch();

    //Check if user loged is game owner or is admin to deleted.
    if($game&&$game['posted_by']===$user_id){
        $sql=$pdo->prepare('DELETE FROM games WHERE game_id = ?');//Make a prepare with game delete value to avoid sql injection.
        $sql->execute([$game_id]);

        header("Location: ../templates/games_page.php");
        exit;
    }else{
        die("You don't have permission to delete this game");
    }
}else{
    echo "Game ID not informed!";
}
?>