<?php
session_start();
require_once __DIR__ . "/includes/db.php";
require_once __DIR__ . "/includes/auth.php";

$product_id = $_GET['id'] ?? 'GYM67-WIP-900';
try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
    if (!$product) {
        header("Location: shop.php");
        exit;
    }
} catch (PDOException $e) {
    die("Error loading product.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="<?= htmlspecialchars($product['name']) ?> — Premium lab-tested whey protein isolate by Gym67. Clean ingredients, exceptional taste.">
  <title><?= htmlspecialchars($product['name']) ?> — Gym67</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/pages/product-detail.css">
  <!-- PHP_READY: rename this file to .php to activate server-side logic -->
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
            <a href="shop.php" class="nav__dropdown-link">Supplements</a>
            <a href="shop.php" class="nav__dropdown-link">Equipment</a>
            <a href="shop.php" class="nav__dropdown-link">Apparel</a>
            <a href="shop.php" class="nav__dropdown-link">Accessories</a>
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

      <!-- Breadcrumb -->
      <nav class="breadcrumb" aria-label="Breadcrumb">
        <a href="index.php">Home</a>
        <span class="breadcrumb__sep">›</span>
        <a href="shop.php">Shop</a>
        <span class="breadcrumb__sep">›</span>
        <a href="shop.php"><?= htmlspecialchars($product["category"]) ?></a>
        <span class="breadcrumb__sep">›</span>
        <span class="breadcrumb__current"><?= htmlspecialchars($product['name']) ?></span>
      </nav>

      <!-- Product Detail Layout -->
      <div class="product-detail">



        <!-- Product Info -->
        <div class="product-info">
          <p class="product-info__category"><?= htmlspecialchars($product["category"]) ?></p>
          <h1 class="product-info__name"><?= htmlspecialchars($product['name']) ?></h1>

          <div class="product-info__rating">
            <span class="stars">★★★★★</span>
            <span class="product-info__review-count">(127 reviews)</span>
          </div>

          <p class="product-info__price">Rp <?= number_format($product['price'], 0, ',', '.') ?></p>

          <p class="product-info__desc"><?= htmlspecialchars($product["description"]) ?></p>

          <?php if (strtolower($product['category']) === 'supplements'): ?>
          <!-- Variant: Flavor -->
          <div class="product-info__variants">
            <p class="product-info__section-label">Flavor</p>
            <div class="pill-group">
              <input type="radio" name="flavor" id="flavor-vanilla" class="pill-input" value="vanilla" checked>
              <label for="flavor-vanilla" class="pill-label">Vanilla Bean</label>
              <input type="radio" name="flavor" id="flavor-chocolate" class="pill-input" value="chocolate">
              <label for="flavor-chocolate" class="pill-label">Dark Chocolate</label>
              <input type="radio" name="flavor" id="flavor-matcha" class="pill-input" value="matcha">
              <label for="flavor-matcha" class="pill-label">Matcha</label>
              <input type="radio" name="flavor" id="flavor-unflavored" class="pill-input" value="unflavored">
              <label for="flavor-unflavored" class="pill-label">Unflavored</label>
            </div>
          </div>
          <?php endif; ?>

          <!-- Add to Cart Form -->
          <!-- Available In-Store Only -->
            <span style="display:block;text-align:center;padding:12px;color:var(--color-ink-muted);font-size:0.95rem;border:1px solid var(--color-ink-muted);border-radius:4px;">Available In-Store Only</span>

          <button type="button" class="product-info__wishlist">♡ Add to Wishlist</button>
        </div>
      </div>

      <!-- Product Tabs (CSS-only) -->
      <div class="product-tabs">
        <div class="tabs">
          <input type="radio" name="product-tab" id="tab1" class="tabs__input" checked>
          <?php if (strtolower($product['category']) === 'supplements'): ?>
            <input type="radio" name="product-tab" id="tab2" class="tabs__input">
          <?php endif; ?>

          <div class="tabs__nav">
            <label for="tab1" class="tabs__label">Description</label>
            <?php if (strtolower($product['category']) === 'supplements'): ?>
              <label for="tab2" class="tabs__label">Ingredients</label>
            <?php endif; ?>
          </div>

          <div class="tabs__panels">
            <div class="tabs__panel">
              <h3 class="text-subheading mb-md">Product Description</h3>
              <p class="text-body text-muted mb-lg"><?= htmlspecialchars($product["description"]) ?></p>
              <?php if (strtolower($product['category']) === 'supplements'): ?>
                <p class="text-body text-muted mb-lg">Unlike conventional whey, our isolate process removes nearly all lactose, fat, and fillers, making it exceptionally easy to digest. We use no artificial colors, no soy lecithin, and no amino spiking — just pure, clean protein.</p>
                <p class="text-body text-muted">Third-party lab tested and Informed Sport certified for banned substance-free assurance. Every container features a QR code linking to the specific batch certificate of analysis.</p>
              <?php endif; ?>
            </div>
            
            <?php if (strtolower($product['category']) === 'supplements'): ?>
            <div class="tabs__panel">
              <h3 class="text-subheading mb-md">Nutritional Information</h3>
              <p class="text-body text-muted mb-md"><strong>Serving Size:</strong> 30g (1 scoop)</p>
              <p class="text-body text-muted mb-md"><strong>Protein:</strong> 27g</p>
              <p class="text-body text-muted mb-md"><strong>Calories:</strong> 110</p>
              <p class="text-body text-muted mb-md"><strong>Fat:</strong> 0.5g</p>
              <p class="text-body text-muted mb-md"><strong>Carbohydrates:</strong> 1g</p>
              <p class="text-body text-muted mb-md"><strong>Sugar:</strong> &lt; 1g</p>
              <p class="text-body text-muted mb-lg"><strong>Sodium:</strong> 90mg</p>
              <p class="text-body text-muted"><strong>Ingredients:</strong> Whey protein isolate (milk), natural flavoring, sunflower lecithin, stevia leaf extract, salt.</p>
            </div>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- Related Products -->
      <div class="related-products">
        <h2 class="section-heading">You May Also Like</h2>
        <div class="related-products__grid">
          <?php
          try {
              $rel = $pdo->prepare("SELECT * FROM products WHERE id != ? ORDER BY RAND() LIMIT 4");
              $rel->execute([$product['id']]);
              while ($rp = $rel->fetch()):
          ?>
          <div class="product-card">
            <div class="product-card__image-wrap">
              <a href="product-detail.php?id=<?= urlencode($rp['id']) ?>">
                <img src="<?= htmlspecialchars($rp['image']) ?>" alt="<?= htmlspecialchars($rp['name']) ?>" class="product-card__image" style="width:100%;height:100%;object-fit:cover;">
              </a>
            </div>
            <div class="product-card__body">
              <p class="product-card__category"><?= htmlspecialchars($rp['category']) ?></p>
              <h3 class="product-card__name"><a href="product-detail.php?id=<?= urlencode($rp['id']) ?>"><?= htmlspecialchars($rp['name']) ?></a></h3>
              <p class="product-card__price">Rp <?= number_format($rp['price'], 0, ',', '.') ?></p>
            </div>
          </div>
          <?php
              endwhile;
          } catch (PDOException $e) {
              // silently fail
          }
          ?>
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
          <a href="shop.php" class="footer__link">Supplements</a>
          <a href="shop.php" class="footer__link">Equipment</a>
          <a href="shop.php" class="footer__link">Apparel</a>
          <a href="shop.php" class="footer__link">Accessories</a>
        </div>
        <div class="footer__col footer__newsletter">
          <h4 class="footer__heading">Stay Connected</h4>
          <p class="footer__newsletter-text">Subscribe for exclusive drops and member-only pricing.</p>
          <form class="form-inline" action="handlers/newsletter_handler.php" method="POST">
            <label for="footer-email-pd" class="visually-hidden">Email address</label>
            <input type="email" id="footer-email-pd" name="email" class="form-input" placeholder="Your email address" required>
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
