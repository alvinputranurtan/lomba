<?php
session_start();
include 'config.php';
include 'functions.php';
include 'csrf.php';

// Proteksi brute force sederhana
if (!isset($_SESSION['login_attempt'])) {
    $_SESSION['login_attempt'] = 0;
    $_SESSION['last_attempt_time'] = time();
}
if (time() - $_SESSION['last_attempt_time'] > 900) {
    $_SESSION['login_attempt'] = 0;
}

if ($_SESSION['login_attempt'] >= 5) {
    $_SESSION['error'] = "Terlalu banyak percobaan. Coba lagi dalam 15 menit.";
    log_activity("Blokir brute force dari IP: {$_SERVER['REMOTE_ADDR']}");
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verify_csrf_token($_POST['csrf_token'])) {
        $_SESSION['error'] = "CSRF token tidak valid.";
        log_activity("Upaya serangan CSRF.");
        header("Location: login.php");
        exit;
    }

    $username = clean_input($_POST['username']);
    $password = $_POST['password'];

    if (strlen($username) > 50 || strlen($password) > 255) {
        $_SESSION['error'] = "Input tidak valid.";
        header("Location: login.php");
        exit;
    }

    // Ambil data user termasuk role
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $uname, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            session_regenerate_id(true);
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = htmlspecialchars($uname);
            $_SESSION['role'] = $role;
            $_SESSION['login_attempt'] = 0;
            log_activity("Login sukses untuk user $uname (role: $role)");

            // Redirect sesuai role
            if ($role === 'admin') {
                header("Location: ../index.php");
            } elseif ($role === 'user') {
                header("Location: ../index.php?page=agrojual");
            } else {
                header("Location: login.php");
            }
            exit;
        }
    }

    // Jika gagal login
    $_SESSION['login_attempt']++;
    $_SESSION['last_attempt_time'] = time();
    $_SESSION['error'] = "Username atau password salah.";
    log_activity("Gagal login: $username dari IP: {$_SERVER['REMOTE_ADDR']}");
    header("Location: login.php");
    exit;
}
?>