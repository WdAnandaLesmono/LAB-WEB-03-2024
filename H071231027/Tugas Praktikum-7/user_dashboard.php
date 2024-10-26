<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'user') {
    header('Location: index.php');
    exit();
}


if (!isset($_SESSION['is_login']) || ($_SESSION['is_login'] !== true )) {
    header('location: index.php');
}

$limit = 7; 
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';
$search_query = $search ? "AND (nama LIKE '%$search%' OR nim LIKE '%$search%' OR prodi LIKE '%$search%')" : '';

$total_query = "SELECT COUNT(*) as total FROM users WHERE role = 'user' $search_query";
$total_result = $conn->query($total_query);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);

$query = "SELECT nama, nim, prodi FROM users WHERE role = 'user' $search_query ORDER BY prodi DESC, nim LIMIT $start, $limit";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css"> <!-- Linking the CSS -->
</head>
<body>
    <div class="container mt-5 user-wrapper">
        <div class="header-container">
            <h2>Welcome <?= $_SESSION['nama']?></h2>
            <form method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cari Mahasiswa" value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nama'] . "</td>";
                        echo "<td>" . $row['nim'] . "</td>";
                        echo "<td>" . $row['prodi'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3' class='text-center'>Tidak ada data</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <nav>
            <ul class="pagination">
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>&search=<?php echo $search; ?>">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </nav>
    
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>
</body>
</html>