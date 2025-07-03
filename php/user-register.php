<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()!==PHP_SESSION_ACTIVE){
    session_start();
}

include 'connect.php';
$pdo=connect_db();

//verify register type to make inserts on database.
if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=trim($_POST['username']);
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);
    $user_image=$_FILES['user_image'];

   if(empty($username) || empty($email) || empty($password)){
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "E-mail inválido!";
        exit;
    }

    $upload_dir=__DIR__ . '../uploads/profile_images/';
    $image_name='';

    $max_size=2 * 1024 * 1024;

    if($user_image['size']>$max_size){
        http_response_code(400);
        echo json_encode(['error' => 'Arquivo excede o tamanho máximo permitido (2MB).']);
        exit; 
    }
    
    if(!empty($user_image) && $user_image['error']===UPLOAD_ERR_OK){
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if(!in_array($user_image['type'], $allowed_types)){
            echo "Formato de imagem inválido!";
            exit;
        } 

        $image_name=uniqid() . '-' . basename($user_image['name']);
        $image_path=$upload_dir . $image_name;

        if(move_uploaded_file($user_image['tmp_name'], $image_path)){
            $user_image='uploads/profile_images/' . $image_name;
        }else{
            echo"Error";
            exit;
        }
    }else{
        $default_pics_dir=('../public/assets/default_pics/');
        $default_pics_files=array_diff(scandir($default_pics_dir), ['.', '..']);
        $random=$default_pics_files[array_rand($default_pics_files)];
        $user_image='/assets/default_pics/' . $random;
    }

    $hashpswd=password_hash($password,PASSWORD_DEFAULT);

    $sql_user_insert=$pdo->prepare("INSERT INTO users(username, email, hashpswd, user_img) VALUES(?,?,?,?)");
    $sql_user_insert->execute([$username, $email, $hashpswd, $user_image]);


    $stmt=$pdo->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$username]);
    $user=$stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($password,$user['hashpswd'])){
        $_SESSION['user_id']=$user['user_id'];
        $_SESSION['username']=$user['username'];
        $_SESSION['type']=$user['type'];

        if($user['type']==='admin'){
            header('Location: admin_page.php');
        } else{
            header('Location: ../index.php');
        }
        exit;
    }
    header('Location: ../index.php?login=failed');
    exit;
}
?>