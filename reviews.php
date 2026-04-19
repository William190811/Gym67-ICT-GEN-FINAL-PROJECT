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
  <meta name="description" content="Real results from real people. Read verified reviews from the Gym67 community and share your own experience.">
  <title>Reviews — Gym67</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/pages/reviews.css">
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

      <!-- Header -->
      <div class="reviews-header">
        <h1 class="reviews-header__title">Real Results, Real People</h1>
        <p class="reviews-header__subtitle">Verified reviews from athletes who train with Gym67 every day.</p>
      </div>

      <!-- Stats Row -->
      <div class="reviews-stats">
        <div class="reviews-stats__rating">
          <div class="reviews-stats__rating-number">4.9</div>
          <div class="stars stars--lg">★★★★★</div>
          <p class="reviews-stats__rating-label">Average Rating</p>
        </div>

        <div class="reviews-stats__bars">
          <div class="reviews-stats__bar-row">
            <span class="reviews-stats__bar-label">5 ★</span>
            <div class="reviews-stats__bar"><div class="reviews-stats__bar-fill" style="width: 82%"></div></div>
            <span class="reviews-stats__bar-count">412</span>
          </div>
          <div class="reviews-stats__bar-row">
            <span class="reviews-stats__bar-label">4 ★</span>
            <div class="reviews-stats__bar"><div class="reviews-stats__bar-fill" style="width: 12%"></div></div>
            <span class="reviews-stats__bar-count">58</span>
          </div>
          <div class="reviews-stats__bar-row">
            <span class="reviews-stats__bar-label">3 ★</span>
            <div class="reviews-stats__bar"><div class="reviews-stats__bar-fill" style="width: 4%"></div></div>
            <span class="reviews-stats__bar-count">18</span>
          </div>
          <div class="reviews-stats__bar-row">
            <span class="reviews-stats__bar-label">2 ★</span>
            <div class="reviews-stats__bar"><div class="reviews-stats__bar-fill" style="width: 1%"></div></div>
            <span class="reviews-stats__bar-count">5</span>
          </div>
          <div class="reviews-stats__bar-row">
            <span class="reviews-stats__bar-label">1 ★</span>
            <div class="reviews-stats__bar"><div class="reviews-stats__bar-fill" style="width: 1%"></div></div>
            <span class="reviews-stats__bar-count">2</span>
          </div>
        </div>

        <div class="reviews-stats__total">
          <div class="reviews-stats__total-number">495</div>
          <p class="reviews-stats__total-label">Total Reviews</p>
        </div>
      </div>

      <!-- Review Submission Form -->
      <div class="review-form">
        <h2 class="review-form__title">Write a Review</h2>
        <!-- PHP: INSERT into reviews table, associate with user if logged in -->
        <form method="POST" action="handlers/review_handler.php">
          <div class="review-form__row mb-lg">
            <div class="form-group">
              <label for="review-name" class="form-label">Name</label>
              <input type="text" id="review-name" name="name" class="form-input" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label for="review-email" class="form-label">Email</label>
              <input type="email" id="review-email" name="email" class="form-input" placeholder="you@example.com" required>
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Rating</label>
            <div class="star-selector">
              <input type="radio" name="rating" id="star5" value="5" required>
              <label for="star5">★</label>
              <input type="radio" name="rating" id="star4" value="4">
              <label for="star4">★</label>
              <input type="radio" name="rating" id="star3" value="3">
              <label for="star3">★</label>
              <input type="radio" name="rating" id="star2" value="2">
              <label for="star2">★</label>
              <input type="radio" name="rating" id="star1" value="1">
              <label for="star1">★</label>
            </div>
          </div>

          <div class="form-group">
            <label for="review-title" class="form-label">Review Title</label>
            <input type="text" id="review-title" name="review_title" class="form-input" placeholder="Summarize your experience" required>
          </div>

          <div class="form-group">
            <label for="review-body" class="form-label">Your Review</label>
            <textarea id="review-body" name="review_body" class="form-textarea" placeholder="Tell us about your experience with Gym67 products..." required></textarea>
          </div>

          <button type="submit" class="btn btn--primary btn--lg">Submit Review</button>
        </form>
      </div>

      <!-- Reviews Grid -->
      <!-- PHP: Replace this static block with DB loop -->
      <div class="reviews-grid">
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM reviews ORDER BY created_at DESC LIMIT 10");
            $reviews_found = false;
            while ($rev = $stmt->fetch()) {
                $reviews_found = true;
                $stars = str_repeat('★', $rev['rating']) . str_repeat('☆', 5 - $rev['rating']);
        ?>
        <div class="review-card">
          <div class="review-card__header">
            <span class="review-card__author"><?= htmlspecialchars($rev['reviewer_name']) ?></span>
            <span class="review-card__date"><?= date('F j, Y', strtotime($rev['created_at'])) ?></span>
          </div>
          <div class="review-card__stars stars"><?= $stars ?></div>
          <h3 class="review-card__title"><?= htmlspecialchars($rev['title']) ?></h3>
          <p class="review-card__body"><?= htmlspecialchars($rev['body']) ?></p>
          <span class="review-card__badge">✓ Verified Review</span>
        </div>
        <?php
            }
            if (!$reviews_found) {
                echo "<p style='grid-column: 1/-1'>No reviews yet. Be the first to leave a review!</p>";
            }
        } catch (PDOException $e) {
            echo "<p style='grid-column: 1/-1'>Could not load reviews.</p>";
        }
        ?>
      </div>

      <!-- Load More -->
      <div class="reviews-load-more">
        <!-- PHP: Pagination or AJAX load more to be implemented -->
        <button type="button" class="btn btn--outline btn--lg">Load More Reviews</button>
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
            <label for="footer-email-reviews" class="visually-hidden">Email address</label>
            <input type="email" id="footer-email-reviews" name="email" class="form-input" placeholder="Your email address" required>
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
