<?php
session_start();

if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}

$users = [
    [
        'email' => 'admin@gmail.com',
        'username' => 'admin',
        'name' => 'Admin',
        'password' => password_hash('admin123', PASSWORD_DEFAULT),
    ],
    [
        'email' => 'musliati11@gmail.com',
        'username' => 'velvet.all',
        'name' => 'Musliati',
        'password' => password_hash('alyacantik', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'birth' => '11/01/2005',
        'faculty' => 'MIPA',
        'major' => 'Information System',
        'nim' => 'H071231014',
        'batch' => '2023',
        'photo_url' => 'assets/img/Profil-Alyah.JPG',
    ],
    [
        'email' => 'rreska9@gmail.com',
        'username' => 'rzkaaa.08',
        'name' => 'Rezka Wildan',
        'password' => password_hash('tampandanpemberani', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'birth' => '08/11/2005',
        'faculty' => 'MIPA',
        'major' => 'Information System',
        'nim' => 'H071231030',
        'batch' => '2023',
        'photo_url' => 'assets/img/Profil-Rezka.JPG',
    ],
    [
        'email' => 'sucizaitun19@gmail.com',
        'username' => 'sucicomel',
        'name' => 'Suci Zaitun Nurkamal',
        'password' => password_hash('suci123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'birth' => '01/02/2006',
        'faculty' => 'MIPA',
        'major' => 'Information System',
        'nim' => 'H071231019',
        'batch' => '2023',
        'photo_url' => 'assets/img/Profil-Suci.JPG',
    ],
    [
        'email' => 'farah19@gmail.com',
        'username' => 'jack.ely',
        'name' => 'Fara Rahmasari Fahirun',
        'password' => password_hash('fara123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'birth' => '30/01/2005',
        'faculty' => 'MIPA',
        'major' => 'Information System',
        'nim' => 'H071231055',
        'batch' => '2023',
        'photo_url' => 'assets/img/Profil-Fara.jpg',
    ],
    [
        'email' => 'athifah10@gmail.com',
        'username' => 'atfhnr_',
        'name' => 'Athifah Nur Rahman MD.',
        'password' => password_hash('athifa123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'birth' => '19/02/2005',
        'faculty' => 'MIPA',
        'major' => 'Information System',
        'nim' => 'H071231016',
        'batch' => '2023',
        'photo_url' => 'assets/img/Profil-Athifa.JPG',
    ],
    [
        'email' => 'nanda@gmail.com',
        'username' => 'nanda_aja',
        'name' => 'Wd. Ananda Lesmono',
        'password' => password_hash('nanda123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'birth' => '01/01/2004',
        'faculty' => 'MIPA',
        'major' => 'Information System',
        'nim' => 'H071211074',
        'batch' => '2021',
        'photo_url' => 'assets/img/Profil-Nanda.png',
    ],
    [
        'email' => 'arif@gmail.com',
        'username' => 'arif_nich',
        'name' => 'Muhammad Arief',
        'password' => password_hash('arief123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Hukum',
        'major' => 'Ilmu Hukum',
        'batch' => '2021',
        'photo_url' => 'assets/img/default-avatar.png',
    ],
    [
        'email' => 'eka@gmail.com',
        'username' => 'eka59',
        'name' => 'Eka Hanny',
        'password' => password_hash('eka123', PASSWORD_DEFAULT),
        'gender' => 'Female',
        'faculty' => 'Keperawatan',
        'major' => 'Ilmu Keperawatan',
        'batch' => '2021',
        'photo_url' => 'assets/img/default-avatar.png',
    ],
    [
        'email' => 'adnan@gmail.com',
        'username' => 'adnan72',
        'name' => 'Adnan',
        'password' => password_hash('adnan123', PASSWORD_DEFAULT),
        'gender' => 'Male',
        'faculty' => 'Teknik',
        'major' => 'Teknik Informatika',
        'batch' => '2020',
        'photo_url' => 'assets/img/default-avatar.png',
    ],
];

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    foreach ($users as $user) {
        if (($user['email'] == $login || $user['username'] == $login) && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: dashboard.php");
            exit();
        }
    }

    $error = "Invalid login credentials";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #F7B5CA, #F0A8D0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border: none;
            border-radius: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #F0A8D0;
            color: white;
            padding: 20px;
        }
        .card-body {
            padding: 30px;
        }
        .btn-primary {
            background-color: #F0A8D0;
            border-color: #F0A8D0;
        }
        .btn-primary:hover {
            background-color: #F7B5CA;
            border-color: #F7B5CA;
        }
        .form-control:focus {
            border-color: #C62E2E;
            box-shadow: 0 0 0 0.2rem rgba(198, 46, 46, 0.25);
        }
        .logo {
            max-width: 100px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="assets/img/Logo-Pink.webp"  class="logo">
                        <h3>Login Member Facial</h3>
                    </div>
                    <div class="card-body">
                        <?php if ($error): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="post">
                            <div class="mb-3">
                                <label for="login" class="form-label">Email or Username</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="login" name="login" required>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="mb-3 text-center">
                                <a href="register.php" class="text-decoration-none">Don't have an account? Register here</a>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);

            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>