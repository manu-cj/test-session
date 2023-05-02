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
$date = date("Y.m.d");
$hours = date("H:i:s");

$dt = new \DateTime();
$dt->modify("-3 hours");
$lastHours = $dt->format('H:i:s') ;

// Insert new message into database
$stmt = $pdo->prepare("SELECT * FROM messages WHERE date = :date AND hours between :lastHours AND :hours order by hours desc");
$stmt->bindValue(':date', $date);
$stmt->bindValue(':hours', $hours);
$stmt->bindValue(':lastHours', $lastHours);
if ($stmt->execute()) {
    $stmt->setFetchMode(\PDO::FETCH_ASSOC);
    echo json_encode($stmt->fetchAll());
}
