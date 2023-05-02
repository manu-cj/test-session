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
$message = $data['message'];
$color = $data['color'];
$token = $data['token'];
date_default_timezone_set('Europe/Brussels');
$date = date("Y.m.d");
$hours = date("H:i:s");


// Insert new message into database
$select = $pdo->prepare('SELECT username FROM user WHERE token = :token');
$select->bindValue(':token', $token);
if ($select->execute()){
    $stmt = $pdo->prepare("INSERT INTO messages (text, color, username, date, hours) VALUES (:text, :color, 
                                                                  :username, :date, :hours)");
    $datasUser = $select->fetchAll();
    foreach ($datasUser as $dataUser) {
        $stmt->bindValue(':text', $message);
        $stmt->bindValue(':color', $color);
        $stmt->bindValue(':username', $dataUser['username']);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':hours', $hours);

        if ($stmt->execute()) {
            echo json_encode(true);

        }
    }

}

