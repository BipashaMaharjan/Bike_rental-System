<?php
// Database connection details
$host = 'localhost';
$database = 'Bike_Rental'; // Your existing database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone_number, message) VALUES (:name, :email, :phone_number, :message)");
        
        // Check if the query preparation is successful
        if (!$stmt) {
            // Get the SQL error and display it
            echo "SQL error: " . implode(", ", $conn->errorInfo());
        } else {
            // Bind form values
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':email', $_POST['email']);
            $stmt->bindParam(':phone_number', $_POST['phone_number']);
            $stmt->bindParam(':message', $_POST['message']);

            // Execute the query
            if ($stmt->execute()) {
                echo "Message sent successfully!";
            } else {
                echo "Error sending message.";
            }
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
