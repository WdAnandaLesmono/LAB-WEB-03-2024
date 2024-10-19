<?php
require_once 'config.php';
require_login();

$current_user = $_SESSION['user'];
$is_admin = is_admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        h1 { margin-bottom: 20px; }
        .welcome { font-size: 24px; margin-bottom: 10px; }
        .user-info { margin-bottom: 20px; }
        .logout { background-color: #dc3545; color: white; padding: 10px 20px; text-decoration: none; display: inline-block; margin-top: 10px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Dashboard <?php echo $is_admin ? 'admin' : 'user'; ?></h1>

    <div class="welcome">Welcome, <?php echo htmlspecialchars($current_user['name']); ?>!</div>

    <div class="user-info">
        <p>Email: <?php echo htmlspecialchars($current_user['email']); ?></p>
        <p>Username: <?php echo htmlspecialchars($current_user['username']); ?></p>
        <?php if (!$is_admin): ?>
            <p>Gender: <?php echo htmlspecialchars($current_user['gender']); ?></p>
            <p>Faculty: <?php echo htmlspecialchars($current_user['faculty']); ?></p>
            <p>Batch: <?php echo htmlspecialchars($current_user['batch']); ?></p>
        <?php endif; ?>
    </div>

    <?php if ($is_admin): ?>
        <h2>All Users</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Gender</th>
                <th>Faculty</th>
                <th>Batch</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <?php if ($user['username'] !== 'adminxxx'): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($user['name']); ?></td>
                        <td><?php echo htmlspecialchars($user['email']); ?></td>
                        <td><?php echo htmlspecialchars($user['username']); ?></td>
                        <td><?php echo htmlspecialchars($user['gender']); ?></td>
                        <td><?php echo htmlspecialchars($user['faculty']); ?></td>
                        <td><?php echo htmlspecialchars($user['batch']); ?></td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <a href="logout.php" class="logout">Logout</a>
</body>
</html>