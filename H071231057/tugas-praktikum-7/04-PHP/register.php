<?php
session_start();
include './Config/config.php';

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}

$error = '';
$successMessage = '';

// Handle user registration
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'register') {
    // Ambil data dari form registrasi
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    // Ambil data dari sesi (data yang ditambahkan di modal)
    $name = $_SESSION['add_data']['name'] ?? '';
    $gender = $_SESSION['add_data']['gender'] ?? '';
    $major = $_SESSION['add_data']['major'] ?? '';
    $faculty = $_SESSION['add_data']['faculty'] ?? '';
    $hobby = $_SESSION['add_data']['hobby'] ?? '';

    // Cek apakah username sudah ada
    $query = "SELECT * FROM mahasiswa WHERE username='$username'";
    $result = $connection->query($query);

    if ($result->num_rows > 0) {
        $error = 'Username sudah terdaftar!';
    } else {
        // Insert into Mahasiswa table
        $query = "INSERT INTO mahasiswa (username, password, name, gender, major, faculty, hobby) 
                  VALUES ('$username', '$password', '$name', '$gender', '$major', '$faculty', '$hobby')";
        if ($connection->query($query) === TRUE) {
            // Kosongkan data di sesi setelah registrasi berhasil
            unset($_SESSION['add_data']);
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            $error = "Terjadi kesalahan: " . $connection->error;
        }
    }
}

// Handle add data
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'add') {
    // Menyimpan data di sesi saat tombol "Save" ditekan
    $_SESSION['add_data'] = [
        'name' => $_POST['name'],
        'gender' => $_POST['gender'],
        'major' => $_POST['major'],
        'faculty' => $_POST['faculty'],
        'hobby' => $_POST['hobby']
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Assets/Styles/register_view.css">
</head>
<body>
<div class="container">
    <!-- Splash Image Section -->
    <div class="splash-section">
        <span></span>
    </div>
    
    <!-- Form Section -->
    <div class="form-section">
        <h2 class="text-2xl font-bold mb-4 text-gray-800 text-center">Register</h2>
        <?php if ($error): ?>
            <div class="bg-red-100 text-red-600 p-3 rounded mb-4"><?= $error ?></div>
        <?php endif; ?>
        <?php if ($successMessage): ?>
            <div class="bg-green-100 text-green-600 p-3 rounded mb-4"><?= $successMessage ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Username</label>
                <input type="text" name="username" required class="input-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" required class="input-field shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" name="action" value="register" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Register
                </button>

                <button id="addDataBtn" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline ml-2">
                    Add Data
                </button>
            </div>
            <p class="mt-4 text-sm text-gray-600">Already have an account? <a href="login.php" class="text-blue-500 hover:underline">Login here</a></p>
        </form>
    </div>
</div>

<!-- Add Data Modal (Outside Container) -->
<div id="mahasiswaModal">
    <div class="modal-content">
        <h2 class="modal-header">Add Data Diri</h2>
        <form id="mahasiswaForm" method="POST">
            <input type="hidden" name="action" value="add">
            <div class="mb-4">
                <label for="name" class="block mb-2">Name:</label>
                <input type="text" name="name" id="name" class="input-field border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="gender" class="block mb-2">Gender:</label>
                <select name="gender" id="gender" class="input-field border border-gray-300 p-2 w-full rounded" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="major" class="block mb-2">Major:</label>
                <input type="text" name="major" id="major" class="input-field border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="faculty" class="block mb-2">Faculty:</label>
                <input type="text" name="faculty" id="faculty" class="input-field border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div class="mb-4">
                <label for="hobby" class="block mb-2">Hobby:</label>
                <input type="text" name="hobby" id="hobby" class="input-field border border-gray-300 p-2 w-full rounded" required>
            </div>
            <div class="flex justify-end">
                <button type="button" id="closeModal" class="cancel-button py-2 px-4 rounded-lg mr-2">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Save</button>
            </div>
        </form>
    </div>
</div>

<script src="Assets/js/modal_data_register.js"></script>
</body>
</html>

