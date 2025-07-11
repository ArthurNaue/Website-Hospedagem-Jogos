<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION)) {
    session_start();
}

include 'connect.php';
$pdo=connect_db();
$stmt=$pdo->prepare("SELECT * FROM users WHERE user_id=?");
$user_id=$_SESSION['user_id'];
$stmt->execute([$user_id]);
$user=$stmt->fetch(PDO::FETCH_ASSOC);

//verify register type to make inserts on database.
if(isset($_POST['user_update'])){
    $new_username=trim($_POST['username']);
    $new_email=trim($_POST['email']);
    $new_password=trim($_POST['password']);
    $new_user_image=$_FILES['user_image'];

    $username=$user['username'];
    $email=$user['email'];
    $hashpswd=$user['hashpswd'];
    $user_image=$user['user_img'];

    if(!empty($new_username)){
        $username=$new_username;
    }

    if(!empty($new_email)){
        if (!filter_var($new_email,FILTER_VALIDATE_EMAIL)){
            echo "Email inválido!";
            exit;
        }
        $email=$new_email;
    }

    if(!empty($new_password)){
        $hashpswd=password_hash($new_password,PASSWORD_DEFAULT);
    }

    $upload_dir= __DIR__ . '/../uploads/profile_images/';
    $image_name='';

    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0755, true);
    }

    $max_size=5 * 1024 * 1024;

    if($new_user_image['size']>$max_size){
        http_response_code(400);
        echo json_encode(['error'=>'File is greater than: 2MB']);
        exit;
    }
    
    if(!empty($new_user_image) && $new_user_image['error']===UPLOAD_ERR_OK){
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($new_user_image['type'], $allowed_types)) {
            echo "Invalid image format!";
            exit;
        }

        $image_name = uniqid() . '-' . basename($new_user_image['name']);
        $upload_dir= __DIR__ . '/../uploads/profile_images/';
        $image_path = $upload_dir . $image_name;

        if(move_uploaded_file($new_user_image['tmp_name'], $image_path)){
            $user_image='uploads/profile_images/' . $image_name;
        }else{
            echo"Error";
            exit;
        }
    }

    $update_stmt=$pdo->prepare("UPDATE users SET username=?, email=?, hashpswd=?, user_img=? WHERE user_id=?");
    $update_stmt->execute([$username,$email,$hashpswd,$user_image,$user_id]);

    header("Location: ../templates/user_info.php");
    exit;
}else{
    echo "Invalid Request!";
}
$result=$pdo->query("SELECT * FROM users");
?>