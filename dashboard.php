<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechQuiz - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="nav-link text-light" href="index.php">Home</a>
                <a class="nav-link text-light" href="leaderboard.php">Leaderboard</a>
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

    <!-- Main Content -->
    <main class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="custom-card p-4">
                    <span class="card-subtitle">Quiz Setup</span>
                    <h3 class="card-title">Welcome, <?= isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Player'; ?>! 👋</h3>
                    <p class="card-desc">Pick a category and jump straight into a 10-question timed round.</p>
                    
                    <div class="mb-4 mt-4">
                        <label class="form-label text-muted small">Select Category</label>
                        <select class="form-select custom-input" id="category-select">
                            <option value="ict">ICT</option>
                            <option value="science">Science</option>
                            <option value="gk">General Knowledge</option>
                        </select>
                    </div>

                    <button id="start-btn" class="btn btn-purple w-100 py-3 text-center border-0 fw-bold">🚀 START QUIZ</button>

                    <div class="quiz-stats-row mt-4">
                        <div class="stat-item">
                            <strong>10</strong>
                            <span>Questions</span>
                        </div>
                        <div class="stat-item">
                            <strong>30s</strong>
                            <span>Per Question</span>
                        </div>
                        <div class="stat-item">
                            <strong>3</strong>
                            <span>Categories</span>
                        </div>
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

    <!-- Pass Selected Category to Quiz -->
    <script>
    document.getElementById('start-btn').addEventListener('click', function() {
        const selectedCat = document.getElementById('category-select').value;
        localStorage.setItem('selectedCategory', selectedCat);
        window.location.href = 'quiz.php?cat=' + encodeURIComponent(selectedCat);
    });
    </script>
</body>
</html>