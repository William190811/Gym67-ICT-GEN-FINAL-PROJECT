<?php
session_start();
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Shop the Gym67 collection — premium supplements, equipment, apparel, and accessories. Built different.">
  <title>The Collection — Gym67</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/pages/shop.css">
</head>
<body>

  <!-- ========== NAVIGATION ========== -->
  <nav class="nav scrolled" id="main-nav">
    <div class="nav__inner">
      <a href="index.php" class="nav__logo">GYM67</a>
      <ul class="nav__links">
        <li><a href="index.php" class="nav__link">Home</a></li>
        <li class="nav__dropdown">
          <a href="shop.php" class="nav__link">Shop</a>
          <div class="nav__dropdown-menu">
            <a href="shop.php?category[]=supplements" class="nav__dropdown-link">Supplements</a>
            <a href="shop.php?category[]=equipment" class="nav__dropdown-link">Equipment</a>
            <a href="shop.php?category[]=apparel" class="nav__dropdown-link">Apparel</a>
            <a href="shop.php?category[]=accessories" class="nav__dropdown-link">Accessories</a>
          </div>
        </li>
        <li><a href="reviews.php" class="nav__link">Reviews</a></li>
        <li><a href="contact.php" class="nav__link">Contact</a></li>
      </ul>
      <div class="nav__actions">
        <?php if (is_logged_in()): ?>
          <span class="nav__action-link" style="color:var(--color-ink-muted);"><?php $u = current_user(); echo htmlspecialchars($u ? $u['username'] : 'User'); ?></span>
          <a href="handlers/logout_handler.php" class="nav__action-link">Logout</a>
        <?php else: ?>
          <a href="login.php" class="nav__action-link">Login</a>
        <?php endif; ?>
      </div>
      <input type="checkbox" id="nav-toggle" class="nav__toggle" aria-label="Toggle navigation">
      <label for="nav-toggle" class="nav__hamburger" aria-label="Menu">
        <span class="nav__hamburger-line"></span>
        <span class="nav__hamburger-line"></span>
        <span class="nav__hamburger-line"></span>
      </label>
      <div class="nav__mobile-menu">
        <a href="index.php" class="nav__mobile-link">Home</a>
        <a href="shop.php" class="nav__mobile-link">Shop</a>
        <a href="reviews.php" class="nav__mobile-link">Reviews</a>
        <a href="contact.php" class="nav__mobile-link">Contact</a>

        <?php if (is_logged_in()): ?>
          <a href="#" class="nav__mobile-link" style="color:var(--color-ink-muted);">Hi, <?php $u = current_user(); echo htmlspecialchars($u ? $u['username'] : 'User'); ?></a>
          <a href="handlers/logout_handler.php" class="nav__mobile-link">Logout</a>
        <?php else: ?>
          <a href="login.php" class="nav__mobile-link">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>

  <main class="page-content">
  <?php require_once "includes/messages.php"; ?>
    <div class="container">

<?php
// ── Filter Logic ──
$selected_categories = $_GET['category'] ?? [];
$price_max = isset($_GET['price_max']) ? (int)$_GET['price_max'] : 5000000;
$sort = $_GET['sort'] ?? 'featured';

$sql = "SELECT * FROM products WHERE 1=1";
$params = [];

if (!empty($selected_categories)) {
    $placeholders = implode(',', array_fill(0, count($selected_categories), '?'));
    $sql .= " AND LOWER(category) IN ($placeholders)";
    foreach ($selected_categories as $cat) {
        $params[] = strtolower($cat);
    }
}

$sql .= " AND price <= ?";
$params[] = $price_max;

switch ($sort) {
    case 'price-low':  $sql .= " ORDER BY price ASC"; break;
    case 'price-high': $sql .= " ORDER BY price DESC"; break;
    case 'newest':     $sql .= " ORDER BY id DESC"; break;
    default:           $sql .= " ORDER BY name ASC"; break;
}

$sql .= " LIMIT 24";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $products = [];
}
$product_count = count($products);
?>

      <!-- Shop Header -->
      <div class="shop-header">
        <h1 class="shop-header__title">The Collection</h1>
        <p class="shop-header__count">Showing <?= $product_count ?> product<?= $product_count !== 1 ? 's' : '' ?></p>
      </div>

      <!-- Shop Layout: Sidebar + Grid -->
      <div class="shop-layout">

        <!-- Sidebar Filters -->
        <aside class="shop-sidebar">
          <form method="GET" action="shop.php">

            <div class="filter-section">
              <h3 class="filter-section__title">Category</h3>
              <label class="form-checkbox">
                <input type="checkbox" name="category[]" value="supplements"<?= in_array('supplements', $selected_categories) ? ' checked' : '' ?>>
                <span>Supplements</span>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="category[]" value="equipment"<?= in_array('equipment', $selected_categories) ? ' checked' : '' ?>>
                <span>Equipment</span>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="category[]" value="apparel"<?= in_array('apparel', $selected_categories) ? ' checked' : '' ?>>
                <span>Apparel</span>
              </label>
              <label class="form-checkbox">
                <input type="checkbox" name="category[]" value="accessories"<?= in_array('accessories', $selected_categories) ? ' checked' : '' ?>>
                <span>Accessories</span>
              </label>
            </div>

            <div class="filter-section">
              <h3 class="filter-section__title">Price Range</h3>
              <input type="range" name="price_max" class="filter-range" min="0" max="5000000" value="<?= $price_max ?>" step="100000" aria-label="Maximum price">
              <div class="filter-range-labels">
                <span>Rp 0</span>
                <span>Rp 5.000.000</span>
              </div>
            </div>

            <div class="filter-section">
              <h3 class="filter-section__title">Sort By</h3>
              <select name="sort" class="form-select" aria-label="Sort products">
                <option value="featured"<?= $sort === 'featured' ? ' selected' : '' ?>>Featured</option>
                <option value="price-low"<?= $sort === 'price-low' ? ' selected' : '' ?>>Price: Low — High</option>
                <option value="price-high"<?= $sort === 'price-high' ? ' selected' : '' ?>>Price: High — Low</option>
                <option value="newest"<?= $sort === 'newest' ? ' selected' : '' ?>>Newest</option>
              </select>
            </div>

            <button type="submit" class="btn btn--primary btn--full">Apply Filters</button>
          </form>
        </aside>

        <!-- Product Grid -->
        <div class="shop-grid">
          <?php if (empty($products)): ?>
            <p style="grid-column: 1/-1">No products found matching your filters.</p>
          <?php else: ?>
            <?php foreach ($products as $product): ?>
          <div class="product-card">
            <div class="product-card__image-wrap">
              <a href="product-detail.php?id=<?= urlencode($product['id']) ?>">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="product-card__image" style="width:100%;height:100%;object-fit:cover;">
              </a>
              <span class="product-card__quick-view">Quick View</span>
            </div>
            <div class="product-card__body">
              <p class="product-card__category"><?= htmlspecialchars($product['category']) ?></p>
              <h3 class="product-card__name"><a href="product-detail.php?id=<?= urlencode($product['id']) ?>"><?= htmlspecialchars($product['name']) ?></a></h3>
              <p class="product-card__price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>
              <span style="display:block;text-align:center;padding:8px;color:var(--color-ink-muted);font-size:0.85rem;">Available In-Store Only</span>
            </div>
          </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

    </div>
  </main>

  <!-- ========== FOOTER ========== -->
  <footer class="footer">
    <div class="container">
      <div class="footer__grid">
        <div class="footer__col">
          <div class="footer__brand-name">GYM67</div>
          <div class="footer__tagline">Built Different.</div>
          <p class="footer__desc">Premium fitness essentials for athletes who refuse to compromise.</p>
        </div>
        <div class="footer__col">
          <h4 class="footer__heading">Quick Links</h4>
          <a href="shop.php" class="footer__link">Shop</a>
          <a href="index.php#brand-story" class="footer__link">About</a>
          <a href="reviews.php" class="footer__link">Reviews</a>
          <a href="contact.php" class="footer__link">Contact</a>
        </div>
        <div class="footer__col">
          <h4 class="footer__heading">Categories</h4>
          <a href="shop.php?category[]=supplements" class="footer__link">Supplements</a>
          <a href="shop.php?category[]=equipment" class="footer__link">Equipment</a>
          <a href="shop.php?category[]=apparel" class="footer__link">Apparel</a>
          <a href="shop.php?category[]=accessories" class="footer__link">Accessories</a>
        </div>
        <div class="footer__col footer__newsletter">
          <h4 class="footer__heading">Stay Connected</h4>
          <p class="footer__newsletter-text">Subscribe for exclusive drops and member-only pricing.</p>
          <form class="form-inline" action="handlers/newsletter_handler.php" method="POST">
            <label for="footer-email-shop" class="visually-hidden">Email address</label>
            <input type="email" id="footer-email-shop" name="email" class="form-input" placeholder="Your email address" required>
            <button type="submit" class="btn btn--accent">Subscribe</button>
          </form>
        </div>
      </div>
      <div class="footer__bottom">
        <p class="footer__copyright">&copy; 2026 Gym67. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <script>
    window.addEventListener('scroll', function() {
      document.getElementById('main-nav').classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>

</body>
</html>
