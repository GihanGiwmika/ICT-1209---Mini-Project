<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?error=Please login first");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechQuiz - Play Quiz</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <link rel="stylesheet" href="css/quiz.css">
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
        
            <a href="auth/logout.php" class="btn btn-outline-danger ms-4">Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</a>
        </div>
    </nav>

    <!-- Quiz Content -->
    <div class="container quiz-container my-auto py-4">
        
        <!-- Progress and Timer -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <span class="progress-text">Progress: <strong id="progress-text">Question 01 of 10</strong></span>
                <div class="custom-progress">
                    <div class="progress-fill" id="progress-bar"></div>
                </div>
            </div>

            <div class="timer-box text-center">
                <div class="timer-label">Timer</div>
                <div class="timer-value" id="timer-text">00:30</div>
            </div>
        </div>

        <!-- Question Card -->
        <div class="question-card mb-4">
            <div class="category-tag" id="category-tag">CATEGORY: ICT • QUESTION 1 OF 10</div>
            <h2 class="question-text" id="question-text">Loading question...</h2>
        </div>

        <!-- Option Cards -->
        <div class="row g-3">
            <div class="col-md-6">
                <div class="option-card" onclick="selectOption(this)">
                    <span class="option-badge">A</span>
                    <span class="option-text" id="optA"></span>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="option-card" onclick="selectOption(this)">
                    <span class="option-badge">B</span>
                    <span class="option-text" id="optB"></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="option-card" onclick="selectOption(this)">
                    <span class="option-badge">C</span>
                    <span class="option-text" id="optC"></span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="option-card" onclick="selectOption(this)">
                    <span class="option-badge">D</span>
                    <span class="option-text" id="optD"></span>
                </div>
            </div>
        </div>

        <!-- Next Button -->
        <div class="d-flex justify-content-end mt-4">
            <button class="btn btn-purple px-4 py-2" id="next-btn" onclick="nextQuestion()">Next Question</button>
        </div>

    </div>
    
    <!-- Score Modal -->
    <div id="score-modal" class="custom-modal d-none">
        <div class="modal-content-box text-center">
            <div class="modal-icon">🎉</div>
            <h3 class="modal-title">Quiz Completed!</h3>
            <p class="modal-subtitle">Here is your final score:</p>
                    
            <div class="score-display">
                <span id="final-score">0</span> <span class="score-total">/ 100</span>
            </div>

            <a href="dashboard.php" class="btn-modal-restart text-decoration-none d-inline-block mb-3">Try Again</a>
            <a href="leaderboard.php" class="btn-modal-restart text-decoration-none d-inline-block">Leaderboard</a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="custom-footer">
        <div class="footer-container">
            <div class="footer-left"><span>&copy;2026 TechQuiz</span></div>
            <div class="footer-center"><span>&bull; A mini-project by the <b>Faculty of Technology.</b></span></div>
            <div class="footer-right"><span>#Rajarata University of Sri Lanka.</span></div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="js/quiz.js?v=<?= time(); ?>"></script>
</body>
</html>