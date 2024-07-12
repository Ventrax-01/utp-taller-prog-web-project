<?php
session_start();
session_unset();
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once MAIN_PATH . '/db.php';
    
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];
    $sql = "SELECT user_id, contrasena, user_type FROM usuario WHERE correo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($contrasena == $row['contrasena']) {  // Comparar directamente en texto plano
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_type'] = $row['user_type'];
            switch ($row['user_type']) {
                case 'alumno':
                    $sql = "SELECT id, nombre, grado, user_id FROM alumnos WHERE user_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $_SESSION['user_id']);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $row = $result->fetch_assoc();
                    $_SESSION['alumno_id'] = $row['id'];
                    $_SESSION['nombre_alumno'] = $row['nombre'];
                    echo "<script> location.href='/modules/student/index.php'; </script>";
                    break;
                case 'profesor':
                    echo "<script> location.href='/modules/teacher/index.php'; </script>";
                    break;
                case 'admin':
                    echo "<script> location.href='/modules/administrator/index.html'; </script>";
                    break;
                default:
                    $error = "Tipo de usuario no válido.";
            }
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="login.php" class="card p-4">
                    <h2 class="text-center">Iniciar Sesión</h2>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo:</label>
                        <input type="email" id="correo" name="correo" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasena" class="form-label">Contraseña:</label>
                        <input type="password" id="contrasena" name="contrasena" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
