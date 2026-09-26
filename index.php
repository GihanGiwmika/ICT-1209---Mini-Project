<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechQuiz - Home & Authentication</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid px-4">
            <div class="logo">
                <span class="logo-icon">T</span>
                <span class="logo-text">TechQuiz</span>
            </div>
            <div class="navbar-nav ms-auto nav-links-gap">
                <a class="nav-link active fw-semibold" href="index.php">Home</a>
                <a class="nav-link text-light" href="contact.php">Contact</a>
            </div>

            <!-- Dynamic Sign In / Logout Button -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="auth/logout.php" class="btn btn-outline-danger ms-4">Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</a>
            <?php else: ?>
                <a href="#auth-section" id="user-nav-btn" class="btn-signin ms-4">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Top Toast Notification -->
    <?php if (isset($_GET['error']) || isset($_GET['register'])): ?>
        <?php 
            $isError = isset($_GET['error']);
            $toastMsg = $isError ? htmlspecialchars($_GET['error']) : 'Account created successfully. Please login.';
        ?>
        <div id="status-toast" class="custom-status-toast <?= $isError ? 'toast-error' : 'toast-success'; ?>">
            <span class="toast-icon"><?= $isError ? '⚠️' : '🎉'; ?></span>
            <span class="toast-text"><?= $toastMsg; ?></span>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="container my-5">

        <div class="home-header">
            <span class="badge">• LIVE QUIZ ENGINE — ICT 1209 EDITION</span>
            <h1 class="home-title">Test your knowledge.<br><span class="highlight-purple">Burst the curve.</span></h1>
            <p class="home-description">
                Timed multiple-choice challenges across ICT, Science & General Knowledge — built for university brains who like a bit of pressure.
            </p>
        </div>

        <div class="row g-4 mt-2 justify-content-center" id="auth-section">
            <div class="col-md-5">
                <div class="custom-card p-4">

                    <!-- Tab Buttons -->
                    <div class="tab-switch-wrapper mb-4">
                        <button type="button" class="tab-btn active" id="login-tab">Login</button>
                        <button type="button" class="tab-btn inactive" id="register-tab">Register</button>
                    </div>

                    <!-- Login Form -->
                    <form id="login-form" action="auth/login.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Username</label>
                            <input type="text" name="username" id="login-username" class="form-control custom-input" placeholder="e.g. john_doe" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small">Password</label>
                            <input type="password" name="password" class="form-control custom-input" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-purple w-100 py-2">Login to TechQuiz</button>
                    </form>

                    <!-- Register Form -->
                    <form id="register-form" action="auth/register.php" method="POST" class="d-none">
                        <div class="mb-3">
                            <label class="form-label text-muted small">Username</label>
                            <input type="text" name="username" class="form-control custom-input" placeholder="e.g. john_doe" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-muted small">Email Address</label>
                            <input type="email" name="email" class="form-control custom-input" placeholder="e.g. john@example.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label text-muted small">Password</label>
                            <input type="password" name="password" class="form-control custom-input" placeholder="••••••••" required>
                        </div>
                        <button type="submit" class="btn btn-purple w-100 py-2">Create Account</button>
                    </form>

                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="custom-footer">
        <div class="footer-container">
            <div class="footer-left">
                <span>&copy;2026 TechQuiz</span>
            </div>
            <div class="footer-center">
                <span>&bull; A mini-project by the <b>Faculty of Technology.</b></span>
            </div>
            <div class="footer-right">
                <span>#Rajarata University of Sri Lanka.</span>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/main1.js"></script>
</body>
</html>