<?php
include 'conn.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $id = $_POST['id'];

    $query = $conn->prepare("UPDATE users SET nama = ?, nim = ?, prodi = ? WHERE id = ?");
    $query->bind_param('sssi', $nama, $nim, $prodi, $id);

    if ($query->execute()) {
        $_SESSION['nama'] = $nama;
        $_SESSION['nim'] = $nim;
        header('Location: dashboard.php');
    } else {
        echo "Error: " . $query->error;
    }
}
?>