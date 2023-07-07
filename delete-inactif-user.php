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
date_default_timezone_set('Europe/Brussels');
$date = date("Y.m.d-H:i:s");


$dt = new \DateTime();
$dt->modify("-1 hours");
$lastHours = $dt->format('Y.m.d-H:i:s') ;

// Insert new message into database
$stmt = $pdo->prepare("DELETE FROM user WHERE date < :lastHours");

$stmt->bindValue(':lastHours', $lastHours);
$stmt->execute();
