<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];

    $query = $con->prepare("INSERT INTO users (fname, lname, age) VALUES (?, ?, ?)");
    $query->bind_param("ssd", $fname, $lname, $age);
    $query->execute();

    if ($query->error) {
        echo "Error: " . $query->error;
    } else {
        header("Location: index.php");
        exit;
    }
}
?>