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
  <meta name="description" content="Log in or create your Gym67 account. Join 10,000+ athletes already training with Gym67.">
  <title>Login — Gym67</title>
  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/layout.css">
  <link rel="stylesheet" href="css/components.css">
  <link rel="stylesheet" href="css/animations.css">
  <link rel="stylesheet" href="css/pages/login.css">
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

  <main>
    <div class="auth-layout">

      <!-- Left: Brand Panel -->
      <div class="auth-brand">
        <img src="images/hero-main.jpg" alt="Gym67 athlete training" class="auth-brand__image">
        <div class="auth-brand__overlay">
          <blockquote class="auth-brand__quote">"The body achieves what the mind believes."</blockquote>
          <p class="auth-brand__attribution">— The Gym67 Philosophy</p>
        </div>
      </div>

      <!-- Right: Form Panel -->
      <div class="auth-form-panel">
        <div class="auth-form-panel__inner">
          <div class="auth-form-panel__logo">GYM67</div>

          <div class="auth-tabs">
            <input type="radio" name="auth-tab" id="auth-login" class="auth-tabs__input" checked>
            <input type="radio" name="auth-tab" id="auth-register" class="auth-tabs__input">

            <div class="auth-tabs__nav">
              <label for="auth-login" class="auth-tabs__label">Login</label>
              <label for="auth-register" class="auth-tabs__label">Register</label>
            </div>

            <div class="auth-tabs__panels">

              <!-- Login Form -->
              <div class="auth-tabs__panel auth-tabs__panel--login">
                <!-- PHP: Validate credentials against users table, start session -->
                <form method="POST" action="handlers/login_handler.php">
                  <div class="form-group">
                    <label for="login-email" class="form-label">Email Address</label>
                    <input type="email" id="login-email" name="email" class="form-input" placeholder="you@example.com" required>
                  </div>
                  <div class="form-group">
                    <label for="login-password" class="form-label">Password</label>
                    <input type="password" id="login-password" name="password" class="form-input" placeholder="Enter your password" required>
                  </div>
                  <div class="auth-form__row">
                    <label class="form-checkbox">
                      <input type="checkbox" name="remember">
                      <span>Remember me</span>
                    </label>
                    <a href="#" class="auth-form__forgot">Forgot password?</a>
                  </div>
                  <button type="submit" class="btn btn--primary btn--full btn--lg">Login</button>
                </form>
              </div>

              <!-- Register Form -->
              <div class="auth-tabs__panel auth-tabs__panel--register">
                <!-- PHP: Hash password with password_hash(), INSERT into users table -->
                <form method="POST" action="handlers/register_handler.php">
                  <div class="form-group">
                    <label for="reg-name" class="form-label">Full Name</label>
                    <input type="text" id="reg-name" name="full_name" class="form-input" placeholder="Your full name" required>
                  </div>
                  <div class="form-group">
                    <label for="reg-email" class="form-label">Email Address</label>
                    <input type="email" id="reg-email" name="email" class="form-input" placeholder="you@example.com" required>
                  </div>
                  <div class="form-group">
                    <label for="reg-password" class="form-label">Password</label>
                    <input type="password" id="reg-password" name="password" class="form-input" placeholder="Create a password" required>
                  </div>
                  <div class="form-group">
                    <label for="reg-confirm" class="form-label">Confirm Password</label>
                    <input type="password" id="reg-confirm" name="password_confirm" class="form-input" placeholder="Confirm your password" required>
                  </div>
                  <button type="submit" class="btn btn--primary btn--full btn--lg">Create Account</button>
                </form>
              </div>

            </div>
          </div>

          <!-- Social Proof -->
          <div class="auth-social-proof">
            <p class="auth-social-proof__text">Join 10,000+ athletes already training with Gym67.</p>
          </div>

        </div>
      </div>

    </div>
  </main>

</body>
</html>
