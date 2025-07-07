<?php
require_once 'db.php';

// Insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];

    $query = $con->prepare("INSERT INTO users (fname, lname, age) VALUES (?, ?, ?)");
    $query->bind_param("ssd", $fname, $lname, $age);
    $query->execute();
    header("Location: index.php");
    exit;
}

// Update
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $age = $_POST['age'];

    $query = $con->prepare("UPDATE users SET fname=?, lname=?, age=? WHERE id=?");
    $query->bind_param("ssdi", $fname, $lname, $age, $id);
    $query->execute();
    header("Location: index.php");
    exit;
}

// Delete
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = $con->prepare("DELETE FROM users WHERE id=?");
    $query->bind_param("i", $id);
    $query->execute();
    header("Location: index.php");
    exit;
}

// Edit
$edit = false;
$user = ['id' => '', 'fname' => '', 'lname' => '', 'age' => ''];
if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];
    $result = $con->prepare("SELECT * FROM users WHERE id=?");
    $result->bind_param("i", $id);
    $result->execute();
    $res = $result->get_result();
    if ($res->num_rows > 0) {
        $user = $res->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - One Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">User Management</h2>

    <!-- Add / Edit Form -->
    <form method="POST" class="card p-4 shadow-sm">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">
        <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="fname" value="<?= $user['fname'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lname" value="<?= $user['lname'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Age</label>
            <input type="number" step="0.01" class="form-control" name="age" value="<?= $user['age'] ?>" required>
        </div>
        <?php if ($edit): ?>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        <?php else: ?>
            <button type="submit" name="add" class="btn btn-primary">Add User</button>
        <?php endif; ?>
    </form>

    <!-- Users Table -->
    <div class="mt-5">
        <h4>All Users</h4>
        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $con->query("SELECT * FROM users");
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['fname']}</td>
                            <td>{$row['lname']}</td>
                            <td>{$row['age']}</td>
                            <td>
                                <a href='?edit={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                <a href='?delete={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                            </td>
                          </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
