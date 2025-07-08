<?php
require_once 'db.php';

$username = $_POST['username'];
$age = $_POST['age'];

$sql = $con->prepare("INSERT INTO users (username, age) VALUES (?, ?)");
$sql->bind_param("sd", $username, $age);

if ($sql->execute()) {
    echo "User inserted successfully!";
} else {
    echo "Error inserting user: " . $sql->error;
}
?>