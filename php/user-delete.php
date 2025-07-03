<?php
require 'connect.php';
$pdo = connect_db();

<<<<<<< Updated upstream
if(isset($_POST['user_id'])){
    $id=intval($_POST['user_id']);
    $sql_user_delete=$pdo->prepare('DELETE FROM users WHERE user_id=?');
    if($sql_user_delete->execute([$id])){
<<<<<<< Updated upstream
        echo "User with ID $id deleted successfully.";
=======
        header("Location: user-show.php");
>>>>>>> Stashed changes
    } else {
        echo "Error deleting user.";
    }
} else{
    echo "User id don't informed!";
=======
if (isset($_POST['user_id'])) {
    $game_id = intval($_POST['user_id']);

    $sql = $pdo->prepare('DELETE FROM users WHERE user_id = ?');
    if ($sql->execute([$game_id])) {
        header("Location: ../public/html/admin_page.php"); // ou a página que lista os jogos
        exit;
    } else {
        echo "Error deleting game.";
    }
} else {
    echo "Game ID not informed!";
>>>>>>> Stashed changes
}
?>