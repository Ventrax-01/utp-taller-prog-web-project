<?php
session_start();

$servername = "18.217.140.227"; // Host del servidor
$username = "admin_xyz"; // Nombre de usuario de MySQL
$password = "colegio_xyz"; // Contraseña de MySQL
$database = "colegio_xyz"; // Nombre de la base de datos
$port = 3306; // Puerto de conexión MySQL (generalmente es 3306 por defecto)

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database, $port);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $formUsername = $_POST['username'];
    $formPassword = $_POST['password'];

    $sql = "SELECT id, username, password FROM user_profe WHERE username = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }
    
    $stmt->bind_param("s", $formUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        if ($formPassword == $row['password']) {
            $_SESSION['profesor_id'] = $row['id'];
            $_SESSION['username_profesor'] = $row['username'];
            header('Location: index.php'); // Redirigir a index.php después de iniciar sesión
            exit();
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal del Profesor - Inicio de Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('fondo.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .card-header {
            text-align: center;
        }
        .login-form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card login-form">
                <div class="card-header">
                    <h1>Inicio de Sesión</h1>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php elseif (isset($_GET['success'])): ?>
                        <div class="alert alert-success"><?php echo htmlspecialchars($_GET['success']); ?></div>
                    <?php endif; ?>
                    <form action="login.php" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" name="login">Iniciar Sesión</button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a href="register.php" class="btn btn-success w-100">Crear Usuario</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>