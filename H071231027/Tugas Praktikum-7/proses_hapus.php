<?php
include 'conn.php';

$id = $_GET['id'];

$query = $conn->prepare("DELETE FROM users WHERE id = ?");
$query->bind_param('i', $id);

if ($query->execute()) {
    header("Location: dashboard.php");
} else {
    echo 'Error: ' . $query->error;
}
?>