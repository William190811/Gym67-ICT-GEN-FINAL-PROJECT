<?php
// includes/auth.php

/**
 * Checks if the current user is logged in
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Redirects to login page if user is not authenticated
 */
function require_login() {
    if (!is_logged_in()) {
        $_SESSION['error'] = "You must be logged in to view that page.";
        header("Location: ../login.php");
        exit;
    }
}

/**
 * Returns the current user's array safely using a mock or DB lookup
 */
function current_user() {
    global $pdo;
    
    if (!is_logged_in()) {
        return null;
    }

    $user_id = $_SESSION['user_id'];
    
    return [
        'id' => $user_id,
        'username' => $_SESSION['username'] ?? 'User',
        'email' => 'user@example.com'
    ];
}
