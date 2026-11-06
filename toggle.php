<?php

$conn = new mysqli("localhost", "root", "", "smartmethods_db");

if ($conn->connect_error) {
    die("Connection failed");
}

if (isset($_POST['id'])) {

    $id = (int) $_POST['id'];

    $stmt = $conn->prepare(
        "UPDATE users
         SET status = 1 - status
         WHERE id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    $stmt = $conn->prepare(
        "SELECT status
         FROM users
         WHERE id = ?"
    );

    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    echo $row['status'];

    $stmt->close();
}

$conn->close();

?>