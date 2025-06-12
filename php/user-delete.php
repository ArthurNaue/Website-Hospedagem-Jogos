<?php
include 'connect.php';
$pdo=connect_db();

if(isset($_GET['user_id'])){
    $id=intval($_GET['user_id']);
    $sql_user_delete=$pdo->prepare('DELETE FROM users WHERE user_id=?');
    $sql_user_delete->execute([$id]);
} else{
    echo "User id don't informed!";
}
$result=$pdo->query('SELECT * FROM users');
?>