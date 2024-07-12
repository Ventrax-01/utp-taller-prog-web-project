<?php
session_start();

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

// Consulta SQL para obtener los datos de asistencia
$sql = "SELECT * FROM asistencia";
$result = $conn->query($sql);

// Variable para almacenar los datos de los estudiantes
$students = [];

if ($result->num_rows > 0) {
    // Iterar sobre los resultados y almacenarlos en un array
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
} else {
    echo "No se encontraron registros de asistencia.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal del Profesor - Colegio XYZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            /* Establecer fondo */
            background-image: url('fondo21.jpg');
            background-size: cover; /* Ajuste para cubrir el área completa */
            background-position: center;
            background-repeat: no-repeat;
        }
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: #fe9187;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .header-container h1 {
            margin: 0;
            color: black;
            text-align: right;
            flex: 1;
        }
        .menu-toggle-container {
            margin-right: 20px;
        }
        .menu-toggle {
            background-color: #fe9187;
            border: 2px solid black;
            font-size: 20px;
            color: black;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .menu-toggle:hover {
            background-color: #ffbfab;
        }
        .menu-toggle.active {
            transform: rotate(90deg);
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            height: 100%;
            width: 250px;
            background-color: #333;
            padding: 20px;
            overflow-y: auto;
            z-index: 1000;
            transition: left 0.3s ease;
        }
        .sidebar-header {
            font-weight: bold;
            color: white;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .student-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .student-list table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .student-list th, .student-list td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        .student-list th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .student-list td {
            text-align: center;
        }
        .bajo {
            background-color: #fe9187;
            color: black;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body>

<div class="header-container">
    <div class="menu-toggle-container">
        <button id="menu-toggle" class="menu-toggle">☰</button>
    </div>
    <h1>Portal del Profesor</h1>
</div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">MENU</div>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="Cursos.php"><i class="fas fa-book"></i> Cursos</a></li>
        <li><a href="calificaiones.php"><i class="fas fa-clipboard-check"></i> Calificaciones</a></li>
        <li><a href="asistencia.php"><i class="fas fa-user-check"></i> Asistencia</a></li>
        <li><a href="tarea_profe.php"><i class="fas fa-tasks"></i> Tareas</a></li>
        <li><a href="aula.php"><i class="fas fa-chalkboard"></i> Aulas</a></li>
        
    </ul>
</div>

<section>
    <div class="container">
        <h2>Asistencia de Alumnos</h2>

        <div class="student-list">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre del Estudiante</th>
                        <th>Matemáticas</th>
                        <th>Química</th>
                        <th>Historia</th>
                        <th>Geografía</th>
                        <th>Lenguaje</th>
                        <th>Biología</th>
                        <th>Psicología</th>
                        <th>Arte</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($students as $student): ?>
                        <tr>
                            <td><?php echo $student['nombre']; ?></td>
                            <td><?php echo $student['matematicas']; ?></td>
                            <td><?php echo $student['quimica']; ?></td>
                            <td><?php echo $student['historia']; ?></td>
                            <td><?php echo $student['geografia']; ?></td>
                            <td><?php echo $student['lenguaje']; ?></td>
                            <td><?php echo $student['biologia']; ?></td>
                            <td><?php echo $student['psicologia']; ?></td>
                            <td><?php echo $student['arte']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Agregar el nuevo formulario aquí -->
        <div class="mt-4">
            <h3>Registrar Asistencia</h3>
            <form action="guardar_asistencia.php" method="POST">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre del Estudiante</label>
                    <select class="form-select" id="nombre" name="nombre" required>
                        <?php foreach ($students as $student): ?>
                            <option value="<?php echo $student['nombre']; ?>"><?php echo $student['nombre']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="curso" class="form-label">Seleccionar Curso</label>
                    <select class="form-select" id="curso" name="curso" required>
                        <option value="matematicas">Matemáticas</option>
                        <option value="quimica">Química</option>
                        <option value="historia">Historia</option>
                        <option value="geografia">Geografía</option>
                        <option value="lenguaje">Lenguaje</option>
                        <option value="biologia">Biología</option>
                        <option value="psicologia">Psicología</option>
                        <option value="arte">Arte</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="asistencia" class="form-label">Ingresar Asistencia (Presente o Falto)</label>
                    <select class="form-select" id="asistencia" name="asistencia" required>
                        <option value="Presente">Presente</option>
                        <option value="Falto">Falto</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
            </form>
        </div>
    </div>
</section>


<div class="bajo">
    <h3>Todos los derechos reservados</h3>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.style.left = sidebar.style.left === '0px' ? '-250px' : '0px';
        this.classList.toggle('active');
    });

    document.addEventListener('click', function(event) {
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menu-toggle');
        const target = event.target;

        if (!sidebar.contains(target) && target !== menuToggle) {
            sidebar.style.left = '-250px';
            menuToggle.classList.remove('active');
        }
    });
</script>

</body>
</html>
