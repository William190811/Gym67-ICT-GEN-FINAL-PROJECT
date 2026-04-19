<?php
// handlers/review_handler.php
session_start();
require_once '../includes/db.php';
require_once '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? ''); 
    $review_title = trim($_POST['review_title'] ?? '');
    $review_body = trim($_POST['review_body'] ?? '');
    $rating = (int)($_POST['rating'] ?? 5);
    $product_id = $_POST['product_id'] ?? 'GYM67-WIP-900'; // Defaulting for the mockup unless specified

    if (empty($name) || empty($review_title) || empty($review_body)) {
        $_SESSION['error'] = 'Name, title, and review body are required.';
        header("Location: ../reviews.php");
        exit;
    }

    try {
        $user_id = is_logged_in() ? current_user()['id'] : null;
        
        $stmt = $pdo->prepare("INSERT INTO reviews (user_id, product_id, reviewer_name, rating, title, body) VALUES (?, ?, ?, ?, ?, ?)");
        
        $stmt->execute([$user_id, $product_id, $name, $rating, $review_title, $review_body]);
        
        $_SESSION['success'] = 'Your review has been submitted.';
        header("Location: ../reviews.php");
        exit;
    } catch (PDOException $e) {
        $_SESSION['error'] = 'Database error: ' . $e->getMessage();
        header("Location: ../reviews.php");
        exit;
    }
} else {
    header("Location: ../reviews.php");
    exit;
}
