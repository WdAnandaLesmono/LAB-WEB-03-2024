<?php
session_start();
include 'conn.php';

// Periksa apakah user yang login adalah admin
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: login.php');
    exit();
}

// Inisialisasi pesan sukses dan error
$successMessage = "";
$errorMessage = "";

// Proses data ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $prodi = $_POST['prodi'];
    $role = $_POST['role'];

    // Validasi form
    if (empty($nama) || empty($nim) || empty($prodi) || empty($role)) {
        $errorMessage = "Semua kolom wajib diisi!";
    } else {
        // Query untuk memasukkan data ke database
        $stmt = $conn->prepare("INSERT INTO users (nama, nim, prodi, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nama, $nim, $prodi, $role);

        if ($stmt->execute()) {
            $successMessage = "Data mahasiswa berhasil ditambahkan!";
        } else {
            $errorMessage = "Terjadi kesalahan saat menambah data.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="edit-wrapper">
        <h1>Tambah Data Mahasiswa</h1>

        <!-- Tampilkan pesan sukses atau error -->
        <?php if ($successMessage): ?>
            <div class="alert alert-success"><?= $successMessage ?></div>
        <?php elseif ($errorMessage): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>

        <!-- Form tambah data mahasiswa -->
        <form action="tambah.php" method="POST">
            <div class="input-box">
                <label for="nama">Nama Lengkap :</label>
                <input type="text" name="nama" required>
            </div>
            <div class="input-box">
                <label for="nim">NIM :</label>
                <input type="text" name="nim" required>
            </div>
            <div class="input-box">
                <label for="prodi">Program Studi :</label>
                <input type="text" name="prodi" required>
            </div>
            <div class="input-box">
                <select name="role" class="form-select" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <i class="fas fa-user-tag"></i>
            </div>
            <button type="submit" class="btn btn-primary">Tambah Data</button>
            <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</body>
</html>
