<?php
session_start();

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
$color = $data['color'];
$token = base_convert(hash('sha256', time() . mt_rand()), 16, 36);

// Insert new message into database
$stmt = $pdo->prepare("INSERT INTO user (username, etat, token, color) value (:username, :etat, :token, :color)");
$stmt->bindValue(':username', $username);
$stmt->bindValue(':etat', 1);
$stmt->bindValue(':token', $token);
$stmt->bindValue(':color', $color);
if ($stmt->execute()) {
    $select = $pdo->prepare('SELECT * FROM user where username = :username');
    $select->bindValue(':username', $username);
    if ($select->execute()) {
        $datas = $select->fetchAll();
        foreach ($datas as $data) {
            echo json_encode([
                'username'=> $username,
                'token' => $data['token'],
            ]);
        }
    }
}

