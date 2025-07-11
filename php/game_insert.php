<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(session_status()!==PHP_SESSION_ACTIVE){//Check if the connection is starded.
    session_start();
}

require 'connect.php';
$pdo=connect_db();

if(!isset($_SESSION['user_id'])){//Check if don't have some profile loged in site.
    header("Location: ../templates/user_login_page.php");//Send to login page to user insert your informations.
    exit;
}

if($_SERVER['REQUEST_METHOD']==='POST'){
    $title=trim($_POST['title']);//trim remove init and final spaces of sting.
    $desc=trim($_POST['game_desc']);
    $genre=trim($_POST['genre']);
    $cover=$_FILES['cover'];
    $game_file=$_FILES['game_file'];

    $user_id=$_SESSION['user_id'];//Get user id loged in the site session.

    if(empty($title)||empty($genre)){//Check if this two values is empty.
        echo "<script>alert('All the fields is mandatory!');</script>";
        exit;
    }

    $cover_dir=__DIR__ . '/../uploads/cover_games/';//Make this directory as absolute.
    $game_dir=__DIR__ . '/../uploads/games/';//Make this directory as asolute too.

    if(!is_dir($cover_dir)){
        mkdir($cover_dir, 0755, true);
    }

    if(!is_dir($game_dir)){
        mkdir($game_dir, 0755, true);
    }

    $max_size=5* 1024 * 1024;//Setting max MB size to check if sent cover is bigger of 2MB, to avoid pentests with images.

    if($cover['size']>$max_size){//Check if sent cover is bigger of 2MB.
        http_response_code(400);
        echo json_encode(['error' => 'File exceeds maximum allowed size(2MB).']);
        exit; 
    }
    
    if(!empty($cover)&&$cover['error']===UPLOAD_ERR_OK){//If image as sent and don't have any error.
        $allowed_types=['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];//Defining images type.
        if(!in_array($cover['type'], $allowed_types)){//If the sent image is not in array.
            echo "Image format dont valid";
            exit;
        }

        $cover_name=uniqid() . '-' . basename($cover['name']);//Concatenating unique time value(uniqid) with cover name.
        $cover_path=$cover_dir . $cover_name;//Concatenating absolute directory with cover_name.

        if(move_uploaded_file($cover['tmp_name'], $cover_path)){//If moved is ok.
            $cover_db_path = 'uploads/cover_games/' . $cover_name;//Path name that goes to database.
        }else{
            echo "Error cover";
            exit;
        }
    }else{
        $cover_db_path = null;
    }

    if($game_file['error']===UPLOAD_ERR_OK){
        $game_name = uniqid() . '-' . basename($game_file['name']);//Setting unique name to game.
        $game_path = $game_dir . $game_name;

        if(move_uploaded_file($game_file['tmp_name'], $game_path)){//If moved is ok.
            $game_db_path = 'uploads/games/' . $game_name;//Setting path that goes to database.
        }else{
            echo"Error game";
            exit;
        }
    }

    $stmt=$pdo->prepare("INSERT INTO games(title, game_desc, genre, cover, game_file, posted_by) VALUES(?,?,?,?,?,?)");//Setting a prepare to avoid sql injection in game database posting.
    $stmt->execute([$title, $desc, $genre, $cover_db_path, $game_db_path, $user_id]);//Insert this variables values.

    header("Location: ../templates/games_page.php");//Send loged user to games page after insert game.
    exit;
}
    header("Location: ../templates/games_page.php?game_insert=error");
    exit;
?>