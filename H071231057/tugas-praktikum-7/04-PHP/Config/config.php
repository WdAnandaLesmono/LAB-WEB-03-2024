


<?php
/*
$host = "localhost";
$user = "root";
$pass = "";
$db = "mahasiswa_bio";

$connection = mysqli_connect($host, $user, $pass, $db);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully"; */
?> 

<!-- database mahasiswa_bio -->

<?php

$host = getenv('DB_HOST') ?: 'localhost';
$user = getenv('DB_USER') ?: 'root';
$pass = getenv('DB_PASS') ?: '';
$db = getenv('DB_NAME') ?: 'mahasiswa_bio';

$connection = mysqli_connect($host, $user, $pass, $db);

if (!$connection) {
    die("Koneksi ke database GAGAL: " . mysqli_connect_error());
}

mysqli_set_charset($connection, 'utf8');