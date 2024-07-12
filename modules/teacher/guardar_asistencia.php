<?php
// Iniciar sesión si no está iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Datos de conexión a la base de datos
$servername = "18.217.140.227";
$username = "admin_xyz";
$password = "colegio_xyz";
$database = "colegio_xyz";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$titulo = $_POST['titulo'];
$descripcion = $_POST['descripcion'];
$fecha_entrega = $_POST['fecha_entrega'];

// Aquí debes insertar los datos en tu base de datos
// Preparar la consulta SQL (ejemplo)
$sql = "INSERT INTO tareas (titulo, descripcion, fecha_entrega) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $titulo, $descripcion, $fecha_entrega);

// Ejecutar la consulta
if ($stmt->execute()) {
    // Redirigir a la página de tareas (tarea_profe.php) después de insertar
    header("Location: tarea_profe.php");
    exit(); // Asegurar que el script termine aquí para evitar más salida
} else {
    echo "Error al guardar la tarea: " . $stmt->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
