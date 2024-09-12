<?php
include('db.php'); // Include the database connection

// Retrieve the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing data
$sql = "SELECT * FROM bikes WHERE id=?";
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
    $name = test_input($_POST["monamedel"]);
    $type = floatval($_POST["type"]);

    // Update the record
    $sql = "UPDATE bikes SET name=?, type=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdsi", $name, $type, $id);

    if ($stmt->execute()) {
        header("Location: view_bikes.php");
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
    <h2 class="text-center mb-4">Update Bike</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Type:</label>
            <input type="number" class="form-control" name="type" value="<?php echo htmlspecialchars($row['type']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Bike</button>
    </form>
</div>

<?php
?>
