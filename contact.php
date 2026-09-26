<?php
session_start();
require_once 'includes/db.php';

$status = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $msg = trim($_POST['message'] ?? '');

    if (!empty($name) && !empty($email) && !empty($msg)) {
        $stmt = $pdo->prepare("INSERT INTO messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $msg])) {
            $status = 'success';
            $message = 'Thank you! Your message has been sent successfully.';
        } else {
            $status = 'error';
            $message = 'Failed to send message. Please try again.';
        }
    } else {
        $status = 'error';
        $message = 'Please fill in all required fields.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechQuiz - Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
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
                <a class="nav-link text-light" href="index.php">Home</a>
                <a class="nav-link active fw-semibold" href="contact.php">Contact</a>
            </div>

            <!-- Dynamic Sign In / Logout Button -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="auth/logout.php" class="btn btn-outline-danger ms-4">Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</a>
            <?php else: ?>
                <a href="#auth-section" id="user-nav-btn" class="btn-signin ms-4">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Toast Notification -->
    <?php if (!empty($status)): ?>
        <div id="status-toast" class="custom-status-toast <?= $status === 'success' ? 'toast-success' : 'toast-error'; ?>">
            <span class="toast-icon"><?= $status === 'success' ? '🎉' : '⚠️'; ?></span>
            <span class="toast-text"><?= htmlspecialchars($message); ?></span>
        </div>
    <?php endif; ?>

    <!-- Main Content -->
    <main class="container main-content py-5">
        <div class="text-center header-section mb-4">
            <h1 class="page-title">Get In Touch</h1>
            <p class="page-subtitle">Found a bug, have a feature idea, or just want to say hi? Drop us a message below—we're ready for one.</p>
        </div>

        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="custom-card form-card h-100">
                    <form id="ContactForm" action="contact.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" name="name" id="fullName" class="custom-input" placeholder="Enter Your Full Name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" id="emailAddress" class="custom-input" placeholder="username@gmail.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Message</label>
                            <textarea name="message" id="messageText" class="custom-input" rows="4" placeholder="Type Your feedback here..." required></textarea>
                        </div>
                        <button type="submit" class="btn-submit">Submit Message</button>
                    </form>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="col-lg-5 d-flex flex-column gap-3">
                <div class="custom-card info-card text-start">
                    <div class="info-icon mb-2">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <h5 class="info-title">Department</h5>
                        <p class="info-text">Department of ICT<br>Rajarata University of Sri Lanka</p>
                    </div>
                </div>

                <div class="custom-card info-card text-start">
                    <div class="info-icon mb-2">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div>
                        <h5 class="info-title">Support Email</h5>
                        <p class="info-subtext">For account & quiz-related queries</p>
                        <p class="info-highlight">supportechquiz@gmail.com</p>
                    </div>
                </div>

                <div class="custom-card info-card text-start">
                    <div class="info-icon mb-2">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div>
                        <h5 class="info-title">Response Time</h5>
                        <p class="info-text">We typically reply within <strong>1-2 business days.</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="custom-footer">
        <div class="footer-container">
            <div class="footer-left"><span>&copy;2026 TechQuiz</span></div>
            <div class="footer-center"><span>&bull; A mini-project by the <b>Faculty of Technology.</b></span></div>
            <div class="footer-right"><span>#Rajarata University of Sri Lanka.</span></div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/main.js"></script>
</body>
</html>