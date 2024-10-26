<?php
session_start();
include 'conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];
    $role = $_POST['role'];
    $prodi = $_POST['prodi'];
    $_SESSION['nama'] = $nama;

    // Check if NIM already exists
    $query = "SELECT * FROM users WHERE LOWER(nim) = LOWER(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $error = "NIM sudah terdaftar. Silakan gunakan NIM yang lain.";
    } else {
        // Insert new user into database
        $query = "INSERT INTO users (nama, nim, role, prodi) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssss', $nama, $nim, $role, $prodi);
        
        if ($stmt->execute()) {
            $_SESSION['user'] = [
                'nama' => $nama,
                'nim' => $nim,
                'role' => $role,
                'prodi' => $prodi
            ];
            // Redirect based on role
            if ($role == 'admin') {
                header('Location: dashboard.php');
            } else {
                header('Location: user_dashboard.php');
            }
            exit();
        } else {
            $error = "Terjadi kesalahan saat mendaftarkan akun.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> 
</head>
<body>
    <div class="wrapper">
        <h1>Register</h1>
        <form action="register.php" method="POST">
            <div class="input-box">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
                <i class="fas fa-user"></i> 
            </div>
            <div class="input-box">
                <input type="text" name="nim" placeholder="NIM" required>
                <i class="fas fa-id-badge"></i> 
            </div>
            <div class="input-box">
                <input type="text" name="prodi" placeholder="Prodi" required>
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="input-box">
                <select name="role" class="form-select" required>
                    <option value="" disabled selected>Pilih Role</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <i class="fas fa-user-tag"></i>
            </div>
            <button type="submit" class="btn">Register</button>
        </form>
        <?php if (isset($error)) { echo "<p class='text-danger mt-3'>$error</p>"; } ?>
    </div>
</body>
</html>
