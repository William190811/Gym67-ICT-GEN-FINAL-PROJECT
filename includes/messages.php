<?php
// includes/messages.php

if (isset($_SESSION['error']) || isset($_SESSION['success'])) {
    echo '<div class="container" style="margin-top: 2rem; margin-bottom: -1rem;">';
    
    if (isset($_SESSION['error'])) {
        echo '<div style="background-color: #fde8e8; border: 1px solid #f98080; color: #c81e1e; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">';
        echo htmlspecialchars($_SESSION['error']);
        echo '</div>';
        unset($_SESSION['error']);
    }
    
    if (isset($_SESSION['success'])) {
        echo '<div style="background-color: #def7ec; border: 1px solid #31c48d; color: #046c4e; padding: 1rem; border-radius: 4px; margin-bottom: 1rem;">';
        echo htmlspecialchars($_SESSION['success']);
        echo '</div>';
        unset($_SESSION['success']);
    }
    
    echo '</div>';
}
?>
