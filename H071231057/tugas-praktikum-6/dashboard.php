<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}

// if (isset($_SESSION['user'])) {
//     header('Location: dashboard.php');
//     exit();
// }

$user = $_SESSION['user'];
$is_admin = $user['username'] === 'adminxxx';


// Data pengguna
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
</head>
<body class="bg-gradient-to-r from-purple-100 to-blue-200 min-h-screen">

    <div class="container mx-auto p-20">
        <!-- Welcome container -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600">Dashboard</h1>
            <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition">Logout</a>
        </div>

        <!-- Welcome section -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6 hover:bg-gray-100 transition duration-300 ease-in-out">
            <h2 class="text-2xl font-semibold text-black-700">Welcome, <?= htmlspecialchars($user['name']) ?>!</h2>
            <p class="text-gray-600">You are logged in as <span class="font-bold"><?= htmlspecialchars($is_admin ? 'Admin' : 'User') ?></span>.</p>
            <?php if ($is_admin): ?>
                <div class="mt-4">
                    <p class="text-gray-600">Admin Email: <span class="font-bold"><?= htmlspecialchars($users[0]['email']) ?></span></p>
                    <p class="text-gray-600">Admin Username: <span class="font-bold"><?= htmlspecialchars($users[0]['username']) ?></span></p>
                </div>
            <?php else: ?>
                <div class="mt-4">
                    <p class="text-gray-600">Your Email: <span class="font-bold"><?= htmlspecialchars($user['email']) ?></span></p>
                    <p class="text-gray-600">Your Username: <span class="font-bold"><?= htmlspecialchars($user['username']) ?></span></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- All users container -->
        <div class="bg-white p-6 rounded-lg shadow-lg hover:bg-gray-100 transition duration-300 ease-in-out">
            <h3 class="text-xl font-bold text-gray-700 mb-4"><?= $is_admin ? 'All Users' : 'Your Information' ?></h3>

            <!-- Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-400">
                <thead>
                    <tr>
                        <th class="border-2 border-gray-500 px-4 py-2 text-gray-600">Email</th>
                        <th class="border-2 border-gray-500 px-4 py-2 text-gray-600">Username</th>
                        <th class="border-2 border-gray-500 px-4 py-2 text-gray-600">Name</th>
                        <th class="border-2 border-gray-500 px-4 py-2 text-gray-600">Gender</th>
                        <th class="border-2 border-gray-500 px-4 py-2 text-gray-600">Faculty</th>
                        <th class="border-2 border-gray-500 px-4 py-2 text-gray-600">Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($is_admin): ?>
                        <?php foreach ($users as $user_data): ?>
                            <?php if ($user_data['username'] !== 'adminxxx'): ?> <!-- Filter out admin data -->
                                <tr class="hover:bg-blue-100 transition duration-200 ease-in-out">
                                    <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user_data['email']) ?></td>
                                    <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user_data['username']) ?></td>
                                    <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user_data['name']) ?></td>
                                    <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user_data['gender'] ?? '-') ?></td>
                                    <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user_data['faculty'] ?? '-') ?></td>
                                    <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user_data['batch'] ?? '-') ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr class="hover:bg-blue-100 transition duration-200 ease-in-out">
                            <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user['email']) ?></td>
                            <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user['username']) ?></td>
                            <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user['name']) ?></td>
                            <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user['gender'] ?? '-') ?></td>
                            <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user['faculty'] ?? '-') ?></td>
                            <td class="border-2 border-gray-500 px-4 py-2 text-center"><?= htmlspecialchars($user['batch'] ?? '-') ?></td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
