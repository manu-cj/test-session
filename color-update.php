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
$color = $data['color'];
$token = $data['token'];

// Insert new message into database
$stmt = $pdo->prepare("UPDATE user SET color = :color WHERE token = :token");

$stmt->bindValue(':token', $token);
$stmt->bindValue(':color', $color);
if ($stmt->execute()) {
    echo 'couleur changé';
}