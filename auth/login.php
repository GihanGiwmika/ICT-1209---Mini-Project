<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $entered_password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($entered_password)) {
        // 1. Fetch user by username from database
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // 2. Check if user exists and verify password hash
        if ($user && password_verify($entered_password, $user['password'])) {
            // Regenerate session id to prevent fixation attacks
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to dashboard on success
            header("Location: ../dashboard.php");
            exit;
        } else {
            // Redirect back with error message if credentials do not match
            header("Location: ../index.php?error=Invalid username or password");
            exit;
        }
    } else {
        header("Location: ../index.php?error=Please fill in all fields");
        exit;
    }
}
?>