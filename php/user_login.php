<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_start()===PHP_SESSION_NONE){
    session_start();
}

require 'connect.php';
$pdo=connect_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=trim($_POST['username'] ?? '');
    $password=trim($_POST['password'] ?? '');

    if(empty($username) || empty($password)){
        header('Location: ../index.php?login=failed');
        exit; 
    }

    $stmt=$pdo->prepare("SELECT * FROM users WHERE username=? LIMIT 1");
    $stmt->execute([$username]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password,$user['hashpswd'])){
        $_SESSION['user_id']=$user['user_id'];
        $_SESSION['username']=$user['username'];
        $_SESSION['type']=$user['type'];

        if($user['type']==='admin'){
            header('Location: ../public/templates/admin_page.php');
        } else{
            header('Location: ../index.php');
        }
        exit;
    }

    header('Location: ../index.php?login=failed');
    exit;
}
?>