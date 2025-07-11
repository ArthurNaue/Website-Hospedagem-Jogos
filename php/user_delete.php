<?php
//This file has gonne be used just in admin loged cases.
require 'connect.php';
$pdo=connect_db();

if(isset($_POST['user_id'])){
    $game_id=intval($_POST['user_id']);
    $sql=$pdo->prepare('DELETE FROM users WHERE user_id = ?');
    if($sql->execute([$game_id])){
        header("Location: ./user_show.php");
        exit;
    }else{
        echo "Error deleting game.";
    }
}else{
    echo "Game ID not informed!";
}
?>