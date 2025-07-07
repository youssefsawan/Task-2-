<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUD - Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">User Management</h2>

        <!-- Add User Form -->
        <form action="insert.php" method="POST" class="card p-4 shadow-sm">
            <div class="mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" class="form-control" name="fname" required>
            </div>
            <div class="mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="lname" required>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" step="0.01" class="form-control" name="age" required>
            </div>
            <button type="submit" class="btn btn-primary">Add User</button>
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
                    require_once 'db.php';
                    $result = $con->query("SELECT * FROM users");
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['fname']}</td>
                                <td>{$row['lname']}</td>
                                <td>{$row['age']}</td>
                                <td>
                                    <a href='edit.php?id={$row['id']}' class='btn btn-sm btn-warning'>Edit</a>
                                    <a href='delete.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm("Are you sure?")'>Delete</a>
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
