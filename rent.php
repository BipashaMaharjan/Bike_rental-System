<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to rent a bike.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $bike_id = (int)$_POST['bike_id'];
    $user_id = $_SESSION['user_id'];
    $rental_start = $_POST['rental_start'];
    $rental_end = $_POST['rental_end'];

    // Prepare the SQL query
    $stmt = $conn->prepare("INSERT INTO rentals (user_id, bike_id, rental_start, rental_end, price) VALUES (?, ?, ?, ?, ?)");

    // Check if prepare() failed
    if ($stmt === false) {
        die("Error preparing the SQL statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("iissd", $user_id, $bike_id, $rental_start, $rental_end, $price);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Bike rented successfully! <a href='mybookings.php'>View My Bookings</a></div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error inserting records into 'rentals' table: " . $stmt->error . "</div>";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Bike</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">Rent a Bike</h2>
        <form method="post" action="rent.php">
            <div class="mb-3">
                <label for="bike_id" class="form-label">Bike ID</label>
                <input type="number" class="form-control" id="bike_id" name="bike_id" required>
            </div>
            <div class="mb-3">
                <label for="rental_start" class="form-label">Rental Start Date</label>
                <input type="datetime-local" class="form-control" id="rental_start" name="rental_start" required>
            </div>
            <div class="mb-3">
                <label for="rental_end" class="form-label">Rental End Date</label>
                <input type="datetime-local" class="form-control" id="rental_end" name="rental_end" required>
            </div>
            <button type="submit" class="btn btn-primary">Rent Bike</button>
        </form>
    </div>
</body>
</html>
