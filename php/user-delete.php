<?php
include 'connect.php';
$pdo=connect_db();

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
}
$result=$pdo->query('SELECT * FROM users');
?>