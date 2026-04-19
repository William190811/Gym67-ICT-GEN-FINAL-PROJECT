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
  <meta name="description" content="Gym67 — Premium fitness supplements, equipment, apparel, and accessories. Performance, refined. Built different.">
  <title>Gym67 — Performance, Refined.</title>
  <!-- Bootstrap 5.3 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/pages/home.css">
  <link rel="stylesheet" href="css/bootstrap-overrides.css">
  <!-- PHP_READY: rename this file to .php to activate server-side logic -->
</head>
<body>

  <!-- ========== NAVIGATION ========== -->
  <nav class="nav scrolled" id="main-nav">
    <div class="nav__inner">
      <a href="index.php" class="nav__logo">GYM67</a>

      <!-- Desktop Navigation -->
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

      <!-- Right Actions -->
      <div class="nav__actions">
        <?php if (is_logged_in()): ?>
          <span class="nav__action-link" style="color:var(--color-ink-muted);"><?php $u = current_user(); echo htmlspecialchars($u ? $u['username'] : 'User'); ?></span>
          <a href="handlers/logout_handler.php" class="nav__action-link">Logout</a>
        <?php else: ?>
          <a href="login.php" class="nav__action-link">Login</a>
        <?php endif; ?>
      </div>

      <!-- Mobile Hamburger -->
      <input type="checkbox" id="nav-toggle" class="nav__toggle" aria-label="Toggle navigation">
      <label for="nav-toggle" class="nav__hamburger" aria-label="Menu">
        <span class="nav__hamburger-line"></span>
        <span class="nav__hamburger-line"></span>
        <span class="nav__hamburger-line"></span>
      </label>

      <!-- Mobile Overlay Menu -->
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

    <!-- ========== SECTION 1: HERO ========== -->
    <section class="hero" id="hero">
      <div class="hero__content">
        <h1 class="hero__headline">Performance,<br>Refined.</h1>
        <p class="hero__subtext">Premium fitness essentials designed for those who refuse to compromise. Every product crafted with intention, every detail refined for the pursuit of excellence.</p>
        <div class="hero__ctas">
          <a href="shop.php" class="btn btn--primary btn--lg">Shop Now</a>
          <a href="#brand-story" class="btn btn--secondary btn--lg">Our Story</a>
        </div>
      </div>
      <div class="hero__image-wrap">
        <img src="images/hero-main.jpg" alt="Athlete training in minimalist gym with dramatic lighting" class="hero__image">
      </div>
    </section>

    <!-- ========== SECTION 2: ANNOUNCEMENT BAR ========== -->
    <div class="announcement-bar" id="announcement">
      <p class="announcement-bar__text">Free shipping on orders above Rp500.000 — Use code <strong>GYM67LAUNCH</strong></p>
    </div>

    <!-- ========== SECTION 3: CATEGORY TILES ========== -->
    <section class="categories section" id="categories">
      <div class="container">
        <h2 class="section-heading section-heading--center">Shop by Category</h2>
        <div class="categories__grid">
          <a href="shop.php" class="category-card">
            <img src="images/category-supplements.jpg" alt="Premium fitness supplements" class="category-card__image">
            <div class="category-card__overlay">
              <span class="category-card__name">Supplements</span>
            </div>
          </a>
          <a href="shop.php" class="category-card">
            <img src="images/category-equipment.jpg" alt="Premium gym equipment" class="category-card__image">
            <div class="category-card__overlay">
              <span class="category-card__name">Equipment</span>
            </div>
          </a>
          <a href="shop.php" class="category-card">
            <img src="images/category-apparel.jpg" alt="Premium athletic apparel" class="category-card__image">
            <div class="category-card__overlay">
              <span class="category-card__name">Apparel</span>
            </div>
          </a>
          <a href="shop.php" class="category-card">
            <img src="images/category-accessories.jpg" alt="Premium fitness accessories" class="category-card__image">
            <div class="category-card__overlay">
              <span class="category-card__name">Accessories</span>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- ========== SECTION 4: FEATURED PRODUCTS ========== -->
    <section class="featured-products section" id="featured">
      <div class="container">
        <h2 class="section-heading">Best Sellers</h2>
        <div class="featured-products__grid">
          <?php
          try {
              $stmt = $pdo->query("SELECT * FROM products LIMIT 8");
              while ($product = $stmt->fetch()):
          ?>
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
              <span class="product-card__btn" style="display:block;text-align:center;padding:8px;color:var(--color-ink-muted);font-size:0.85rem;">Available In-Store Only</span>
            </div>
          </div>
          <?php 
              endwhile;
          } catch (PDOException $e) {
              echo "<p>Error loading products.</p>";
          }
          ?>
        </div>
      </div>
    </section>

    <!-- ========== SECTION 5: BRAND STORY ========== -->
    <section class="brand-story section--flush" id="brand-story">
      <div class="brand-story__image-wrap">
        <img src="images/brand-story.jpg" alt="Gym67 athlete training in a premium gym space" class="brand-story__image">
      </div>
      <div class="brand-story__content">
        <h2 class="brand-story__heading">Why Gym67?</h2>
        <p class="brand-story__text">We started Gym67 with a single belief: fitness products should be as refined as the discipline itself. Every supplement is lab-tested, every piece of equipment is precision-engineered, and every garment is designed to move with intention. We don't do hype — we do craft. Built for athletes who train with purpose and live with standard.</p>
        <a href="#" class="brand-story__link">Read Our Story →</a>
      </div>
    </section>

    <!-- ========== SECTION 6: TESTIMONIALS TICKER ========== -->
    <section class="testimonials section" id="testimonials">
      <div class="container">
        <h2 class="section-heading section-heading--center">What Our Athletes Say</h2>
      </div>
      <div class="testimonials__track">
        <!-- Duplicate set for infinite scroll effect -->
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"The Whey Isolate Pro is hands down the cleanest protein I've ever used. No bloating, incredible taste, and the results speak for themselves."</p>
          <p class="testimonial-card__author">Adi Pratama</p>
          <p class="testimonial-card__location">Jakarta</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"Gym67's kettlebells feel premium in a way no other brand does. The knurling, the weight balance — everything is dialed in perfectly."</p>
          <p class="testimonial-card__author">Sarah Chen</p>
          <p class="testimonial-card__location">Singapore</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"Finally, a fitness brand that understands aesthetics and function aren't mutually exclusive. The training tees are my daily uniform now."</p>
          <p class="testimonial-card__author">Reza Mahendra</p>
          <p class="testimonial-card__location">Bandung</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"Ordered the Pre-Workout Ignite and was blown away. Smooth energy, no crash, and the focus is unlike anything I've tried before."</p>
          <p class="testimonial-card__author">Maya Indira</p>
          <p class="testimonial-card__location">Bali</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"The lifting gloves from Gym67 are built to last. Real leather, perfect fit, and they look incredible. Worth every rupiah."</p>
          <p class="testimonial-card__author">Kevin Hartono</p>
          <p class="testimonial-card__location">Surabaya</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"I've switched all my gear to Gym67 over the past year. The quality consistency across everything — supplements, apparel, equipment — is remarkable."</p>
          <p class="testimonial-card__author">Diana Putri</p>
          <p class="testimonial-card__location">Yogyakarta</p>
        </div>

        <!-- Duplicate for seamless loop -->
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"The Whey Isolate Pro is hands down the cleanest protein I've ever used. No bloating, incredible taste, and the results speak for themselves."</p>
          <p class="testimonial-card__author">Adi Pratama</p>
          <p class="testimonial-card__location">Jakarta</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"Gym67's kettlebells feel premium in a way no other brand does. The knurling, the weight balance — everything is dialed in perfectly."</p>
          <p class="testimonial-card__author">Sarah Chen</p>
          <p class="testimonial-card__location">Singapore</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"Finally, a fitness brand that understands aesthetics and function aren't mutually exclusive. The training tees are my daily uniform now."</p>
          <p class="testimonial-card__author">Reza Mahendra</p>
          <p class="testimonial-card__location">Bandung</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"Ordered the Pre-Workout Ignite and was blown away. Smooth energy, no crash, and the focus is unlike anything I've tried before."</p>
          <p class="testimonial-card__author">Maya Indira</p>
          <p class="testimonial-card__location">Bali</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"The lifting gloves from Gym67 are built to last. Real leather, perfect fit, and they look incredible. Worth every rupiah."</p>
          <p class="testimonial-card__author">Kevin Hartono</p>
          <p class="testimonial-card__location">Surabaya</p>
        </div>
        <div class="testimonial-card">
          <div class="testimonial-card__stars">★★★★★</div>
          <p class="testimonial-card__quote">"I've switched all my gear to Gym67 over the past year. The quality consistency across everything — supplements, apparel, equipment — is remarkable."</p>
          <p class="testimonial-card__author">Diana Putri</p>
          <p class="testimonial-card__location">Yogyakarta</p>
        </div>
      </div>
    </section>

    <!-- ========== SECTION 7: STATS BAR ========== -->
    <section class="stats-bar" id="stats">
      <div class="container">
        <div class="stats-bar__grid">
          <div class="stats-bar__item">
            <div class="stats-bar__number">10,000+</div>
            <div class="stats-bar__label">Customers</div>
          </div>
          <div class="stats-bar__item">
            <div class="stats-bar__number">67</div>
            <div class="stats-bar__label">Premium Products</div>
          </div>
          <div class="stats-bar__item">
            <div class="stats-bar__number">4.9 / 5</div>
            <div class="stats-bar__label">Rating</div>
          </div>
          <div class="stats-bar__item">
            <div class="stats-bar__number">100%</div>
            <div class="stats-bar__label">Free Returns</div>
          </div>
        </div>
      </div>
    </section>

    <!-- ========== SECTION FAQ: BOOTSTRAP ACCORDION ========== -->
    <section class="section" id="faq" style="background:var(--color-surface,#111);padding:80px 0;">
      <div style="max-width:780px;margin:0 auto;padding:0 24px;">
        <h2 class="section-heading section-heading--center" style="margin-bottom:48px;">Frequently Asked Questions</h2>

        <div class="accordion" id="faqAccordion">

          <div class="accordion-item" style="background:transparent;border:1px solid rgba(255,255,255,0.1);border-radius:8px;margin-bottom:12px;overflow:hidden;">
            <h3 class="accordion-header" id="faqHeading1">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1"
                style="background:rgba(255,255,255,0.04);color:var(--color-ink,#f0f0f0);font-weight:600;font-size:1rem;border:none;box-shadow:none;">
                Do you offer free shipping?
              </button>
            </h3>
            <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
              <div class="accordion-body" style="color:var(--color-ink-muted,#a0a0a0);background:rgba(255,255,255,0.02);font-size:0.95rem;">
                Yes! We offer free shipping on all orders above Rp500.000. Use code <strong>GYM67LAUNCH</strong> at checkout to unlock your free delivery on your first order.
              </div>
            </div>
          </div>

          <div class="accordion-item" style="background:transparent;border:1px solid rgba(255,255,255,0.1);border-radius:8px;margin-bottom:12px;overflow:hidden;">
            <h3 class="accordion-header" id="faqHeading2">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2"
                style="background:rgba(255,255,255,0.04);color:var(--color-ink,#f0f0f0);font-weight:600;font-size:1rem;border:none;box-shadow:none;">
                Where are your products sourced from?
              </button>
            </h3>
            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
              <div class="accordion-body" style="color:var(--color-ink-muted,#a0a0a0);background:rgba(255,255,255,0.02);font-size:0.95rem;">
                All Gym67 supplements are lab-tested and sourced from certified manufacturers. Our equipment and apparel are precision-engineered with premium materials selected for durability and performance.
              </div>
            </div>
          </div>

          <div class="accordion-item" style="background:transparent;border:1px solid rgba(255,255,255,0.1);border-radius:8px;margin-bottom:12px;overflow:hidden;">
            <h3 class="accordion-header" id="faqHeading3">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3"
                style="background:rgba(255,255,255,0.04);color:var(--color-ink,#f0f0f0);font-weight:600;font-size:1rem;border:none;box-shadow:none;">
                What is your return policy?
              </button>
            </h3>
            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
              <div class="accordion-body" style="color:var(--color-ink-muted,#a0a0a0);background:rgba(255,255,255,0.02);font-size:0.95rem;">
                We offer 100% free returns within 30 days of purchase. Simply contact our support team and we'll arrange a hassle-free collection from your door — no questions asked.
              </div>
            </div>
          </div>

          <div class="accordion-item" style="background:transparent;border:1px solid rgba(255,255,255,0.1);border-radius:8px;margin-bottom:12px;overflow:hidden;">
            <h3 class="accordion-header" id="faqHeading4">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4"
                style="background:rgba(255,255,255,0.04);color:var(--color-ink,#f0f0f0);font-weight:600;font-size:1rem;border:none;box-shadow:none;">
                Are your supplements safe and certified?
              </button>
            </h3>
            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
              <div class="accordion-body" style="color:var(--color-ink-muted,#a0a0a0);background:rgba(255,255,255,0.02);font-size:0.95rem;">
                Absolutely. Every Gym67 supplement undergoes rigorous third-party lab testing for purity and potency. We comply with all BPOM standards and provide full ingredient transparency on every product label.
              </div>
            </div>
          </div>

          <div class="accordion-item" style="background:transparent;border:1px solid rgba(255,255,255,0.1);border-radius:8px;overflow:hidden;">
            <h3 class="accordion-header" id="faqHeading5">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5"
                style="background:rgba(255,255,255,0.04);color:var(--color-ink,#f0f0f0);font-weight:600;font-size:1rem;border:none;box-shadow:none;">
                How can I track my order?
              </button>
            </h3>
            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
              <div class="accordion-body" style="color:var(--color-ink-muted,#a0a0a0);background:rgba(255,255,255,0.02);font-size:0.95rem;">
                Once your order ships, you'll receive a tracking number via email. You can use this to monitor your delivery in real time through our courier partner's portal.
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ========== SECTION 8: NEWSLETTER ========== -->
    <section class="newsletter section" id="newsletter">
      <div class="container">
        <h2 class="newsletter__heading">Join the Gym67 Circle</h2>
        <p class="newsletter__subtext">Get early access to new drops, exclusive member pricing, and training insights delivered to your inbox.</p>
        <!-- PHP: Connect to newsletter_subscribers table -->
        <form class="newsletter__form form-inline" action="handlers/newsletter_handler.php" method="POST">
          <label for="newsletter-email" class="visually-hidden">Email address</label>
          <input type="email" id="newsletter-email" name="email" class="form-input" placeholder="Your email address" required>
          <button type="submit" class="btn btn--primary">Get Early Access</button>
        </form>
      </div>
    </section>

  </main>

  <!-- ========== FOOTER ========== -->
  <footer class="footer" id="footer">
    <div class="container">
      <div class="footer__grid">
        <!-- Column 1: Brand -->
        <div class="footer__col">
          <div class="footer__brand-name">GYM67</div>
          <div class="footer__tagline">Built Different.</div>
          <p class="footer__desc">Premium fitness essentials for athletes who refuse to compromise. Every product is crafted with intention and refined for excellence.</p>
        </div>

        <!-- Column 2: Quick Links -->
        <div class="footer__col">
          <h4 class="footer__heading">Quick Links</h4>
          <a href="shop.php" class="footer__link">Shop</a>
          <a href="#brand-story" class="footer__link">About</a>
          <a href="reviews.php" class="footer__link">Reviews</a>
          <a href="contact.php" class="footer__link">Contact</a>
        </div>

        <!-- Column 3: Categories -->
        <div class="footer__col">
          <h4 class="footer__heading">Categories</h4>
          <a href="shop.php" class="footer__link">Supplements</a>
          <a href="shop.php" class="footer__link">Equipment</a>
          <a href="shop.php" class="footer__link">Apparel</a>
          <a href="shop.php" class="footer__link">Accessories</a>
        </div>

        <!-- Column 4: Newsletter -->
        <div class="footer__col footer__newsletter">
          <h4 class="footer__heading">Stay Connected</h4>
          <p class="footer__newsletter-text">Subscribe for exclusive drops and member-only pricing.</p>
          <form class="form-inline" action="handlers/newsletter_handler.php" method="POST">
            <label for="footer-email" class="visually-hidden">Email address</label>
            <input type="email" id="footer-email" name="email" class="form-input" placeholder="Your email address" required>
            <button type="submit" class="btn btn--accent">Subscribe</button>
          </form>
        </div>
      </div>

      <div class="footer__bottom">
        <p class="footer__copyright">&copy; 2026 Gym67. All rights reserved.</p>
        <!-- PHP_SESSION_START placeholder -->
      </div>
    </div>
  </footer>

  <!-- Scroll class toggle for nav -->
  <script>
    window.addEventListener('scroll', function() {
      document.getElementById('main-nav').classList.toggle('scrolled', window.scrollY > 50);
    });
  </script>

  <!-- Bootstrap 5.3 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmxc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
