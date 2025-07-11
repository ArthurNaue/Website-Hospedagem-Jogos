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

    if($user && password_verify($password,$user['hashpswd'])){//Check if informations is correct.
        //Stores the user loged values.
        $_SESSION['user_id']=$user['user_id'];
        $_SESSION['username']=$user['username'];
        $_SESSION['type']=$user['type'];

        if($user['type']==='admin'){//Check user type to send loged user to some page.
            header('Location: ../templates/admin_page.php');//In admin case.
        } else{
            header('Location: ../index.php');//In user case.
        }
        exit;
    }

    header('Location: ../index.php?login=failed');
    exit;
}
?>