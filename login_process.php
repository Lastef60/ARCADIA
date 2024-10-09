<?php
session_start();
require 'config/env.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute SQL statement to fetch user
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['utilisateur_id'] = $user['utilisateur_id'];
        $_SESSION['role_id'] = $user['role_id'];
        header("Location: index.php"); // Redirect to homepage or employee dashboard
        exit();
    } else {
        echo "Invalid email or password.";
    }
}

