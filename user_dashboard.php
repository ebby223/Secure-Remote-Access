<?php
session_start();
if(!isset($_SESSION['user'])) header("Location: login.php");

$user = $_SESSION['user'];

// Use only data from session/database
// For demo purposes, we'll use what's available plus some defaults
// In real scenario, this would come from DB queries
?>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">

<div  class="container py-4">
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1">Dashboard</h1>
            <p class="text-muted mb-0">Welcome back, <?= htmlspecialchars($user['name']) ?></p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span class="badge bg-primary">User Account</span>
            <a href="logout.php" class="btn btn-outline-danger">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Account Status</h6>
                            <h4 class="mb-0">
                                <span class="badge bg-success">Active</span>
                            </h4>
                        </div>
                        <i class="bi bi-person-check text-success fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Last Login</h6>
                            <h5 class="mb-0"><?= !empty($user['last_login']) ? $user['last_login'] : 'First time' ?></h5>
                        </div>
                        <i class="bi bi-clock-history text-primary fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">Member Since</h6>
                            <h5 class="mb-0"><?= !empty($user['created_at']) ? $user['created_at'] : date('Y-m-d') ?></h5>
                        </div>
                        <i class="bi bi-calendar-event text-info fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="text-muted mb-2">System Version</h6>
                            <h5 class="mb-0">v1.0.0</h5>
                        </div>
                        <i class="bi bi-gear text-warning fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="row">
        <!-- System Information -->
        <div class="col-lg-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 pb-0">
                    <h5 class="card-title mb-0"><i class="bi bi-info-circle me-2"></i>System Information</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Account Type</span>
                                    <span class="fw-medium">User</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Email</span>
                                    <span class="fw-medium"><?= htmlspecialchars($user['email'] ?? 'N/A') ?></span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Username</span>
                                    <span class="fw-medium"><?= htmlspecialchars($user['username'] ?? $user['name']) ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>System Status</span>
                                    <span class="badge bg-success">Operational</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Support Status</span>
                                    <span class="badge bg-info">Available</span>
                                </li>
                                <li class="list-group-item px-0 d-flex justify-content-between">
                                    <span>Data Privacy</span>
                                    <span class="badge bg-success">Enabled</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="mt-4">
                        <h6 class="mb-3">Recent Activity</h6>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <small>Current Session Started</small>
                                    <small><?= date('H:i') ?></small>
                                </div>
                            </div>
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <small>Dashboard Accessed</small>
                                    <small>Today</small>
                                </div>
                            </div>
                            <?php if(!empty($user['last_login'])): ?>
                            <div class="list-group-item px-0">
                                <div class="d-flex w-100 justify-content-between">
                                    <small>Previous Login</small>
                                    <small><?= $user['last_login'] ?></small>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Quick Actions & System Status -->
            <div class="col-lg-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-header bg-white border-0 pb-0">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-lightning-charge me-2"></i>Quick Actions
                        </h5>
                    </div>

                    <div class="card-body">
                        <div class="d-grid gap-2">

                            <a href="profile.php" class="btn btn-outline-primary text-start">
                                <i class="bi bi-person me-2"></i>View Profile
                            </a>

                            <a href="change_password.php" class="btn btn-outline-secondary text-start">
                                <i class="bi bi-key me-2"></i>Change Password
                            </a>

                            <a href="help.php" class="btn btn-outline-info text-start">
                                <i class="bi bi-question-circle me-2"></i>Help & Support
                            </a>

                            <a href="notifications.php" class="btn btn-outline-warning text-start">
                                <i class="bi bi-bell me-2"></i>Notification Settings
                            </a>

                        </div>
                    </div>
                </div>
            </div>

            
            <!-- System Status -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white border-0">
                    <h5 class="card-title mb-0"><i class="bi bi-shield-check me-2"></i>Security Status</h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success d-flex align-items-center mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>Your account is secured</div>
                    </div>
                    <small class="text-muted d-block mb-2">Recommended actions:</small>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Regular password updates</small>
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Monitor login activity</small>
                        </li>
                        <li>
                            <i class="bi bi-check-circle text-success me-2"></i>
                            <small>Logout after each session</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- System Logs -->
    <div class="card border-0 shadow-sm mt-4">
        <div class="card-header bg-white border-0">
            <h5 class="card-title mb-0"><i class="bi bi-list-check me-2"></i>Session Information</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Timestamp</th>
                            <th>Status</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Current Session Started</td>
                            <td><?= date('Y-m-d H:i:s') ?></td>
                            <td><span class="badge bg-success">Active</span></td>
                            <td>Dashboard access</td>
                        </tr>
                        <?php if(!empty($user['last_login'])): ?>
                        <tr>
                            <td>Previous Login</td>
                            <td><?= $user['last_login'] ?></td>
                            <td><span class="badge bg-secondary">Completed</span></td>
                            <td>User login</td>
                        </tr>
                        <?php endif; ?>
                        <tr>
                            <td>Profile Accessed</td>
                            <td><?= date('Y-m-d H:i:s') ?></td>
                            <td><span class="badge bg-info">View</span></td>
                            <td>Dashboard loaded</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer Note -->
    <div class="mt-4 text-center text-muted">
        <small>
            <i class="bi bi-info-circle me-1"></i>
            System time: <?= date('l, F j, Y H:i:s') ?> | 
            User ID: <?= htmlspecialchars($user['id'] ?? 'N/A') ?> | 
            For support, contact: admin@system.com
        </small>
    </div>
</div>

<script>
// Simple script for refreshing time (optional)
document.addEventListener('DOMContentLoaded', function() {
    function updateTime() {
        const now = new Date();
        const timeElement = document.querySelector('.text-muted small');
        if(timeElement) {
            const timeString = now.toLocaleString('en-US', { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
            const originalText = timeElement.textContent;
            const newText = originalText.replace(/System time:.*?\|/, `System time: ${timeString} |`);
            timeElement.textContent = newText;
        }
    }
    
    // Update time every minute
    setInterval(updateTime, 60000);
    
    // Add click handlers for quick actions
    document.querySelectorAll('.btn-outline-primary, .btn-outline-secondary, .btn-outline-info, .btn-outline-warning').forEach(btn => {
        btn.addEventListener('click', function() {
            alert('This feature would be implemented in a real system. For now, please use the main navigation.');
        });
    });
});
</script>

</body>
</html>