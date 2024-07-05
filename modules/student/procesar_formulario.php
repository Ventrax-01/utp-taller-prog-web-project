<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $alumno_id = $_POST['alumno_id'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];
    $curso_id = $_POST['curso_id'];

    $sql = "INSERT INTO tareas (alumno_id, curso_id, descripcion, fecha_entrega) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $alumno_id, $curso_id, $descripcion, $fecha_entrega);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit();
    } else {
        echo "Error al agregar la tarea: " . $stmt->error;
    }
}
?>
