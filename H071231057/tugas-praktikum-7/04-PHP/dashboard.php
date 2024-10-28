<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

include './Config/config.php';
$user = $_SESSION['user'];
$is_admin = ($user['username'] === 'admin'); // Adjust admin username here

// Initialization for success and error messages
$success = "";
$error = "";

// Check for success and error messages
if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
if (isset($_GET['error'])) {
    $error = $_GET['error'];
}

// Handle CRUD operations for Mahasiswa (only admin can perform these operations)
if ($is_admin) {
    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
        $id = $_GET['id'];
        $connection->query("DELETE FROM Mahasiswa WHERE id='$id'");
        $success = "Successfully deleted the data.";
    }

    // Handle add/edit actions
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['action']) && $_POST['action'] == 'add') {
            // Add Mahasiswa
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $name = $_POST['name'];
            $gender = $_POST['gender']; // Pastikan ini ada
            $major = $_POST['major'];
            $faculty = $_POST['faculty'];
            $hobby = $_POST['hobby'];

            $connection->query("INSERT INTO Mahasiswa (username, password, name, gender, major, faculty, hobby) VALUES ('$username', '$password', '$name', '$gender', '$major', '$faculty', '$hobby')");
            $success = "Mahasiswa berhasil ditambahkan.";
        } elseif (isset($_POST['action']) && $_POST['action'] == 'edit' && isset($_POST['id'])) {
            // Edit Mahasiswa
            $id = $_POST['id'];
            $username = $_POST['username'];
            $name = $_POST['name'];
            $gender = $_POST['gender']; // Pastikan ini ada
            $major = $_POST['major'];
            $faculty = $_POST['faculty'];
            $hobby = $_POST['hobby'];
            
            // Check if password is provided
            if (!empty($_POST['password'])) {
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $connection->query("UPDATE Mahasiswa SET username='$username', password='$password', name='$name', gender='$gender', major='$major', faculty='$faculty', hobby='$hobby' WHERE id='$id'");
            } else {
                // Do not update the password if not provided
                $connection->query("UPDATE Mahasiswa SET username='$username', name='$name', gender='$gender', major='$major', faculty='$faculty', hobby='$hobby' WHERE id='$id'");
            }
            $success = "Mahasiswa berhasil diupdate.";
        }
    }
}

// Fetch Mahasiswa data
if ($is_admin) {
    // If admin, fetch all mahasiswa data
    $mahasiswaResult = $connection->query("SELECT * FROM Mahasiswa");
} else {
    // If user, fetch mahasiswa data based on their username
    $username = $user['username'];
    $mahasiswaResult = $connection->query("SELECT * FROM Mahasiswa WHERE username = '$username'");
}
$mahasiswaList = $mahasiswaResult->fetch_all(MYSQLI_ASSOC);

// For Edit
$editData = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $editData = $connection->query("SELECT * FROM Mahasiswa WHERE id='$id'")->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-purple-100 to-blue-200 min-h-screen">
    <div class="container mx-auto p-6 md:p-10 lg:p-20">
        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-blue-600 mb-4 md:mb-0">Dashboard</h1>
            <a href="logout.php" class="bg-red-500 text-white py-2 px-4 rounded-lg hover:bg-red-600 transition">Logout</a>
        </div>

        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <h2 class="text-2xl font-semibold text-black-700">Welcome, <?= htmlspecialchars($user['username']) ?>!</h2>
            <p class="text-gray-600">You are logged in as <span class="font-bold"><?= htmlspecialchars($is_admin ? 'Admin' : 'User') ?></span>.</p>
        </div>

        <!-- Display Mahasiswa List -->
        <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-700"><?= $is_admin ? 'Mahasiswa List' : 'Your Data' ?></h3>
                <?php if ($is_admin): ?>
                    <button id="addMahasiswaBtn" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600">Add Mahasiswa</button>
                <?php endif; ?>
            </div>

            <?php if ($success): ?>
                <div class="bg-green-100 text-green-800 p-3 rounded mb-4"><?= $success ?></div>
            <?php endif; ?>
            <?php if ($error): ?>
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4"><?= $error ?></div>
            <?php endif; ?>

            <!-- Responsive Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border text-left">ID</th>
                            <th class="py-2 px-4 border text-left">Username</th>
                            <th class="py-2 px-4 border text-left">Name</th>
                            <th class="py-2 px-4 border text-left">Gender</th>
                            <th class="py-2 px-4 border text-left">Major</th>
                            <th class="py-2 px-4 border text-left">Faculty</th>
                            <th class="py-2 px-4 border text-left">Hobby</th>
                            <?php if ($is_admin): ?>
                                <th class="py-2 px-4 border text-left">Actions</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$is_admin && count($mahasiswaList) == 0): ?>
                            <tr>
                                <td colspan="<?= $is_admin ? 8 : 7 ?>" class="text-center py-2">No data available.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($mahasiswaList as $mahasiswa): ?>
                                <tr>
                                    <td class="py-2 px-4 border"><?= $mahasiswa['id'] ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($mahasiswa['username']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($mahasiswa['name']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($mahasiswa['gender']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($mahasiswa['major']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($mahasiswa['faculty']) ?></td>
                                    <td class="py-2 px-4 border"><?= htmlspecialchars($mahasiswa['hobby']) ?></td>
                                    <?php if ($is_admin): ?>
                                        <td class="py-2 px-4 border flex justify-around space-x-2">
                                            <button class="editBtn bg-yellow-500 text-white py-1 px-2 rounded-lg hover:bg-yellow-600 transition" data-id="<?= $mahasiswa['id'] ?>" data-username="<?= htmlspecialchars($mahasiswa['username']) ?>" data-name="<?= htmlspecialchars($mahasiswa['name']) ?>" data-gender="<?= htmlspecialchars($mahasiswa['gender']) ?>" data-major="<?= htmlspecialchars($mahasiswa['major']) ?>" data-faculty="<?= htmlspecialchars($mahasiswa['faculty']) ?>" data-hobby="<?= htmlspecialchars($mahasiswa['hobby']) ?>">Edit</button>
                                            <a href="?action=delete&id=<?= $mahasiswa['id'] ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="bg-red-500 text-white py-1 px-2 rounded-lg hover:bg-red-600 transition">Delete</a>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add/Edit Mahasiswa Modal -->
    <div id="mahasiswaModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-3 rounded-lg shadow-lg w-full max-w-md"> <!-- Mengubah ukuran modal menjadi lebih kecil -->
            <h2 class="text-2xl font-semibold mb-4" id="modalTitle">Add Mahasiswa</h2>
            <form id="mahasiswaForm" method="POST">
                <input type="hidden" name="id" id="mahasiswaId">
                <input type="hidden" name="action" id="action" value="add">
                <div class="mb-4">
                    <label for="username" class="block mb-2">Username:</label>
                    <input type="text" name="username" id="username" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block mb-2">Password:</label>
                    <input type="password" name="password" id="password" class="border border-gray-300 p-2 w-full">
                    <small class="text-gray-500">Leave blank if you don't want to change the password</small>
                </div>
                <div class="mb-4">
                    <label for="name" class="block mb-2">Name:</label>
                    <input type="text" name="name" id="name" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="gender" class="block mb-2">Gender:</label>
                    <select name="gender" id="gender" class="border border-gray-300 p-2 w-full" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="major" class="block mb-2">Major:</label>
                    <input type="text" name="major" id="major" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="faculty" class="block mb-2">Faculty:</label>
                    <input type="text" name="faculty" id="faculty" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div class="mb-4">
                    <label for="hobby" class="block mb-2">Hobby:</label>
                    <input type="text" name="hobby" id="hobby" class="border border-gray-300 p-2 w-full" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" id="closeModal" class="bg-gray-300 text-gray-700 py-2 px-4 rounded-lg mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Open Add Mahasiswa Modal
        document.getElementById('addMahasiswaBtn').addEventListener('click', function() {
            document.getElementById('modalTitle').textContent = 'Add Mahasiswa';
            document.getElementById('mahasiswaForm').reset();
            document.getElementById('action').value = 'add';
            document.getElementById('mahasiswaId').value = '';
            document.getElementById('mahasiswaModal').classList.remove('hidden');
        });

        // Close Modal
        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('mahasiswaModal').classList.add('hidden');
        });

        // Open Edit Mahasiswa Modal
        document.querySelectorAll('.editBtn').forEach(function(button) {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const username = this.getAttribute('data-username');
                const name = this.getAttribute('data-name');
                const gender = this.getAttribute('data-gender');
                const major = this.getAttribute('data-major');
                const faculty = this.getAttribute('data-faculty');
                const hobby = this.getAttribute('data-hobby');

                document.getElementById('modalTitle').textContent = 'Edit Mahasiswa';
                document.getElementById('username').value = username;
                document.getElementById('name').value = name;
                document.getElementById('gender').value = gender;
                document.getElementById('major').value = major;
                document.getElementById('faculty').value = faculty;
                document.getElementById('hobby').value = hobby;
                document.getElementById('action').value = 'edit';
                document.getElementById('mahasiswaId').value = id;
                document.getElementById('mahasiswaModal').classList.remove('hidden');
            });
        });
    </script>
</body>
</html>
