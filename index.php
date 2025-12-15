<?php
// index.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Remote Access</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to right, #667eea, #764ba2);
            color: #fff;
        }
        .landing-card {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(10px);
            padding: 3rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(0,0,0,0.3);
        }
        .landing-card h1 {
            font-weight: 700;
            margin-bottom: 1rem;
            font-size: 3rem;
        }
        .landing-card p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
            color: #e0e0e0;
        }
        .btn-custom {
            width: 180px;
            font-size: 1.1rem;
            margin: 0.5rem;
        }
        @media (max-width: 576px) {
            .landing-card h1 {
                font-size: 2.2rem;
            }
        }
    </style>
</head>
<body>

<div class="landing-card">
    <h1><i class="bi bi-shield-lock-fill me-2"></i>Secure Remote Access</h1>
    <p>Manage your users, access logs, and settings securely from a single platform.</p>

    <div class="d-flex justify-content-center flex-wrap">
        <?php
            // Buttons
            echo '<a href="register.php" class="btn btn-light btn-custom fw-bold">Register</a>';
            echo '<a href="login.php" class="btn btn-outline-light btn-custom fw-bold">Login</a>';
        ?>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
