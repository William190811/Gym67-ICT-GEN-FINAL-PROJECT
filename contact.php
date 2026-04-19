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
  <meta name="description" content="Get in touch with Gym67. Order inquiries, product questions, partnerships — we're here to help.">
  <title>Contact — Gym67</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/pages/contact.css">
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
      <div class="contact-header">
        <h1 class="contact-header__title">Contact Us</h1>
        <p class="contact-header__subtitle">Have a question about an order, a product, or a potential partnership? We'd love to hear from you.</p>
      </div>

      <!-- Contact Layout -->
      <div class="contact-layout">

        <!-- Left: Contact Info -->
        <div class="contact-info">
          <div class="contact-info__item">
            <div class="contact-info__icon">📍</div>
            <div>
              <p class="contact-info__label">Address</p>
              <p class="contact-info__value">Jl. Sudirman No. 67, Lantai 12<br>Jakarta Selatan, 12190<br>Indonesia</p>
            </div>
          </div>

          <div class="contact-info__item">
            <div class="contact-info__icon">✉</div>
            <div>
              <p class="contact-info__label">Email</p>
              <p class="contact-info__value">hello@gym67.com</p>
            </div>
          </div>

          <div class="contact-info__item">
            <div class="contact-info__icon">☏</div>
            <div>
              <p class="contact-info__label">Phone</p>
              <p class="contact-info__value">+62 21 5567 6700</p>
            </div>
          </div>

          <div class="contact-info__item">
            <div class="contact-info__icon">◷</div>
            <div>
              <p class="contact-info__label">Hours</p>
              <p class="contact-info__value">Monday — Friday: 09:00 — 18:00 WIB<br>Saturday: 10:00 — 15:00 WIB<br>Sunday: Closed</p>
            </div>
          </div>

        </div>

        <!-- Right: Contact Form -->
        <div class="contact-form">
          <h2 class="contact-form__title">Send a Message</h2>
          <!-- PHP: Send via mail() or PHPMailer, store in inquiries table -->
          <form method="POST" action="handlers/contact_handler.php">
            <div class="form-group">
              <label for="contact-name" class="form-label">Name</label>
              <input type="text" id="contact-name" name="name" class="form-input" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label for="contact-email" class="form-label">Email</label>
              <input type="email" id="contact-email" name="email" class="form-input" placeholder="you@example.com" required>
            </div>
            <div class="form-group">
              <label for="contact-subject" class="form-label">Subject</label>
              <select id="contact-subject" name="subject" class="form-select" required>
                <option value="" disabled selected>Select a topic</option>
                <option value="order">Order Inquiry</option>
                <option value="product">Product Question</option>
                <option value="partnership">Partnership</option>
                <option value="other">Other</option>
              </select>
            </div>
            <div class="form-group">
              <label for="contact-message" class="form-label">Message</label>
              <textarea id="contact-message" name="message" class="form-textarea" placeholder="How can we help?" required></textarea>
            </div>
            <button type="submit" class="btn btn--primary btn--full btn--lg">Send Message</button>
          </form>
        </div>

      </div>

      <!-- FAQ Section -->
      <section class="faq-section">
        <h2 class="faq-section__title">Frequently Asked Questions</h2>
        <div class="faq-list">

          <details class="faq-item">
            <summary>How long does shipping take?</summary>
            <div class="faq-item__content">
              <p>Domestic orders (Indonesia) typically arrive within 2–4 business days. International shipping takes 7–14 business days depending on destination. Orders above Rp500.000 ship free within Indonesia.</p>
            </div>
          </details>

          <details class="faq-item">
            <summary>What is your return policy?</summary>
            <div class="faq-item__content">
              <p>We offer free returns within 30 days of purchase for unused items in original packaging. Supplements that have been opened cannot be returned for hygiene reasons, but we offer a satisfaction guarantee — contact us if you're not happy.</p>
            </div>
          </details>

          <details class="faq-item">
            <summary>Are your supplements third-party tested?</summary>
            <div class="faq-item__content">
              <p>Yes. Every batch of Gym67 supplements is tested by an independent third-party lab. We provide a certificate of analysis (COA) accessible via QR code on each product container.</p>
            </div>
          </details>

          <details class="faq-item">
            <summary>Do you offer wholesale or partnership programs?</summary>
            <div class="faq-item__content">
              <p>Absolutely. We work with gyms, fitness studios, and select retailers. Use the contact form above with "Partnership" as the subject, and our business development team will get back to you within 48 hours.</p>
            </div>
          </details>

          <details class="faq-item">
            <summary>Can I track my order?</summary>
            <div class="faq-item__content">
              <p>Once your order ships, you'll receive a tracking number via email. You can also log in to your account and view real-time tracking updates under "My Orders."</p>
            </div>
          </details>

        </div>
      </section>

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
            <label for="footer-email-contact" class="visually-hidden">Email address</label>
            <input type="email" id="footer-email-contact" name="email" class="form-input" placeholder="Your email address" required>
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
