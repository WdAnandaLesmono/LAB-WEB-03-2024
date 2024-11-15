<?php
session_start();
include './config/config.php';

$errors = [];
$success = false;

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = 'mahasiswa';
    
    if (empty($username)) {
        $errors[] = "Username tidak boleh kosong";
    } elseif (strlen($username) < 4) {
        $errors[] = "Username minimal memiliki 4 huruf";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $errors[] = "Username sudah digunakan";
        }
    }

    if (empty($password)) {
        $errors[] = "Password tidak boleh kosong";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password minimal memiliki 6 kata";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Password yang anda masukkan salah";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $hashed_password, $role);
        
        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = "Terjadi kesalahan saat registrasi. Tolong ulang lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Oxford University</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styleregister.css">

</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="logo-univ" id="fluid">
                <img src="./assets/img/logo-harvard.png" alt="">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center mb-0">Sign Up</h4>
                    </div>
                    <div class="card-body">
                        <?php if ($success): ?>
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>
                                Registration Successful!!! Please log in again. 
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i>
                                <ul>
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>

                        <?php if (!$success): ?>
                            <div class="embe-duk">
                                <form method="POST" action="" class="needs-validation" novalidate>
                                    <div class="embe">
                                        <label for="username" class="form-label">
                                            <i class="fas fa-user me-2"></i>Username
                                        </label>
                                        <input type="text" class="form-control" id="username" name="username" 
                                            value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                                            required minlength="4" placeholder="Username">
                                        <div class="password-requirements">
                                            <i class="fas fa-info-circle me-1"></i>Username must have at least 4 words
                                        </div>
                                    </div>
                                    
                                    <div class="embe">
                                        <label for="password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Password
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" 
                                                required minlength="6" placeholder="Password">
                                            <span class="input-group-text password-toggle" onclick="togglePassword()" id="mata">
                                                <i class="far fa-eye" id="toggleIcon"></i>
                                            </span>
                                        </div>
                                        <div class="password-requirements">
                                            <i class="fas fa-info-circle me-1"></i>Username must have at least 6 words
                                        </div>
                                    </div>
    
                                    <div class="embe">
                                        <label for="confirm_password" class="form-label">
                                            <i class="fas fa-lock me-2"></i>Confirm Password
                                        </label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password" 
                                                name="confirm_password" required placeholder="Confirm Your Password">
                                            <span class="input-group-text password-toggle" onclick="toggleConfirmPassword()" id="mata">
                                                <i class="far fa-eye" id="toggleConfirmIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                    
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-user-plus me-2"></i>Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        <?php endif; ?>
                        
                        <div class="mt-4 text-center">
                            <p class="mb-0">Already Have an Account? 
                                <a href="login.php" class="login-link">
                                    <i class="fas fa-sign-in-alt me-1"></i>Login Here!</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
    (function () {
        'use strict';
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
    })();

    document.getElementById('confirm_password').addEventListener('input', function () {
        if (this.value !== document.getElementById('password').value) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });

    document.getElementById('password').addEventListener('input', function () {
        var confirmPassword = document.getElementById('confirm_password');
        if (confirmPassword.value !== '') {
            if (this.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity('Passwords do not match');
            } else {
                confirmPassword.setCustomValidity('');
            }
        }
    });

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

        function toggleConfirmPassword() {
            const confirmPasswordInput = document.getElementById('confirm_password');
            const toggleConfirmIcon = document.getElementById('toggleConfirmIcon');
        
        if (confirmPasswordInput.type === 'password') {
            confirmPasswordInput.type = 'text';
            toggleConfirmIcon.classList.remove('fa-eye');
            toggleConfirmIcon.classList.add('fa-eye-slash');
        } else {
            confirmPasswordInput.type = 'password';
            toggleConfirmIcon.classList.remove('fa-eye-slash');
            toggleConfirmIcon.classList.add('fa-eye');
        }
    }
    </script>
</body>
</html>