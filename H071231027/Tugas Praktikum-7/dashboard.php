<?php
session_start();
include 'conn.php';


if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['is_login']) || ($_SESSION['is_login'] !== true )) {
    header('location: index.php');
}

$limit = 6;
$page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$search = isset($_GET['search']) ? $_GET['search'] : '';

$totalQuery = "SELECT COUNT(*) AS total FROM users WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' OR prodi LIKE '%$search%'";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalData = $totalRow['total'];

$totalPages = ceil($totalData / $limit);

$query = "SELECT * FROM users WHERE nama LIKE '%$search%' OR nim LIKE '%$search%' OR prodi LIKE '%$search%' LIMIT $limit OFFSET $offset";
$user = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="admin-wrapper">
        <div class="header-container">
            <h1>Welcome <?= $_SESSION['nama']?></h1>
            <form action="dashboard.php" method="GET" class="search-form">
                <input type="text" name="search" placeholder="Cari Mahasiswa" value="<?= htmlspecialchars($search) ?>">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Prodi</th>
                    <th class="action-column-header"></th>
                    <th class="action-column-header"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $user->fetch_assoc()) {
                    $nama = $row["nama"];
                    $nim = $row["nim"];
                    $id = $row["id"];
                    $prodi = $row["prodi"];
                    ?>
                    <tr>
                        <td><?= $nama ?></td>
                        <td><?= $nim ?></td>
                        <td><?= $prodi ?></td>
                        <td class="action-column">
                            <a href="edit.php?id=<?= $id ?>" class="btn btn-edit">Edit</a>
                        </td>
                        <td class="action-column">
                            <a href="proses_hapus.php?id=<?= $id ?>" class="btn btn-delete">Hapus</a>
                        </td>


                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="tambah.php" class="btn btn-success" style="width:200px;">Tambah Data Mahasiswa</a>
    <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= $search ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= $search ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
        <a href="logout.php" class="btn btn-logout mb-4">Logout</a>

    </div>
</body>

</html>