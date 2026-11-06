<?php

$conn = new mysqli("localhost", "root", "", "smartmethods_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// إضافة مستخدم جديد
if (isset($_POST['submit'])) {

    $name = trim($_POST['name']);
    $age = (int) $_POST['age'];

    $stmt = $conn->prepare(
        "INSERT INTO users (name, age, status) VALUES (?, ?, 0)"
    );

    $stmt->bind_param("si", $name, $age);
    $stmt->execute();
    $stmt->close();

    // يمنع تكرار الإضافة عند تحديث الصفحة
    header("Location: index.php");
    exit;
}

// جلب جميع المستخدمين
$result = $conn->query("SELECT * FROM users ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Smart Methods - User Management</title>

    <link
        rel="stylesheet"
        href="style.css"
    >

</head>

<body>

<div class="container">

    <h1>User Management System</h1>

    <p class="subtitle">
        Smart Methods Training Project
    </p>

    <div class="form-card">

        <h2>Add User</h2>

        <form method="POST">

            <input
                type="text"
                name="name"
                placeholder="Name"
                required
            >

            <input
                type="number"
                name="age"
                placeholder="Age"
                min="1"
                required
            >

            <button
                type="submit"
                name="submit"
            >
                Submit
            </button>

        </form>

    </div>

    <div class="table-card">

        <h2>Users</h2>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

            <?php while ($row = $result->fetch_assoc()) { ?>

                <tr>

                    <td>
                        <?php echo $row['id']; ?>
                    </td>

                    <td>
                        <?php echo htmlspecialchars($row['name']); ?>
                    </td>

                    <td>
                        <?php echo $row['age']; ?>
                    </td>

                    <td>

                        <span
                            class="status status-<?php echo $row['status']; ?>"
                        >
                            <?php echo $row['status']; ?>
                        </span>

                    </td>

                    <td>

                        <button
                            type="button"
                            class="toggle-btn"
                            data-id="<?php echo $row['id']; ?>"
                        >
                            Toggle
                        </button>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<script src="script.js"></script>

</body>

</html>