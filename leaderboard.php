<?php
session_start();
require_once 'includes/db.php';

// Fetch top 5 scores ordered by highest score first
$stmt = $pdo->query("SELECT username, category, score, DATE_FORMAT(played_at, '%d %b %Y') AS play_date FROM scores ORDER BY score DESC, id DESC LIMIT 5");
$leaderboard = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechQuiz - Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/leaderboard.css">
</head>
<body>

    <!-- Header Navigation -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid px-4">
            <div class="logo">
                <span class="logo-icon">T</span>
                <span class="logo-text">TechQuiz</span>
            </div>
        
            <div class="navbar-nav ms-auto nav-links-gap">
                <a class="nav-link text-light" href="dashboard.php">Dashboard</a>
                <a class="nav-link active fw-semibold" href="leaderboard.php">Leaderboard</a>
                <a class="nav-link text-light" href="contact.php">Contact</a>
            </div>
        
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="auth/logout.php" class="btn btn-outline-danger ms-4">Logout (<?= htmlspecialchars($_SESSION['username']); ?>)</a>
            <?php else: ?>
                <a href="index.php#auth-section" class="btn-signin ms-4">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Leaderboard Content Section -->
    <main class="container my-5">
        <div class="text-center mb-4">
            <h1 class="page-title">🏆 TOP BRAINS RANKING 🏆</h1>
            <p class="page-subtitle text-muted">The sharpest minds this semester — updated after every quiz submission.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="leaderboard-card p-4">
                    <table class="table table-borderless text-light align-middle mb-0">
                        <thead>
                            <tr class="text-muted small border-bottom border-secondary">
                                <th>RANK</th>
                                <th>PLAYER</th>
                                <th>SUBJECT</th>
                                <th>SCORE</th>
                                <th>DATE PLAYED</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($leaderboard)): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">No quiz records yet. Be the first to play!</td>
                                </tr>
                            <?php else: ?>
                                <?php 
                                $rank = 1;
                                foreach ($leaderboard as $row): 
                                    $badge = ($rank === 1) ? 'rank-1' : (($rank === 2) ? 'rank-2' : (($rank === 3) ? 'rank-3' : 'rank-other'));
                                    $subj = !empty($row['category']) ? strtoupper($row['category']) : 'ICT';
                                ?>
                                <tr>
                                    <td><span class="rank-badge <?= $badge ?>"><?= $rank ?></span></td>
                                    <td><strong><?= htmlspecialchars($row['username']) ?></strong></td>
                                    <td><span class="badge text-dark bg-light px-3 py-2 fw-semibold"><?= htmlspecialchars($subj) ?></span></td>
                                    <td><strong><?= (int)$row['score'] ?></strong></td>
                                    <td><?= htmlspecialchars($row['play_date']) ?></td>
                                </tr>
                                <?php 
                                    $rank++;
                                endforeach; 
                                ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="dashboard.php" class="btn btn-purple px-4 py-2 text-decoration-none">↺ Play Again</a>
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

    <script src="js/main.js"></script>
</body>
</html>