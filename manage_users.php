<?php
session_start();
include 'config/db.php';
if(!isset($_SESSION['user'])) header("Location: login.php");

$users = $conn->query("SELECT * FROM users ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: #fff;
            padding-top: 2rem;
        }
        .sidebar a {
            color: #adb5bd;
            display: block;
            padding: 0.8rem 1rem;
            text-decoration: none;
            border-radius: 0.5rem;
            margin-bottom: 0.3rem;
        }
        .sidebar a:hover, .sidebar a.active {
            background: #495057;
            color: #fff;
        }
        .card-stat {
            border-radius: 1rem;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: #fff;
            transition: transform 0.2s;
        }
        .card-stat:hover {
            transform: translateY(-5px);
        }
        .card-stat h5 {
            font-weight: 500;
        }
        .card-stat h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-2 sidebar d-flex flex-column">
            <h4 class="text-center mb-4">SecureAccess</h4>
            <?php include 'include/sidebar.php'; ?>
        </div>

        <!-- Main Content -->
        <div class="col-10 p-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>User Management</h2>
                <a href="create_user.php" class="btn btn-primary rounded-3"><i class="bi bi-person-plus-fill me-2"></i>Add User</a>
            </div>

            <div class="table-responsive shadow-sm rounded-4 overflow-hidden">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php while($u = $users->fetch(PDO::FETCH_ASSOC)): ?>
                        <tr>
                            <td><?= $u['id'] ?></td>
                            <td><?= htmlspecialchars($u['name']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['role'] ?? 'User') ?></td>
                            <td><?= $u['last_login'] ?? 'Never' ?></td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</div>

</body>
</html>

