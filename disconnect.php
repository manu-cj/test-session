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
$token = $data['token'];



// Insert new message into database
$stmt = $pdo->prepare("DELETE FROM user WHERE token = :token");

$stmt->bindValue(':token', $token);
if ($stmt->execute()) {
    echo json_encode('disconnected');
}

