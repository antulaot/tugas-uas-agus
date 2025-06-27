<?php
require_once __DIR__ . '/../models/User.php';

function handleLogin() {
    session_start();
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = findUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: /barang.php");
            exit;
        } else {
            $error = "Username atau password salah!";
            require __DIR__ . '/../views/auth/login.php';
        }
    } else {
        require __DIR__ . '/../views/auth/login.php';
    }
}

function logout() {
    session_start();
    session_destroy();
    header("Location: /login.php");
    exit;
}
