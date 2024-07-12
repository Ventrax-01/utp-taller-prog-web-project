<?php
// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "18.217.140.227"; // Nombre del servidor
    $username = "admin_xyz"; // Nombre de usuario de MySQL
    $password = "colegio_xyz"; // Contraseña de MySQL
    $database = "colegio_xyz"; // Nombre de la base de datos

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Obtener los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $curso = $_POST['curso'];
    $nota = $_POST['nota'];

    // Query para obtener el ID del estudiante
    $sql_id = "SELECT id FROM calificaciones WHERE nombre = ?";
    $stmt_id = $conn->prepare($sql_id);
    $stmt_id->bind_param("s", $nombre);
    $stmt_id->execute();
    $result_id = $stmt_id->get_result();

    if ($result_id->num_rows > 0) {
        $row_id = $result_id->fetch_assoc();
        $id = $row_id['id'];

        // Actualizar la nota en la base de datos
        $sql_update = "UPDATE calificaciones SET $curso = ? WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("di", $nota, $id);
        if ($stmt_update->execute()) {
            // Redireccionar de vuelta a la página de calificaciones después de actualizar
            header('Location: calificaiones.php');
            exit;
        } else {
            echo "Error al actualizar la nota: " . $conn->error;
        }
    } else {
        echo "No se encontró el estudiante.";
    }

    // Cerrar consultas preparadas y conexión
    $stmt_id->close();
    $stmt_update->close();
    $conn->close();
} else {
    echo "Acceso no autorizado.";
}
?>