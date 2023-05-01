<?php
session_start();
if (isset($_GET['token'])) {
    $dsn = 'mysql:host=localhost;dbname=chatgpt;port=3307;charset=utf8mb4';
    $username = 'root';
    $password = '';

    try {
        $pdo = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }

// Get the message from the request body
    $token = $_GET['token'];
// Insert new message into database
    $stmt = $pdo->prepare("SELECT * FROM user WHERE token = :token");
    $stmt->bindValue(':token', $token);
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