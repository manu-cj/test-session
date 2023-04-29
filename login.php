<?php

$dsn = 'mysql:host=localhost;dbname=chatgpt;port=3307;charset=utf8mb4';
$username = 'root';
$password = '';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die('Connection failed: ' . $e->getMessage());
}

// Get the message from the request body
$data = json_decode(file_get_contents('php://input'), true);
$username = $data['username'];

// Insert new message into database
$stmt = $pdo->prepare("INSERT INTO user (username) value (:username)");
$stmt->bindValue(':username', $username);
if ($stmt->execute()) {
    echo $username;
}

