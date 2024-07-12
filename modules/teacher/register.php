<?php
session_start();

$servername = "18.217.140.227";
$username = "admin_xyz";
$password = "colegio_xyz";
$database = "colegio_xyz";
$port = 3306;

$conn = new mysqli($servername, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $newUsername = $_POST['new_username'];
    $newPassword = $_POST['new_password'];

    $sql = "INSERT INTO user_profe (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die('Error en la preparación de la consulta: ' . $conn->error);
    }

    $stmt->bind_param("ss", $newUsername, $newPassword);
    if ($stmt->execute()) {
        $successMessage = "Usuario registrado exitosamente.";
        header("Location: login.php?success=" . urlencode($successMessage));
        exit();
    } else {
        $error = "Error al registrar usuario: " . $stmt->error;
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
    <title>Registrar Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('fondo2.jpg') no-repeat center center fixed;
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
        .register-form {
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
            <div class="card register-form">
                <div class="card-header">
                    <h1>Registrar Usuario</h1>
                </div>
                <div class="card-body">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <form action="register.php" method="post">
                        <div class="mb-3">
                            <label for="new_username" class="form-label">Nuevo Usuario</label>
                            <input type="text" class="form-control" id="new_username" name="new_username" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">Nueva Contraseña</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100" name="register">Registrar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
