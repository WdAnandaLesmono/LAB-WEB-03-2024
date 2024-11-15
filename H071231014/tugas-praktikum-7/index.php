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
        $studyProgram = $_POST['studyProgram'];

        $query = "INSERT INTO students (name, nim, studyProgram) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $name, $nim, $studyProgram);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student data successfully added";
        } else {
            $_SESSION['message'] = "Failed to add student data";
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
        $studyProgram = $_POST['studyProgram'];

        $query = "UPDATE students SET name=?, nim=?, studyProgram=? WHERE id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sssi", $name, $nim, $studyProgram, $id);

        if ($stmt->execute()) {
            $_SESSION['message'] = "Student data successfully updated";
        } else {
            $_SESSION['message'] = "Failed to update student data";
        }
        header("Location: index.php");
        exit();
    }
}

if (isset($_GET['delete'])) {
    if ($_SESSION['role'] == 'admin') {
        $id = $_GET['delete'];

        $query = "DELETE FROM students WHERE id=?";
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
    $query = "SELECT * FROM students WHERE name LIKE ? OR nim LIKE ? OR studyProgram LIKE ? ORDER BY id ASC";
    $search_term = "%$search%";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $search_term, $search_term, $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $query = "SELECT * FROM students ORDER BY id ASC";
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
    <title>Universitas Hasanuddin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>        
        body {
            background-image: linear-gradient(to top, #ff00008c, #ff000000 75%), url(assets/img/Background-unhas.jpeg);
            background-size: cover;
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background-color: #C41E3A;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }
        
        .card {
            border: none;
            border-radius: 25px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.30), 0 6px 6px rgba(0, 0, 0, 0.33);
            border: 2px solid #ff00008c;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            margin-bottom: 32px;
        }
        
        .card-header {
            background-color: #C41E3A;
            border-radius: 22px 22px 0 0 !important;
            border-bottom: none;
            padding: 24px;
        }
        
        .card-title {
            color: #FEF9F2;
            font-weight: 600;
            margin: 0;
        }
        
        .btn-primary {
            background: #C41E3A;
            border: none;
            color: #1C1C1C;
            font-weight: 600;
            padding: 9.6px 24px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: #C41E3A;
            color: #1C1C1C;
            transform: translateY(-2px);
        }

        .btn-warning {
            background: #f0ad4e;
            border: none;
            color: white;
        }

        .btn-danger {
            background: #dc3545;
            border: none;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead th {
            background-color: rgba(255, 0, 14, 0.8);
            color: #1C1C1C;
            font-weight: 600;
            border-bottom: 2px solid #ff00008c;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            background-color: rgba(25, 135, 84, 0.9);
            color: white;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #ff00008c;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 3px #ff00008c;
            border-color: #ff00008c;
        }
        
        .modal-content {
            border-radius: 25px;
            border: 2px solid #ff00008c;
        }
        
        .modal-header {
            background-color: #1C1C1C;
            border-radius: 22px 22px 0 0;
            border-bottom: none;
        }

        .modal-title {
            color: #ff00008c;
        }
        
        .welcome-badge {
            background: rgba(253, 181, 21, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            color: #FDB515;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            color: #ff00008c;
        }
        
        .btn-action {
            padding: 6.4px 16px;
            border-radius: 10px;
        }

        .search-bar {
            max-width: 300px;
            margin-bottom: 16px;
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top no-print">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="./assets/img/Logo-unhas.png" alt="Unhas Logo">Universitas Hasanuddin Student Data</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <span class="nav-link welcome-badge">
                            <i class="fas fa-user me-2"></i>
                            <?php echo htmlspecialchars($_SESSION['username']); ?> 
                            (<?php echo htmlspecialchars($_SESSION['role']); ?>)
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?action=logout" onclick="return confirm('Are you sure you want to logout?')">
                            <i class="fas fa-sign-out-alt me-1"></i>Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container my-5">
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

        <?php if ($_SESSION['role'] == 'admin'): ?>
        <div class="card mb-5 no-print">
            <div class="card-header">
                <h5 class="card-title">
                    <i class="fas fa-user-plus me-2"></i>Add Student Data</h5>
            </div>
            <div class="card-body p-4">
                <form action="" method="POST" class="row g-3">
                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                    </div>
                    <div class="col-md-4">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="Enter NIM" required>
                    </div>
                    <div class="col-md-4">
                        <label for="studyProgram" class="form-label">Study Program</label>
                        <input type="text" class="form-control" id="studyProgram" name="studyProgram" placeholder="Enter Study Program" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" name="add" class="btn btn-primary">
                            <i class="fas fa-plus-circle me-2"></i>Add Data</button>
                    </div>
                </form>
            </div>
        </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title">
                    <i class="fas fa-list me-2"></i>Student Data</h5>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover" id="studentTable">
                        <thead>
                            <tr>
                                <th class="px-4">No</th>
                                <th>Name</th>
                                <th>NIM</th>
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
                                <td><?= htmlspecialchars($row['studyProgram']) ?></td>
                                <?php if ($_SESSION['role'] == 'admin'): ?>
                                <td class="px-4 text-center no-print">
                                    <div class="action-buttons justify-content-center">
                                        <button type="button" class="btn btn-warning btn-action" 
                                                data-bs-toggle="modal" data-bs-target="#editModal<?= $row['id'] ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="?delete=<?= $row['id'] ?>" 
                                           class="btn btn-danger btn-action"
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
                        <label for="edit_name<?= $row['id'] ?>" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name<?= $row['id'] ?>" 
                               name="name" value="<?= htmlspecialchars($row['name']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_nim<?= $row['id'] ?>" class="form-label">NIM</label>
                        <input type="text" class="form-control" id="edit_nim<?= $row['id'] ?>" 
                               name="nim" value="<?= htmlspecialchars($row['nim']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_studyProgram<?= $row['id'] ?>" class="form-label">Study Program</label>
                        <input type="text" class="form-control" id="edit_studyProgram<?= $row['id'] ?>" 
                               name="studyProgram" value="<?= htmlspecialchars($row['studyProgram']) ?>" required>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Save Changes
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