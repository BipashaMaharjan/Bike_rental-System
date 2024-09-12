<?php
include('db.php'); // Include the database connection

// Fetch all bikes
$sql = "SELECT * FROM bikes";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Bikes</h2>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Bike Image" width="100"></td>
                        <td><?php echo htmlspecialchars($row['type']); ?></td>
                        <td>
                            <a href="update_bike.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="delete_bike.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this bike?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No bikes found.</p>
    <?php endif; ?>
</div>

<?php
?>
