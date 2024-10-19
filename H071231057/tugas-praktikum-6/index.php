<?php
session_start();

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

// if (!isset($_SESSION['user'])) {
//     header('Location: index.php');
//     exit();
// }

// Data user
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
];

// Proses login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email_or_username = $_POST['email_or_username'];
    $password = $_POST['password'];
    $user_found = false;

    foreach ($users as $user) {
        // Cek jika email/username cocok
        if ($user['email'] === $email_or_username || $user['username'] === $email_or_username) {
            $user_found = true; // user found
            // Cek password
            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;
                header('Location: dashboard.php');
                exit;
            } else {
                $error = "Password salah.";
            }
            break; 
        }
    }

    // handling errorling
    if ($user_found && !isset($error)) {
        $error = "Password salah.";
    } elseif (!$user_found) {
        $error = "Email atau username salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/Style/percantik.css">
</head>

<body class="flex items-center justify-center min-h-screen">

    <div class="background">
        <!-- Bintang -->
        <div id="stars"></div>
    </div>

    <!-- Heading login page -->
    <h1 class="heading">Login Page</h1>

    <!-- Flex container for Lottie and Form -->
    <div class="flex-container w-full max-w-5xl p-8">
        <!-- Lottie Animation Container -->
        <div class="lottie-container bg-transparent rounded-l-lg">
            <div id="lottie-animation" class="image-container"></div>
        </div>

        <!-- Form Container -->
        <div class="form-container bg-white shadow-lg rounded-lg p-8 hover:shadow-xl transition-all duration-300 ease-in-out transform hover:scale-105">
            <h2 class="text-4xl font-bold text-blue-500 mb-6 text-center">Welcome Back!</h2>
            <?php if (isset($error)): ?>
                <p class="text-red-500 mb-4"><?= $error ?></p>
            <?php endif; ?>
            <form method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Email or Username</label>
                    <input type="text" name="email_or_username" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your email or username" required>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your password" required>
                </div>
                <div>
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition">Login</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.5/lottie.min.js"></script>
    <script src="Assets/js/star.js"></script>

</body>

</html>
