<?php
// handlers/newsletter_handler.php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if (empty($email)) {
        $_SESSION['error'] = 'Please enter a valid email address.';
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? "../index.php"));
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT IGNORE INTO newsletter_subscribers (email) VALUES (?)");
        $stmt->execute([$email]);
        
        $_SESSION['success'] = 'You have successfully subscribed to the Gym67 Circle!';
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? "../index.php"));
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header("Location: " . ($_SERVER['HTTP_REFERER'] ?? "../index.php"));
        exit;
    }
} else {
    header("Location: " . ($_SERVER['HTTP_REFERER'] ?? "../index.php"));
    exit;
}
