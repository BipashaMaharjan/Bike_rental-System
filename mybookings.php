<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view your bookings.");
}

$user_id = $_SESSION['user_id'];

// Prepare the SQL query
$stmt = $conn->prepare("SELECT rentals.id, rentals.bike_id, rentals.rental_start, rentals.rental_end, rentals.price, bikes.image
                         FROM rentals
                         JOIN bikes ON rentals.bike_id = bikes.id
                         WHERE rentals.user_id = ?");

if ($stmt === false) {
    die("Error preparing the SQL statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("i", $user_id);

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .booking-card {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center mb-4">My Bookings</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="card booking-card">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <!-- Display the image -->
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" class="img-fluid rounded-start" alt="Bike Image">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">Bike ID: <?php echo htmlspecialchars($row['bike_id']); ?></h5>
                                <p class="card-text">Rental Start: <?php echo htmlspecialchars($row['rental_start']); ?></p>
                                <p class="card-text">Rental End: <?php echo htmlspecialchars($row['rental_end']); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p class="text-center">You have no bookings.</p>
        <?php endif; ?>

        <?php
        // Close the statement
        $stmt->close();
        ?>
    </div>
</body>
</html>
