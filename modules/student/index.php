<?php
session_start();
if (!isset($_SESSION['alumno_id'])) {
    echo "<script> location.href='login.php'; </script>";
    exit();
}

require_once 'controllerAlumno.php';
$controller = new ControllerAlumno();

$cursos = $controller->getCursos($_SESSION['alumno_id']);
$notas = $controller->getNotas($_SESSION['alumno_id']);
$tareas = $controller->getTareas($_SESSION['alumno_id']);
$horario = $controller->getHorario($_SESSION['alumno_id']);
?>

<html>
    <head>
    </head>
    <body>
        asdasd
    </body>
</html>