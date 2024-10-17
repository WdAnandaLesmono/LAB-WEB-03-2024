<?php
session_start();

// Data users
$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'adminxxx',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'MIPA',
        'batch' => '2021',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'batch' => '2021',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'batch' => '2021',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'batch' => '2020',
    ],
    [
        'email' => 'kevinardana12@gmail.com',
        'username' => 'kevinardana12',
        'name' => 'Kevin Ardhana',
        'password' => password_hash('123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'MIPA',
        'batch' => '2023',
    ]
];

// Jika form login di-submit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['usernameOrEmail'];
    $password = $_POST['password'];
    $_SESSION['islogin'] = false; 
    foreach ($users as $user) {
        if (($user['username'] === $usernameOrEmail || $user['email'] === $usernameOrEmail) && password_verify($password, $user['password'])) {
            // Login sukses, simpan data user ke sesi
            $_SESSION['user'] = $user;
            // Redirect ke dashboard
            header('Location: dashboard.php');
            $_SESSION['islogin'] = true;
            exit();
        }
    }
    $error = "Username/Email atau Password salah!";
    
}

if (isset($_SESSION['islogin']) && $_SESSION['islogin'] === true) {
    header('Location: dashboard.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1E1E2F;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            overflow: hidden;
        }
        .login-container {
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .login-container h1 {
            font-size: 48px;
            margin-bottom: 30px;
        }
        .form-control {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #FFFFFF;
            border-radius: 0;
            color: #FFFFFF;
            margin-bottom: 20px;
        }
        .form-control::placeholder {
            color: #FFFFFF;
        }
        .btn-login {
            background-color: #3A3AFF;
            border: none;
            color: #FFFFFF;
            padding: 10px 20px;
            text-transform: uppercase;
            width: 100%;
        }
        .btn-login:hover {
            background-color: #3333FF;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
        .background-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .background-shapes .shape1 {
            position: absolute;
            top: 10%;
            left: -10%;
            width: 50%;
            height: 50%;
            background-color: #3A3AFF;
            border-radius: 50%;
        }
        .background-shapes .shape2 {
            position: absolute;
            top: 5%;
            left: 5%;
            width: 5%;
            height: 5%;
            background-color: #00BFFF;
            border-radius: 50%;
        }
        .background-shapes .shape3 {
            position: absolute;
            top: 10%;
            right: 0;
            width: 20%;
            height: 20%;
            background-color: #3A3AFF;
            clip-path: polygon(0 0, 100% 0, 0 100%);
        }
        .background-shapes .shape4 {
            position: absolute;
            bottom: 10%;
            right: 10%;
            width: 20%;
            height: 20%;
            background-color: #3A3AFF;
            clip-path: polygon(0 0, 100% 0, 50% 100%);
        }
    </style>
</head>
<body>
<div class="login-container">
    <h1>Login</h1>
    <?php if (isset($error)): ?>
        <div class="error-message"><?= $error ?></div>
    <?php endif; ?>
    <form method="POST">
        <input type="text" name="usernameOrEmail" class="form-control" placeholder="Username or Email" required>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" class="btn btn-login">Login</button>
    </form>
</div>
<div class="background-shapes">
    <div class="shape1"></div>
    <div class="shape2"></div>
    <div class="shape3"></div>
    <div class="shape4"></div>
</div>
</body>
</html>
