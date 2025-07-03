<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require 'connect.php';
$pdo=connect_db();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/templates/user_login_page.php"); 
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $title=trim($_POST['title']);
    $desc=trim($_POST['game_desc']);
    $genre=trim($_POST['genre']);
    $cover=$_FILES['cover'];
    $game_file=$_FILES['game_file'];

    $user_id=$_SESSION['user_id'];

    if(empty($title) || empty($genre)){
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    $cover_dir=__DIR__ . '/../uploads/cover_games/';
    $game_dir=__DIR__ . '/../uploads/games/';

    $max_size=2 * 1024 * 1024;

    if($cover['size']>$max_size){
        http_response_code(400);
        echo json_encode(['error' => 'Arquivo excede o tamanho máximo permitido (2MB).']);
        exit; 
    }
    
    if(!empty($cover)&&$cover['error']===UPLOAD_ERR_OK){
        $allowed_types=['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if(!in_array($cover['type'], $allowed_types)){
            echo "Image format dont valid";
            exit;
        }

        $cover_name=uniqid() . '-' . basename($cover['name']);
        $cover_path=$cover_dir . $cover_name;

        if(move_uploaded_file($cover['tmp_name'], $cover_path)){
            $cover_db_path = '../uploads/cover_games/' . $cover_name;
        }else{
            echo "Error cover";
            exit;
        }
    }else{
        $cover_db_path = null;
    }

    if($game_file['error']===UPLOAD_ERR_OK){
        $game_name = uniqid() . '-' . basename($game_file['name']);
        $game_path = $game_dir . $game_name;

        if (move_uploaded_file($game_file['tmp_name'], $game_path)) {
            $game_db_path = '../uploads/games/' . $game_name;   
        }else{
            echo"Error game";
            exit;
        }
    }

    $stmt=$pdo->prepare("INSERT INTO games(title, game_desc, genre, cover, game_file, posted_by) VALUES(?,?,?,?,?,?)");
    $stmt->execute([$title, $desc, $genre, $cover_db_path, $game_db_path, $user_id]);

    header("Location: ../public/templates/games_page.php");
    exit;
}
?>