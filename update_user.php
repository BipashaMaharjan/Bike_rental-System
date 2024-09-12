<?php
include('db.php'); // Include the database connection

// Retrieve the ID from the URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch existing data
$sql = "SELECT * FROM users WHERE id=?";
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
    $username = ($_POST["username"]);
    $email = ($_POST["email"]);
    $role = ($_POST["role"]);

    // Update the record
    $sql = "UPDATE users SET username=?, email=?, role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $email, $role, $id);

    if ($stmt->execute()) {
        header("Location: view_users.php");
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
    <h2 class="text-center mb-4">Update User</h2>
    <form method="POST" action="">
        <div class="mb-3">
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlspecialchars($row['username']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role:</label>
            <select class="form-select" name="role" required>
                <option value="customer" <?php echo $row['role'] === 'customer' ? 'selected' : ''; ?>>Customer</option>
                <option value="admin" <?php echo $row['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>

<?php
?>
