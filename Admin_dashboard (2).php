
<?php
session_start();
include 'config/db.php';

// Only admins can access
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
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
        .greeting {
            margin-bottom: 2rem;
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

        <!-- Main content -->
        <div class="col-10 p-5">
            <div class="greeting">
                <h2>Welcome, <?= $_SESSION['user']['name'] ?? 'User' ?>!</h2>
                <p class="text-muted">Here is an overview of your system.</p>
            </div>

            <div class="row g-4">
                <!-- Total Users Card -->
                <div class="col-md-4">
                    <div class="card card-stat p-4 shadow-lg">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Total Users</h5>
                                <!-- <h1><?= $totalUsers ?></h1> -->
                            </div>
                            <i class="bi bi-people-fill display-4"></i>
                        </div>
                    </div>
                </div>

                <!-- Active Users Card -->
                <div class="col-md-4">
                    <div class="card card-stat p-4 shadow-lg">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>Active Users</h5>
                                <!-- <h1><?= $activeUsers ?></h1> -->
                            </div>
                            <i class="bi bi-person-check-fill display-4"></i>
                        </div>
                    </div>
                </div>

                <!-- Mock Card Example -->
                <div class="col-md-4">
                    <div class="card card-stat p-4 shadow-lg">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5>System Uptime</h5>
                                <h1>99%</h1>
                            </div>
                            <i class="bi bi-clock-fill display-4"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Optional: Activity Table -->
            <div class="mt-5">
                <h4>Recent Activity</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover shadow-sm">
                        <thead class="table-dark">
                            <tr>
                                <th>User</th>
                                <th>Action</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
</div>

</body>
</html>
