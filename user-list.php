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

// Insert new message into database
$stmt = $pdo->prepare("SELECT username, color FROM user WHERE etat = 1");
if ($stmt->execute()) {
    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
    echo json_encode($stmt->fetchAll());
}
