<?php
include 'connect.php'

if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $stmt=$conn->prepare('DELETE FROM users WHERE id=?');
    $stmt->bind_param('i',$id);
    $stmt->execute();
    $stmt->close();
}
$result=$conn->query('SELECT * FROM users');
?>
