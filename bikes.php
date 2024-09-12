<?php
require 'db.php';

$sql = "SELECT * FROM bikes";
$result = mysqli_query($conn, $sql);

while ($bike = mysqli_fetch_assoc($result)) {
    echo $bike['model'] . ' - $' . $bike['price'] . '<br>';
}
?>
