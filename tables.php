<?php

include 'db.php';
// SQL to create users table
// $sql = "CREATE TABLE IF NOT EXISTS users (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     username VARCHAR(50) NOT NULL UNIQUE,
//     email VARCHAR(100) NOT NULL UNIQUE,
//     password VARCHAR(255) NOT NULL,
//     role ENUM('admin', 'customer') DEFAULT 'customer'
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table 'users' created successfully\n";
// } else {
//     echo "Error creating 'users' table: " . $conn->error;
// }

// // SQL to create bikes table
// $sql = "CREATE TABLE IF NOT EXISTS bikes (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     name VARCHAR(100) NOT NULL,
//     type VARCHAR(50) NOT NULL,
//     price_per_hour DECIMAL(10, 2) NOT NULL,
//     image VARCHAR(255),
//     status ENUM('available', 'rented', 'maintenance') DEFAULT 'available'
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table 'bikes' created successfully\n";
// } else {
//     echo "Error creating 'bikes' table: " . $conn->error;
// }

// // SQL to create rentals table
// $sql = "CREATE TABLE IF NOT EXISTS rentals (
//     id INT AUTO_INCREMENT PRIMARY KEY,
//     user_id INT,
//     bike_id INT,
//     rental_start DATETIME,
//     rental_end DATETIME,
//     price DECIMAL(10, 2),
//     FOREIGN KEY (user_id) REFERENCES users(id),
//     FOREIGN KEY (bike_id) REFERENCES bikes(id)
// )";

// if ($conn->query($sql) === TRUE) {
//     echo "Table 'rentals' created successfully\n";
// } else {
//     echo "Error creating 'rentals' table: " . $conn->error;
// }

// Insert data into users table
// $sql = "INSERT INTO users (id, username, email, password, role) VALUES 
//     (1, 'John', 'john@example.com', '".password_hash('password123', PASSWORD_DEFAULT)."', 'customer'),
//     (2, 'admin_user', 'admin@example.com', '".password_hash('admin123', PASSWORD_DEFAULT)."', 'admin')";

// if ($conn->query($sql) === TRUE) {
//     echo "Records inserted into 'users' table successfully\n";
// } else {
//     echo "Error inserting records into 'users' table: " . $conn->error;
// }


// // Insert data into bikes table
// $sql = "INSERT INTO bikes (id, name, type, price_per_hour, image, status) VALUES 
//     -- (001, 'Xpulse', 'Adventure', 15.50, 'xpulse.jpg', 'available'),
// --             (003, 'Xblade', 'Normal', 213.50, 'Honda Xblade.png', 'available'),
// --     (004, 'Xpulse', 'Ride', 14.50, 'honda shine 125.svg', 'available'),
// --     (005, 'Xpulse', 'Adventure', 16.50, 'Honda Livo.png', 'available')
// -- // ";

// -- if ($conn->query($sql) === TRUE) {
// --     echo "Records inserted into 'bikes' table successfully\n";
// -- } else {
// --     echo "Error inserting records into 'bikes' table: " . $conn->error;
// -- }

// Close the connection


// Insert data into rentals table (user_id = 1, bike_id = 2)
// $rental_start = date('Y-m-d H:i:s'); // Current timestamp
// $rental_end = date('Y-m-d H:i:s', strtotime('+2 hours')); // Add 2 hours

// $sql = "INSERT INTO rentals (user_id, bike_id, rental_start, rental_end, price) VALUES 
//     (1, 2, '$rental_start', '$rental_end', 25.50)";

// if ($conn->query($sql) === TRUE) {
//     echo "Records inserted into 'rentals' table successfully\n";
// } else {
//     echo "Error inserting records into 'rentals' table: " . $conn->error;
// }

Fetch available bikes
$sql = "SELECT * FROM bikes WHERE status = 'available'";
$result = mysqli_query($conn, $sql);

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    // Output data for each row
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Bike Name: " . $row['name'] . "<br>";
        echo "Type: " . $row['type'] . "<br>";
        echo "Price per hour: $" . $row['price_per_hour'] . "<br><br>";
    }
} else {
    echo "No available bikes.";
}



// Close the connection
$conn->close();
?>






