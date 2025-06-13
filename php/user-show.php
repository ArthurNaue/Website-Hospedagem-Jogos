<?php
include 'connect.php';
$pdo=connect_db();

try {
    $stmt=$pdo->query("SELECT user_id, username, email FROM users");
    $users=$stmt->fetchAll(PDO::FETCH_ASSOC);

    if(count($users)>0) {
        echo "<h2>Users List:</h2><ul>";
        foreach($users as $user) {
            echo "<li>";
            echo "ID: " . htmlspecialchars($user['user_id']) . " | ";
            echo "Username: " . htmlspecialchars($user['username']) . " | ";
            echo "Email: " . htmlspecialchars($user['email']);
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No user found!";
    }
} catch(PDOException $e) {
    echo "Error to find user: " . $e->getMessage();
}
?>