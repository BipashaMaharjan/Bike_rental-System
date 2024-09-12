<?php
include('db.php'); // Include the database connection

// Retrieve the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Delete the record
$sql = "DELETE FROM bikes WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view_bikes.php");
    exit();
} else {
    echo "Error deleting record: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
