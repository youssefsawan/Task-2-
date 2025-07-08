<?php
require_once 'db.php';

$username = $_POST['username'];
$age = $_POST['age'];

$sql = $con->prepare("UPDATE users SET age = ? WHERE username = ?");
$sql->bind_param("ds", $age, $username);

if ($sql->execute()) {
    if ($sql->affected_rows > 0) {
        echo "User updated successfully!";
    } else {
        echo "No user found with that username.";
    }
} else {
    echo "Error updating user: " . $sql->error;
}
?>