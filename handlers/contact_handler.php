<?php
// handlers/contact_handler.php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['error'] = 'Name, email, and message are required.';
        header("Location: ../contact.php");
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        
        $_SESSION['success'] = 'Thank you for your message. We deal with athletes swiftly.';
        header("Location: ../contact.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header("Location: ../contact.php");
        exit;
    }
} else {
    header("Location: ../contact.php");
    exit;
}
