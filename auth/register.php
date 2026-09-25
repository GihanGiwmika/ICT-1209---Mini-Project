<?php
session_start();

require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    $password = $_POST['password'] ?? '';

    if (!empty($username) && !empty($email) && !empty($password)) {
        // Check already available the Username and Password
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $checkStmt->execute([$username, $email]);

        if ($checkStmt->fetch()) {
            header("Location: ../index.php?error=Username or Email already exists");
            exit;
        }

        // Hashing the password with BCRYPT
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        //Entering data into the database
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        
        if ($stmt->execute([$username, $email, $hashed_password])) {
            // If successful, send to the home page.
            header("Location: ../index.php?register=success");
            exit;
        } else {
            header("Location: ../index.php?error=Registration failed");
            exit;
        }
    }
}
?>