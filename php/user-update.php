<?php
include 'connect.php';
$pdo=connect_db();

//verify register type to make inserts on database.
if(isset($_POST['user_update'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    //Transform user password in hash to insert in database.
    $hashpswd=password_hash($password,PASSWORD_DEFAULT);

    //Stores created user variables.
    $sql_user_update=$pdo->prepare("UPDATE users SET username=?, email=?, hashpswd=? WHERE id=?");

    //Linked query parametters in variable values.
    $sql_user_update->execute([$username, $email, $hashpswd]);
} else{
    echo "Invalid Request!";
}
$result=$pdo->query("SELECT * FROM users");
?>
