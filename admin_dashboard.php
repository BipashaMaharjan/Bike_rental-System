<?php

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .dashboard-container {
            max-width: 900px;
            margin: 50px auto;
        }
        .dashboard-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container dashboard-container">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        
        <div class="card dashboard-card">
            <div class="card-body">
                <h5 class="card-title">Manage Bookings</h5>
                <p class="card-text">View and edit all bookings made by users.</p>
                <a href="view_bookings.php" class="btn btn-primary">View Bookings</a>
            </div>
        </div>

        <!-- Add other management options here -->
        <!-- Example: Manage Users, Manage Bikes, etc. -->

        <div class="card dashboard-card">
            <div class="card-body">
                <h5 class="card-title">Manage Users</h5>
                <p class="card-text">View and edit user details.</p>
                <a href="view_users.php" class="btn btn-primary">View Users</a>
            </div>
        </div>

        <div class="card dashboard-card">
            <div class="card-body">
                <h5 class="card-title">Manage Bikes</h5>
                <p class="card-text">View and edit bike details.</p>
                <a href="view_bikes.php" class="btn btn-primary">View Bikes</a>
            </div>
        </div>
    </div>
    <a href="home.html" class="button-link">Go to home page</a>
    </body>
</html>
