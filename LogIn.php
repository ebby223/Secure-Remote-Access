<?php
session_start();
include 'config/db.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Fetch user by email
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session
        $_SESSION['user'] = $user;

        // Update last login
        $conn->prepare("UPDATE users SET last_login=NOW() WHERE id=?")
             ->execute([$user['id']]);

        // Insert access log
        $conn->prepare("INSERT INTO access_logs(user_id, action) VALUES (?, ?)")
             ->execute([$user['id'], "User logged in"]);

        // Redirect based on role
        if ($user['role'] === "admin") {
            header("Location: dashboard.php"); // admin dashboard
        } else {
            header("Location: user_dashboard.php"); // user dashboard
        }
        exit;
    } else {
        $msg = '<div class="alert alert-danger text-center">Invalid email or password</div>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #6a11cb, #2575fc); min-height: 100vh;">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-header text-center text-white p-4" style="background: linear-gradient(45deg, #6a11cb, #2575fc); border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h3>Login</h3>
            </div>
            <div class="card-body p-4">
                <?= $msg ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input name="email" type="email" class="form-control form-control-lg rounded-3" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input name="password" type="password" class="form-control form-control-lg rounded-3" placeholder="Enter password" required>
                    </div>

                    <button class="btn btn-primary btn-lg w-100 rounded-3">Login</button>
                </form>

                <div class="text-center mt-3">
                    <a href="register.php" class="text-decoration-none fw-semibold text-primary">Don't have an account? Register</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>