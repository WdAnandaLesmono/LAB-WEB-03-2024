<?php
session_start();
include './config/config.php';

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST['add'])) {
    if ($_SESSION['role'] == 'admin') {
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];

        $query = "INSERT INTO mahasiswa (name, nim, prodi) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $nim, $prodi);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student Data Successfully Added";
        } else {
            $_SESSION['message'] = "An Error Occurred In Adding Data";
        }
        header("Location: index.php");
        exit();
    }
}

if (isset($_POST['update'])) {
    if ($_SESSION['role'] == 'admin') {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $nim = $_POST['nim'];
        $prodi = $_POST['prodi'];

        $query = "UPDATE mahasiswa SET name = ?, nim = ?, prodi = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $nim, $prodi, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student Data Updated Successfully";
        } else {
            $_SESSION['message'] = "Failed to Update Student Data";
        }
        header("Location: index.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    if ($_SESSION['role'] == 'admin') {
        $id = $_GET['delete'];

        $query = "DELETE FROM mahasiswa WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student data successfully deleted";
        } else {
            $_SESSION['message'] = "Failed to delete student data";
        }
        header("Location: index.php");
        exit();
    }
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search != '') {
    $query = "SELECT * FROM mahasiswa WHERE name LIKE ? OR nim LIKE ? OR prodi LIKE ? ORDER BY id ASC";
    $search_term = "%$search%";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT * FROM mahasiswa ORDER BY id ASC";
    $result = $conn->query($query);
}

if (!$result) {
    die("Error: " . $conn->error);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University of Indonesia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleindex.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top no-print">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./assets/img/Harvard_University_shield.png" alt="Logo"><p>Harvard University</p></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <span class="nav-link welcome-badge" id="role-desc">
                            <i class="fas fa-user me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['username']); ?> 
                            (<?php echo htmlspecialchars($_SESSION['role']); ?>)
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout" onclick="return confirm('Are you sure want to logout?')">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container-fluid" id="fluid">
            <div class="top2">
                <p class="pesatu">Educate The Citizens <br> and Citizens Leaders <br>For Our Society</p>
                <p style="font-size: 30px; margin-top: -10px; margin-left: 5px;"> <i>Veritas Aequitas</i></p>
            </div>
            <div class="container-fluid">
                <div class="grid-container">
                    <div class="grid-item fs-6" id="item-1-1">
                        Our Top Picks
                    </div>
                    <div class="grid-item" id="item-1-2">
                        <img src="./assets/img/harvard-3.jpeg" alt="">
                    </div>
                    <div class="grid-item fs-6" id="item-1-3">
                    Verity 
                    </div>
                    <div class="grid-item" id="item-2-1">
                        <img src="./assets/img/harvard-6.jpeg" alt="">
                    </div>
                    <div class="grid-item fs-6" id="item-2-2">
                    Truth 
                    </div>
                    <div class="grid-item" id="item-2-3"></div>
                    <div class="grid-item" id="item-3-1"></div>
                    <div class="grid-item" id="item-3-2"></div>
                    <div class="grid-item" id="item-3-3">
                        <img src="./assets/img/harvard-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container-two my-5">
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible fade show no-print" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="title-two">
            <p>Students Information</p>
            <div class="GeneralHeading__Line3"></div>
        </div>
        <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="card mb-5 no-print" id="satu">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-user-plus me-2"></i>Add Students Data</h5>
            </div>
            <div class="card-body">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="nim" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukkan NIM" required>
                    </div>
                    <div class="mb-3">
                        <label for="prodi" class="form-label">Study Program</label>
                        <input type="text" class="form-control" id="prodi" name="prodi" placeholder="Masukkan Program Studi" required>
                    </div>
                    <button type="submit" name="add" class="btn btn-primary">
                        <i class="fas fa-plus-circle me-2"></i>Add Data</button>
                </form>
            </div>
        </div>

        <?php endif; ?>

        <div class="card" id="dua">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    <i class="fas fa-list me-2"></i>Students Data</h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover" id="studentTable">
                        <thead>
                            <tr>
                                <th class="px-4">No</th>
                                <th>name</th>
                                <th>Student Number</th>
                                <th>Study Program</th>
                                <?php if ($_SESSION['role'] == 'admin'): ?>
                                <th class="px-4 text-center no-print">Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="px-4"><?= $no++ ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= htmlspecialchars($row['nim']) ?></td>
                                <td><?= htmlspecialchars($row['prodi']) ?></td>
                                <?php if ($_SESSION['role'] == 'admin'): ?>
                                <td class="px-4 text-center no-print">
                                    <div class="action-buttons justify-content-center">
                                        <button type="button" class="btn btn-warning btn-action" 
                                                data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-danger btn-action"
                                        onclick="return confirm('Are you sure you want to delete this data?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    welcome-badge 
    <?php 
    if ($_SESSION['role'] == 'admin'):
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()):
    ?>
    <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-edit me-2"></i>Edit Student Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <div class="mb-3">
                        <label for="edit_name<?= $row['id'] ?>" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_name<?= $row['id'] ?>" 
                            name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nim<?= $row['id'] ?>" class="form-label">Student Number</label>
                        <input type="text" class="form-control" id="edit_nim<?= $row['id'] ?>" 
                            name="nim" value="<?= htmlspecialchars($row['nim']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_prodi<?= $row['id'] ?>" class="form-label">Study Program</label>
                        <input type="text" class="form-control" id="edit_prodi<?= $row['id'] ?>" 
                            name="prodi" value="<?= htmlspecialchars($row['prodi']) ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Change
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
    <?php 
        endwhile;
    endif; 
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>