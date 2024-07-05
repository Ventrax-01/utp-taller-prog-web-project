<?php
$host = '127.0.0.1';
$db = 'colegio_xyz';
$user = 'root';
$pass = 'admin';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
