<?php
require_once 'db.php';

$id = 4;

$query = $con->prepare("DELETE FROM users WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();

if ($query->error) {
    echo "Error: " . $query->error;
} else {
    echo "Success";
}
?>