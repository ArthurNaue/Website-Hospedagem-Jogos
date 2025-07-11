<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()!==PHP_SESSION_ACTIVE){
    session_start();
}

include 'connect.php';
$pdo=connect_db();

if($_SERVER['REQUEST_METHOD']==='POST'){
    $username=htmlspecialchars(trim($_POST['username']), ENT_QUOTES, 'UTF-8');
    $email=trim($_POST['email']);
    $password=trim($_POST['password']);
    $user_image=$_FILES['user_image'];

    //Checking duplicates emails.
    $email_check=$pdo->prepare("SELECT 1 FROM users WHERE email = ?");
    $email_check->execute([$email]);
    if($email_check->fetch()){
        echo "This email has already been used";
        exit;
    } 

   if(empty($username)||empty($email)||empty($password)){
        echo "All the filed are mandatory!";
        exit;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo "Invald email!";
        exit;
    }

    $upload_dir=__DIR__ . '/../uploads/profile_images/';
    $image_name='';

    if(!is_dir($upload_dir)){
        mkdir($upload_dir, 0755, true);
    }

    $max_size=5*1024*1024;

    if($user_image['size']>$max_size){
        http_response_code(400);
        echo json_encode(['error'=>'File is greater than: 2MB']);
        exit; 
    }
    
    if(!empty($user_image)&&$user_image['error']===UPLOAD_ERR_OK){
        $allowed_types=['image/jpeg', 'image/png', 'image/gif', 'image/jpg'];
        if(!in_array($user_image['type'], $allowed_types)){
            echo "Image format is not valid!";
            exit;
        } 

        $image_name=uniqid() . '-' . basename($user_image['name']);
        $image_path=$upload_dir . $image_name;

        $db_image_name='';

        if(move_uploaded_file($user_image['tmp_name'], $image_path)){
            $db_image_name='uploads/profile_images/' . $image_name;
        }else{
            echo"Error";
            exit;
        }
    }else{
        $default_pics_dir=('../public/assets/default_pics/');
        $default_pics_files=array_diff(scandir($default_pics_dir), ['.', '..']);
        $random=$default_pics_files[array_rand($default_pics_files)];
        $db_image_name='public/assets/default_pics/' . $random;
    }

    $hashpswd=password_hash($password,PASSWORD_DEFAULT);

    $sql_user_insert=$pdo->prepare("INSERT INTO users(username, email, hashpswd, user_img) VALUES(?,?,?,?)");
    $sql_user_insert->execute([$username, $email, $hashpswd, $db_image_name]);


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