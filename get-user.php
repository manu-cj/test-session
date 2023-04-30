<?php
session_start();
if (isset($_GET['username'])) {
    $dsn = 'mysql:host=localhost;dbname=chatgpt;port=3307;charset=utf8mb4';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

// Get the message from the request body
    $user = $_GET['username'];
// Insert new message into database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username = :username");
    $stmt->bindValue(':username', $user);
    if ($stmt->execute()) {
        $datas = $stmt->fetchAll();
        foreach ($datas as $data) {
                echo  json_encode([
                    $data
                ]);


        }


    }

}


?>