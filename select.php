<?php
require_once 'db.php';

$result = $con->query("SELECT * FROM users");

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['id']} - Name: {$row['fname']} {$row['lname']} - Age: {$row['age']}<br>";
    }
} else {
    echo "No data found";
}
?>