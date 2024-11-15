<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "db_tuprak7";
$port = 3306;

$conn = mysqli_connect($host, $user, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>