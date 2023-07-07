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
date_default_timezone_set('Europe/Brussels');
$date = date("Y.m.d-H:i:s");


// Insert new message into database
$stmt = $pdo->prepare("UPDATE user set date = :date WHERE token = :token");
$stmt->bindValue(':token', $token);
$stmt->bindValue(':date', $date);
$stmt->execute();



