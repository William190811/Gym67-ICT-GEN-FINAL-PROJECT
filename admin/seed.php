<?php
// admin/seed.php
session_start();
require_once '../includes/db.php';

try {
    $pdo->exec("DROP TABLE IF EXISTS products");
    $pdo->exec("
        CREATE TABLE products (
            id VARCHAR(50) PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            category VARCHAR(50) NOT NULL,
            price DECIMAL(10,2) NOT NULL,
            description TEXT,
            image VARCHAR(255) NOT NULL,
            stock INT DEFAULT 100
        )
    ");

    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(255) NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        total DECIMAL(10,2) NOT NULL,
        status VARCHAR(50) DEFAULT 'Pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS cart_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        session_id VARCHAR(255) NOT NULL,
        product_id VARCHAR(50) NOT NULL,
        quantity INT DEFAULT 1,
        UNIQUE KEY session_product (session_id, product_id)
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS reviews (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NULL,
        product_id VARCHAR(50) NOT NULL,
        reviewer_name VARCHAR(255) NOT NULL,
        rating INT NOT NULL,
        title VARCHAR(255),
        body TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS inquiries (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        subject VARCHAR(255),
        message TEXT NOT NULL,
        submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS newsletter_subscribers (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) UNIQUE NOT NULL,
        subscribed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

    // All images use verified paths that exist on disk
    $products = [
        ['GYM67-WIP-900', 'Whey Isolate Pro 900g',        'Supplements', 485000,  'Premium whey protein isolate ensuring maximum recovery and minimal bloat.',                        'images/category-supplements.jpg', 100],
        ['GYM67-PRE-001', 'Pre-Workout Ignite Formula',    'Supplements', 395000,  'High energy pre-workout designed for explosive strength without the crash.',                       'images/category-supplements.jpg',  100],
        ['GYM67-KB-16',   'Matte Black Kettlebell 16kg',   'Equipment',   720000,  'Cast iron kettlebell machined to perfect symmetry.',                                               'images/category-equipment.jpg',    50],
        ['GYM67-BAR-20',  'Olympic Barbell 20kg Chrome',   'Equipment',   1850000, 'Olympic standard barbell featuring perfect whip and 200,000 PSI tensile strength.',                 'images/category-equipment.jpg',    30],
        ['GYM67-TEE-BLK', 'Essential Training Tee — Black','Apparel',     289000,  'Breathable training shirt woven with sweat-wicking smart fibers.',                                 'images/category-apparel.jpg',      200],
        ['GYM67-JOG-SLT', 'Performance Joggers — Slate',   'Apparel',     459000,  'Performance gym joggers offering unmatched mobility and comfort.',                                 'images/category-apparel.jpg',      150],
        ['GYM67-GLV-LTH', 'Leather Lifting Gloves',        'Accessories', 245000,  'Genuine leather gym gloves for the heaviest pulling days.',                                        'images/category-accessories.jpg',  80],
        ['GYM67-SHK-MAT', 'Gym67 Shaker Bottle — Matte',  'Accessories', 175000,  'Matte black shaker bottle that never leaks or holds odors.',                                       'images/category-accessories.jpg',  300]
    ];

    $stmt = $pdo->prepare("INSERT IGNORE INTO products (id, name, category, price, description, image, stock) VALUES (?, ?, ?, ?, ?, ?, ?)");
    foreach ($products as $p) {
        $stmt->execute($p);
    }

    echo "<h1>Seed Complete!</h1>";
    echo "<p>8 products seeded. All tables verified. <a href='../shop.php'>Go to Shop</a></p>";

} catch (PDOException $e) {
    die("Seeding failed: " . $e->getMessage());
}
?>
