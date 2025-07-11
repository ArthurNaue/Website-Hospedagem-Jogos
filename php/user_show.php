<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>All Users</title>
  <link rel="stylesheet" href="../public/css/index.css">
</head>
<body style="background-color: #e6ceac;">
  <button onclick="window.history.back()">Back</button></a>
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
            echo "<li><img src='uploads/" . htmlspecialchars($user['user_img']) . "' alt='User Image' style='max-width:100px; max-height:100px;'>";
            echo "<br>";
            echo "<form action='user_delete.php' method='POST' style='display:inline-block; margin-top: 10px;' onsubmit='return confirm(\"Tem certeza que deseja remover este usuário?\");'>";
            echo "<input type='hidden' name='user_id' value='" . htmlspecialchars($user['user_id']) . "'>";
            echo "<button type='submit'>Remover</button>";
            echo "</form>";
            echo "<br>";
        }
    }

} catch(PDOException $msg) {
    echo "Error to find user: " . $msg->getMessage();
}
?>