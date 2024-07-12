<?php
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script> location.href='/modules/auth/login.php'; </script>";
    exit();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'admin') {
    echo "<script> location.href='/modules/auth/login.php'; </script>";
    exit();
}

/* require_once 'controllerAlumno.php';
$controller = new ControllerAlumno();

$cursos = $controller->getCursos($_SESSION['alumno_id']);
$notas = $controller->getNotas($_SESSION['alumno_id']);
$tareas = $controller->getTareas($_SESSION['alumno_id']);
$horario = $controller->getHorario($_SESSION['alumno_id']); */
?>