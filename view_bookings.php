<?php
include('db.php'); // Include the database connection

// Fetch all bookings
$sql = "SELECT rentals.id, rentals.bike_id, rentals.rental_start, rentals.rental_end, rentals.price, bikes.image
        FROM rentals
        JOIN bikes ON rentals.bike_id = bikes.id";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Manage Bookings</h2>
    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bike ID</th>
                    <th>Rental Start</th>
                    <th>Rental End</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                        <td><?php echo htmlspecialchars($row['bike_id']); ?></td>
                        <td><?php echo htmlspecialchars($row['rental_start']); ?></td>
                        <td><?php echo htmlspecialchars($row['rental_end']); ?></td>
                        <td><?php echo htmlspecialchars($row['price']); ?></td>
                        <td><img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Bike Image" width="100"></td>
                        <td>
                            <a href="update_booking.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="delete_booking.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="text-center">No bookings found.</p>
    <?php endif; ?>
</div>

<?php
?>
