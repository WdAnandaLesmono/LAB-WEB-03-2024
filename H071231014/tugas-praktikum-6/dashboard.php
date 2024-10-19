<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$user = $_SESSION['user'];
$isAdmin = ($user['email'] == 'admin@gmail.com');

$adminProfile = [
    'email' => 'admin@gmail.com',
    'username' => 'admin',
    'name' => 'Administrator',
    'password' => password_hash('admin123', PASSWORD_DEFAULT),
    'gender' => 'N/A',
    'faculty' => 'Administration',
    'major' => 'System Management',
    'batch' => 'N/A',
    'photo_url' => 'assets/img/Logo-Pink.webp',
];

$users = [
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

function getPhotoUrl($user) {
    if (isset($user['photo_url']) && !empty($user['photo_url'])) {
        return $user['photo_url'];
    }
    return 'assets/img/default-avatar.png';
}

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Facial Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFACC7;
            min-height: 100vh;
        }
        .navbar {
            background-color: #F0A8D0;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            background-color: #F0A8D0;
            color: white;
            border-radius: 15px 15px 0 0;
        }
        .table {
            background-color: white;
        }
        .user-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border: 5px solid #F7B5CA;
        }
        .table-photo {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Dashboard Facial Member</a>
            <form method="post" class="d-flex">
                <button type="submit" name="logout" class="btn btn-outline-light"><i class="fas fa-sign-out-alt me-2"></i>Logout</button>
            </form>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="fas fa-user-circle me-2"></i>User Profile</h4>
                    </div>
                    <div class="card-body text-center">
                        <?php
                        $profileData = $isAdmin ? $adminProfile : $user;
                        $photoUrl = getPhotoUrl($profileData);
                        ?>
                        <img src="<?php echo htmlspecialchars($photoUrl); ?>" alt="User Photo" class="rounded-circle user-photo mb-3">
                        <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                        <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">
                            <?php if ($isAdmin): ?>
                                <i class="fas fa-users me-2"></i>All Users
                            <?php else: ?>
                                <i class="fas fa-info-circle me-2"></i>Your Information
                            <?php endif; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <?php if ($isAdmin): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Gender</th>
                                            <th>Birth</th>
                                            <th>Faculty</th>
                                            <th>Major</th>
                                            <th>NIM</th>
                                            <th>Batch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($users as $u): ?>
                                            <tr>
                                                <td><img src="<?php echo htmlspecialchars($u['photo_url']); ?>" alt="User Photo" class="rounded-circle table-photo"></td>
                                                <td><?php echo htmlspecialchars($u['name']); ?></td>
                                                <td><?php echo htmlspecialchars($u['email']); ?></td>
                                                <td><?php echo htmlspecialchars($u['username']); ?></td>
                                                <td><?php echo isset($u['gender']) ? htmlspecialchars($u['gender']) : 'N/A'; ?></td>
                                                <td><?php echo isset($u['birth']) ? htmlspecialchars($u['birth']) : 'N/A'; ?></td>
                                                <td><?php echo isset($u['faculty']) ? htmlspecialchars($u['faculty']) : 'N/A'; ?></td>
                                                <td><?php echo isset($u['major']) ? htmlspecialchars($u['major']) : 'N/A'; ?></td>
                                                <td><?php echo isset($u['nim']) ? htmlspecialchars($u['nim']) : 'N/A'; ?></td>
                                                <td><?php echo isset($u['batch']) ? htmlspecialchars($u['batch']) : 'N/A'; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Name :</strong> <?php echo htmlspecialchars($user['name']); ?></li>
                                <li class="list-group-item"><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></li>
                                <li class="list-group-item"><strong>Username :</strong> <?php echo htmlspecialchars($user['username']); ?></li>
                                <li class="list-group-item"><strong>Gender :</strong> <?php echo htmlspecialchars($user['gender']); ?></li>
                                <li class="list-group-item"><strong>Birth :</strong> <?php echo htmlspecialchars($user['birth']); ?></li>
                                <li class="list-group-item"><strong>Faculty :</strong> <?php echo htmlspecialchars($user['faculty']); ?></li>
                                <li class="list-group-item"><strong>Major :</strong> <?php echo htmlspecialchars($user['major']); ?></li>
                                <li class="list-group-item"><strong>NIM :</strong> <?php echo htmlspecialchars($user['nim']); ?></li>
                                <li class="list-group-item"><strong>Batch :</strong> <?php echo htmlspecialchars($user['batch']); ?></li>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>