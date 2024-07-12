<?php
$host = '18.217.140.227';
$db = 'colegio_xyz';
$user = 'admin_xyz';
$pass = 'colegio_xyz';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    echo "ERROR";
    die("Connection failed: " . $conn->connect_error);
}
?>
