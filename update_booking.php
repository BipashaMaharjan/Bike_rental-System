<?php
include('db.php'); // Include the database connection

// Retrieve the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing data
$sql = "SELECT * FROM rentals WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No record found.";
    exit();
}

$row = $result->fetch_assoc();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bike_id = intval($_POST["bike_id"]);
    $rental_start = $_POST["rental_start"];
    $rental_end = $_POST["rental_end"];
    $price = floatval($_POST["price"]);

    // Update the record
    $sql = "UPDATE rentals SET bike_id=?, rental_start=?, rental_end=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issdi", $bike_id, $rental_start, $rental_end, $price, $id);

    if ($stmt->execute()) {
        header("Location: view_bookings.php");
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}

$stmt->close();
$conn->close();
?>

<!-- Form to update the record -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Update Booking</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="bike_id" class="form-label">Bike ID:</label>
            <input type="number" class="form-control" name="bike_id" value="<?php echo htmlspecialchars($row['bike_id']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="rental_start" class="form-label">Rental Start:</label>
            <input type="datetime-local" class="form-control" name="rental_start" value="<?php echo htmlspecialchars($row['rental_start']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="rental_end" class="form-label">Rental End:</label>
            <input type="datetime-local" class="form-control" name="rental_end" value="<?php echo htmlspecialchars($row['rental_end']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price:</label>
            <input type="number" step="0.01" class="form-control" name="price" value="<?php echo htmlspecialchars($row['price']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Booking</button>
    </form>
</div>

<?php
?>
