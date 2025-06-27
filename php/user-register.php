<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';
$pdo=connect_db();

//verify register type to make inserts on database.
if(isset($_POST['user_register'])) {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $user_image=$_FILES['user_image'];

    $upload_dir= '../public/uploads/profile_images/';
    $image_name = uniqid() . '-' . basename($user_image['name']);
    $image_path = $upload_dir . $image_name;

    if(move_uploaded_file($user_image['tmp_name'], $image_path)){

        //Transform user password in hash to insert in database.
        $hashpswd=password_hash($password,PASSWORD_DEFAULT);

        //Stores created user variables.
        $sql_user_insert=$pdo->prepare("INSERT INTO users(username, email, hashpswd, user_img) VALUES(?,?,?,?)");

        //Linked query parametters in variable values.
        $sql_user_insert->execute([$username, $email, $hashpswd, $image_path]);

        echo "User's created.";
    } else {
        echo "User dont created";
    }

} else {
    echo "Invalid Request";
}
$result=$pdo->query("SELECT * FROM users");
?>
