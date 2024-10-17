<?php
session_start();

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


if (!isset($_SESSION['islogin']) && $_SESSION['islogin'] !== true) {
    header('Location: login.php'); 
    exit();
}
$user = $_SESSION['user'];
$isAdmin = $user['username'] === 'adminxxx';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1E1E2F;
            color: #FFFFFF;
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        .card {
            background-color: #333;
            color : #FFFFFF; 
            border: none;
            margin-bottom: 20px;
        }
        .table-dark {
            color: #FFFFFF;
        }
    </style>
</head>
<body>
    <div class="container">
        
        <h1 class="text-center mb-4">Welcome, <?= $user['name'] ?>!</h1>
        <?php if ($isAdmin): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Name: <?= $user['name'] ?></h5>
                    <p>Email: <?= $user['email'] ?></p>
                </div>
            </div>
            <h1 class="text-center mb-4"><?= $isAdmin ? 'All Users' : 'My Profile' ?></h1>
            <table class="table tabel-dark table-striped">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Faculty</th>
                        <th>Batch</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['gender'] ?? 'N/A' ?></td>
                        <td><?= $user['faculty'] ?? 'N/A' ?></td>
                        <td><?= $user['batch'] ?? 'N/A' ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Name: <?= $user['name'] ?></h5>
                    <p>Email: <?= $user['email'] ?></p>
                    <p>Faculty: <?= $user['faculty'] ?></p>
                    <p>Batch: <?= $user['batch'] ?></p>
                </div>
            </div>
        <?php endif; ?>

        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
