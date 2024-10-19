<?php
require_once 'config.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    
    $user = authenticate($email_or_username, $password);
    
    if ($user) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Invalid email/username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .login-container {
            background-color: white;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4285f4;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #357ae8;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .register-link {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>LOGIN</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
        <form method="POST">
            <label for="email_or_username">Email or Username</label>
            <input type="text" id="email_or_username" name="email_or_username" required>
            
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Submit">
        </form>
        <div class="register-link">
            <a href="#">Don't have an account? Register here.</a>
        </div>
    </div>
</body>
</html>