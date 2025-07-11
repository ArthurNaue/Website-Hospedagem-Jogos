<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION)){
    session_start();
}

require 'connect.php';
$pdo=connect_db();

if(!isset($_SESSION['user_id'])){
    echo "You must be logged in to update a game.";
    exit;
}

$user_id=$_SESSION['user_id'];//Stores user id to futures checks.

if(isset($_POST['game_update'])){
    $game_id=intval($_POST['game_id']);//Catch the game_id value to future checks.

    $stmt=$pdo->prepare("SELECT * FROM games WHERE game_id = ?");
    $stmt->execute([$game_id]);
    $game=$stmt->fetch(PDO::FETCH_ASSOC);//Stores sql select results.

    if(!$game||$game['posted_by']!==$user_id){//Check if user loged is the owner of the game.
        echo "You are not authorized to update this game.";
        exit;
    }

    //New values to updated.
    $new_title=trim($_POST['title']);
    $new_desc=trim($_POST['game_desc']);
    $new_genre=trim($_POST['genre']);
    $new_cover=$_FILES['cover'];

    //Original values in empty values or error cases.
    $title=$game['title'];
    $desc=$game['game_desc'];
    $genre=$game['genre'];
    $cover=ltrim(str_replace('../', '', $game['cover']), '/');

    //Check if some new value is empty, to return to the original value.
    if(!empty($new_title)){
       $title=$new_title;
    } 
    if(!empty($new_desc)){
        $desc=$new_desc;
    } 
    if(!empty($new_genre)){
        $genre=$new_genre;
    } 

    $upload_dir=__DIR__ . '/../uploads/cover_games/';//Setting the absolute directory.

    $max_size=5*1024*1024;

    if($new_cover['size']>$max_size){
        http_response_code(400);
        echo json_encode(['error'=>'File is greater than: 2MB']);
        exit;
    }

    //Same insert logic, but with new values.
    if(!empty($new_cover)&&$new_cover['error']===UPLOAD_ERR_OK){
        $allowed_types=['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if(!in_array($new_cover['type'], $allowed_types)){
            echo "Invalid image format!";
            exit;
        }

        $cover_name=uniqid() . '-' . basename($new_cover['name']);
        $cover_path=$upload_dir . $cover_name;

        if(move_uploaded_file($new_cover['tmp_name'], $cover_path)){
            $cover='uploads/cover_games/' . $cover_name;
        }else{
            echo "Failed to upload image.";
            exit;
        }
    }

    $stmt=$pdo->prepare("UPDATE games SET title=?, game_desc=?, genre=?, cover=? WHERE game_id=?");
    $stmt->execute([$title,$desc,$genre,$cover,$game_id]);

    header("Location: ../templates/game.php?game_id=$game_id");
    exit;
} else {
    echo "Invalid request.";
}