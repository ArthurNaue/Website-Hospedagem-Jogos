<?php
include 'connect.php';
$pdo=connect_db();

//verify register type to make inserts on database.
if(isset($_POST['user_update'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];

    //Transform user password in hash to insert in database.
    $hashpswd=password_hash($pswd,PASSWORD_DEFAULT);

    //Stores created user variables.
    $sql_user_update=$conn->prepare("UPDATE users SET username=?, email=?, hashpswd=? WHERE id=?");

    //Linked query parametters in variable values.
    $stmt->bind_param("sss",$username,$email,$hashpswd);

    //Execute action.
    $stmt->execute();

    //Close after executed.
    $stmt->close();
}
$result=$conn->query("SELECT * FROM users");
?>
