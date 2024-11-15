<?php
session_start();
include './Config/config.php';

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    function checkLogin($connection, $table, $username_column, $password_column, $username, $password) {
        $stmt = $connection->prepare("SELECT * FROM $table WHERE $username_column=?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user[$password_column])) {
                return $user;
            } else {
                return 'Password salah!';
            }
        }
        return false;
    }

    $loginResult = checkLogin($connection, 'Admin', 'username', 'password', $username, $password); 
    if (is_array($loginResult)) {
        $_SESSION['user'] = $loginResult;
        header("Location: dashboard.php");
        exit();
    } elseif ($loginResult === 'Password salah!') {
        $error = 'Password atau username untuk Admin!';
        
    } else {
        $loginResult = checkLogin($connection, 'Mahasiswa', 'username', 'password', $username, $password);
        if (is_array($loginResult)) { 
            $_SESSION['user'] = $loginResult;
            header("Location: dashboard.php");
            exit();
        } elseif ($loginResult === 'Password salah!') {
            $error = 'Password salah untuk Mahasiswa!';
        } else {
            $error = 'Username tidak ditemukan!';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Assets/Styles/login_view.css">
</head>
<body>

<div class="container">
    <!-- Splash Image Section -->
    <div class="splash-section">
        
    </div>
    
    <!-- Login Form Section -->
    <div class="form-section">
        <h2>Welcome Back!</h2>
        <p>Please enter your details to sign in.</p>
        
        <?php if ($error): ?>
            <div class="error-message">
                <strong>Error:</strong> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Your e-mail goes here" required>
            
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Your password goes here" required>

            <button type="submit">SIGN IN</button>
            
            <a href="register.php">Don't have an account? Register here</a>
        </form>
    </div>
</div>

</body>
</html>
