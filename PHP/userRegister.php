<?php
include 'databaseConnect.php';
$pdo=connect();

//verify register type to make inserts on database.
if(isset($_POST['userRegister'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $pswd=$_POST['password'];

    //Transform user password in hash to insert in database.
    $hashPswd=password_hash($pswd, PASSWORD_DEFAULT);

    //Stores created user variables.
    $sqlUserInsert=$conn->prepare("INSERT INTO users(userName,email,hashPswd) VALUES(?,?,?,?)");

    //Linked query parametters in variable values.
    $stmt->bind_param("sss",$username,$email,$hashPswd);

    //Execute action.
    $stmt->execute();

    //Close after executed.
    $stmt->close();
}
?>
