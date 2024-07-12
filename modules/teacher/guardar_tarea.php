<?php
// Configuración de la base de datos
$servername = "18.217.140.227"; // Host de MySQL
$username = "admin_xyz"; // Usuario de MySQL
$password = "colegio_xyz"; // Contraseña de MySQL
$database = "colegio_xyz"; // Nombre de la base de datos
$tabla_tareas = "subir_tareas"; // Nombre correcto de la tabla de tareas

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $fecha_entrega = $_POST['fecha_entrega'];

    // Preparar consulta SQL para insertar la tarea en la base de datos
    $sql = "INSERT INTO $tabla_tareas (titulo, descripcion, fecha_entrega) 
            VALUES ('$titulo', '$descripcion', '$fecha_entrega')";

    // Ejecutar consulta y verificar
    if ($conn->query($sql) === TRUE) {
        // Redirigir de vuelta a la página de subir_tareas.php
        header('Location: tarea_profe.php');
        exit;
    } else {
        echo "Error al subir la tarea: " . $conn->error;
    }
}

// Cerrar conexión a la base de datos
$conn->close();
?>
