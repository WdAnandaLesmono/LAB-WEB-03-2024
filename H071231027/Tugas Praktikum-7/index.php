<?php
session_start();
include 'conn.php';

if (isset($_SESSION['is_login']) && $_SESSION['is_login'] == true){
    header('location: dashboard.php');
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];

    $query = "SELECT * FROM users WHERE LOWER(nama) = LOWER(?) AND LOWER(nim) = LOWER(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ss', $nama, $nim);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['user'] = $user;
        $_SESSION['nama'] = $nama;
        $_SESSION['is_login'] = true; 

        if ($user['role'] == 'admin') {
            header('Location: dashboard.php');
        } else {
            header('Location: user_dashboard.php'); 
        }
        exit();   
    } else {
        $error = "NIM atau Nama tidak sesuai.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> 
</head>
<body>
    <div class="wrapper">
        <h1>Login</h1>
        <form action="index.php" method="POST">
            <div class="input-box">
                <input type="text" name="nama" placeholder="Nama Lengkap" required>
                <i class="fas fa-user"></i> 
            </div>
            <div class="input-box">
                <input type="text" name="nim" placeholder="NIM" required>
                <i class="fas fa-id-badge"></i> 
            </div>
            <button type="submit" class="btn">Login</button>
            <button type="button" class="btn mt-3" onclick="window.location.href='register.php'">Register</button>
        </form>
        <?php if (isset($error)) { echo "<p class='text-danger mt-3'>$error</p>"; } ?>
    </div>
</body>
</html>

