<?php
session_start();
require_once 'includes/db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $username = $_SESSION['username'] ?? 'Player';
    $score = isset($_POST['score']) ? intval($_POST['score']) : 0;
    
    // Category mapping
    $selectedCat = strtolower(trim($_POST['category'] ?? ''));
    if ($selectedCat === 'science') {
        $category = 'SCIENCE';
    } elseif ($selectedCat === 'gk') {
        $category = 'GK';
    } else {
        $category = 'ICT';
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO scores (user_id, username, category, score) VALUES (?, ?, ?, ?)");
        $stmt->execute([$userId, $username, $category, $score]);
        echo json_encode(['status' => 'success', 'saved_category' => $category]);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
?>