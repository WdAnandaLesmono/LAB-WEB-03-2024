<?php
include 'conn.php';

$id = $_GET['id'];
$query = "SELECT * FROM users WHERE id = $id";
$user = $conn->query($query);

$result = $user->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <div class="edit-wrapper">
        <h1>Edit Data</h1>
        <form action="proses_edit.php" method="POST">
            <div class="input-box">
                <label for="id">ID :</label>
                <input type="text" name="id" value="<?= $result['id'] ?>" readonly>
            </div>
            <div class="input-box">
                <label for="nama">Nama Lengkap :</label>
                <input type="text" name="nama" value="<?= $result['nama'] ?>" required>
            </div>
            <div class="input-box">
                <label for="nim">NIM :</label>
                <input type="text" name="nim" value="<?= $result['nim'] ?>" required>
            </div>
            <div class="input-box">
                <label for="prodi">Program Studi :</label>
                <input type="text" name="prodi" value="<?= $result['prodi'] ?>" required>
            </div>
            <button type="submit" class="btn">Kirim</button>
        </form>
    </div>
</body>
</html>

