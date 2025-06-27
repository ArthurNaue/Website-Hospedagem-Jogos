<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Users</title>
  <link rel="stylesheet" href="../public/css/index.css">
</head>
<body style="background-color: #e6ceac;">
  <a href="../index.php"><button>Back</button></a>
</body>
</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'connect.php';
$pdo=connect_db();

try {
    $stmt=$pdo->query("SELECT * FROM users");
    $users=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($users)>0) {
        echo "<h2>Users List:</h2>";
        foreach($users as $user) {
            echo "<li>ID: " . htmlspecialchars($user['user_id']);
            echo "<li>Username: " . htmlspecialchars($user['username']);
            echo "<li>Email: " . htmlspecialchars($user['email']);
            echo "<li> <img src='" . htmlspecialchars($user['user_img']) . "' alt='User Image' style='max-width:100px; max-height:100px;'>";
            echo "<li>";
        }
    }

} catch(PDOException $msg) {
    echo "Error to find user: " . $msg->getMessage();
}
?>