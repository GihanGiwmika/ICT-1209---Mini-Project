<?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $entered_password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($entered_password)) {
        // 1. Get user details from database by username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // 2. Check if user exists and verify password using bcrypt
        if ($user && password_verify($entered_password, $user['password'])) {
            // Requirement: Call session_regenerate_id() for session security
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to dashboard.php on success
            header("Location: ../dashboard.php");
            exit;
        } else {
            // Redirect back with error message if password or username is invalid
            header("Location: ../index.php?error=Invalid username or password");
            exit;
        }
    } else {
        header("Location: ../index.php?error=Please fill in all fields");
        exit;
    }
}
?><?php
session_start();
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $entered_password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($entered_password)) {
        // 1. Get user details from database by username
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // 2. Check if user exists and verify password using bcrypt
        if ($user && password_verify($entered_password, $user['password'])) {
            // Requirement: Call session_regenerate_id() for session security
            session_regenerate_id(true);

            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Redirect to dashboard.php on success
            header("Location: ../dashboard.php");
            exit;
        } else {
            // Redirect back with error message if password or username is invalid
            header("Location: ../index.php?error=Invalid username or password");
            exit;
        }
    } else {
        header("Location: ../index.php?error=Please fill in all fields");
        exit;
    }
}
?>