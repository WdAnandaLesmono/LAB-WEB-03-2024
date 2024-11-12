<?php
session_start();
include './config/config.php';

function setupAdmin($conn) {       
    $check = $conn->query("SELECT * FROM users WHERE username = 'admin'");
    
    if ($check->num_rows == 0) {
        $admin_username = 'admin';
        $admin_password = 'admin123';
        $hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);
        $role = 'admin';
        
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $admin_username, $hashed_password, $role);
        $stmt->execute();
        
        return [
            'username' => $admin_username,
            'password' => $admin_password
        ];
    }
    return null;
}

$adminCreated = setupAdmin($conn);

if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$error = '';
$success = '';

if ($adminCreated) {
    $success = "User admin berhasil dibuat! Username: {$adminCreated['username']}, Password: {$adminCreated['password']}";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
   
    if(empty($username) || empty($password)) {
        $error = "Silakan isi username dan password";
    } else {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
       
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: index.php");
                exit();
            } else {
                $error = "Password salah!";
            }
        } else {
            $error = "Username tidak ditemukan!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Universitas Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-image: linear-gradient(to top, #ff00008c, #ff000000 75%), url(assets/img/Background-unhas.jpeg);
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: rgba(255, 255, 255, 0.3);
            border: none;
            border-radius: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.30), 0 6px 6px rgba(0, 0, 0, 0.33);
            backdrop-filter: blur(2px)
            border: 2px solid #FDB515;
        }

        .card-header {
            background: #ff00008c;
            border-radius: 22px 22px 0 0 !important;
            padding: 20px;
            text-align: center;
            backdrop-filter: blur(2px);
        }

        .unhas-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background: #C41E3A;
            border: none;
            padding: 12px;
            color: #1C1C1C;
            font-weight: bold;
        }

        .btn-primary:hover {
            background: #C41E3A;
            color: #1C1C1C;
            transform: translateY(-1px);
            box-shadow: 0 7px 14px rgba(0, 0, 0, 0.1), 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ced4da;
        }

        .form-control:focus {
            box-shadow: 0 0 0 3px #ff00008c;
            border-color: #ff00008c;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #6c757d;
            z-index: 10;
        }

        .alert {
            border-radius: 10px;
        }

        .register-link {
            color: #C41E3A;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link:hover {
            color: #ff80000;
            text-decoration: underline;
        }

        .animated {
            animation: fadeIn 0.5s ease-in;
        }

        .form-label {
            color: #1C1C1C;
            font-weight: 500;
        }

        @keyframes fadeOut {
            from { opacity: 1; transform: translateY(0); }
            to { opacity: 0; transform: translateY(0); }
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow animated">
                    <div class="card-header">
                        <img src="./assets/img/logo-unhas.png" alt="unhas Logo" class="unhas-logo">
                        <h4 class="card-title text-white text-center mb-0">UNIVERSITY HASANUDDIN</h4>
                    </div>
                    <div class="card-body p-4">
                        <?php if(!empty($error)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <?php if(!empty($success)): ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>
                                <?php echo $success; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                       
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-4">
                                <label for="username" class="form-label">
                                    <i class="fas fa-user me-2"></i>Username
                                </label>
                                <input type="text" class="form-control" id="username" name="username" 
                                       value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" 
                                       required placeholder="Enter username">
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    <i class="fas fa-lock me-2"></i>Password
                                </label>
                                <div class="password-container">
                                    <input type="password" class="form-control" id="password" name="password" 
                                           required placeholder="Enter password">
                                    <span class="password-toggle" onclick="togglePassword()">
                                        <i class="far fa-eye" id="toggleIcon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mb-4">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-sign-in-alt me-2"></i>Login</button>
                            </div>
                        </form>
                        <div class="text-center">
                            <p class="mb-0">Don't have an account?<a href="register.php" class="register-link">
                                    <i class="fas fa-user-plus me-1"></i>Register here</a>
                            </p>
                            <?php if($adminCreated): ?>
                            <div class="alert alert-info mt-3">
                                <small>
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Info:</strong> An admin account has been automatically created.<br>
                                    Use the above credentials to log in as an admin.
                                </small>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
