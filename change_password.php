<?php
session_start();
include 'config/db.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current = $_POST['current_password'];
    $new = $_POST['new_password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE id=?");
    $stmt->execute([$_SESSION['user']['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!password_verify($current, $user['password'])) {
        $msg = '<div class="alert alert-danger">Current password incorrect</div>';
    } else {
        $hashed = password_hash($new, PASSWORD_DEFAULT);
        $conn->prepare("UPDATE users SET password=? WHERE id=?")
             ->execute([$hashed, $_SESSION['user']['id']]);
        $msg = '<div class="alert alert-success">Password updated successfully</div>';
    }
}
?>
