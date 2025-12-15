<?php
session_start();
include 'config/db.php';

$msg = "";

// Get password rule set by admin
$setting = $conn->query("SELECT password_min FROM settings LIMIT 1")->fetch();
$minLength = $setting ? (int)$setting['password_min'] : 8;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1️⃣ Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $msg = '<div class="alert alert-danger text-center">
                    Invalid email format
                </div>';
    }

    // 2️⃣ Validate password length
    elseif (strlen($password) < $minLength) {
        $msg = '<div class="alert alert-danger text-center">
                    Password must be at least '.$minLength.' characters long
                </div>';
    }

    // 3️⃣ Validate letters + numbers
    elseif (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $msg = '<div class="alert alert-danger text-center">
                    Password must contain letters and numbers
                </div>';
    }

    else {
        // 4️⃣ Check duplicate email
        $check = $conn->prepare("SELECT id FROM users WHERE email=? LIMIT 1");
        $check->execute([$email]);

        if ($check->rowCount() > 0) {
            $msg = '<div class="alert alert-danger text-center">
                        Email is already registered
                    </div>';
        } else {
            // 5️⃣ Hash password
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            // 6️⃣ Insert user
            $stmt = $conn->prepare(
                "INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)"
            );

            if ($stmt->execute([$name,$email,$hashed,'user'])) {

                $userId = $conn->lastInsertId();

                // 7️⃣ Fetch user
                $stmt2 = $conn->prepare("SELECT * FROM users WHERE id=? LIMIT 1");
                $stmt2->execute([$userId]);
                $user = $stmt2->fetch(PDO::FETCH_ASSOC);

                // 8️⃣ Set session
                $_SESSION['user'] = $user;

                // 9️⃣ Redirect to user dashboard
                header("Location: user_dashboard.php");
                exit;
            } else {
                $msg = '<div class="alert alert-danger text-center">
                            Registration failed. Try again.
                        </div>';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background: linear-gradient(135deg, #6a11cb, #2575fc); min-height: 100vh;">

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-header text-center text-white p-4" style="background: linear-gradient(45deg, #6a11cb, #2575fc); border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h3>CREATE ACCOUNT</h3>
            </div>
            <div class="card-body p-4">
                <?= $msg ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Name</label>
                        <input name="name" class="form-control form-control-lg rounded-3" placeholder="Enter full name" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input name="email" type="email" class="form-control form-control-lg rounded-3" placeholder="Enter email" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Password</label>
                        <input name="password" type="password" class="form-control form-control-lg rounded-3" placeholder="Enter password" required>
                    </div>

                    <button class="btn btn-primary btn-lg w-100 rounded-3">Register</button>
                </form>

                <div class="text-center mt-3">
                    <a href="login.php" class="text-decoration-none fw-semibold text-primary">Already have an account? Login</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
