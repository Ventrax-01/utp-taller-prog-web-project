<?php
session_start();


if (!isset($_SESSION['students'])) {
    $_SESSION['students'] = [
        ["Sofía Martínez", "Presente", "Ausente", "Presente"],
        ["Juan Rodríguez", "Presente", "Presente", "Ausente"],
        ["Ana Pérez", "Ausente", "Presente", "Presente"],
        ["Carlos López", "Presente", "Presente", "Presente"],
        ["Marta García", "Presente", "Presente", "Presente"],
        ["Pablo Fernández", "Ausente", "Ausente", "Ausente"],
        ["Laura González", "Presente", "Ausente", "Presente"],
        ["David Sánchez", "Ausente", "Presente", "Presente"],
        ["María López", "Presente", "Ausente", "Presente"],
        ["Lucía Martínez", "Presente", "Presente", "Presente"],
    ];
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_student = [
        $_POST['student_name'],
        $_POST['math_status'],
        $_POST['science_status'],
        $_POST['history_status']
    ];
    $_SESSION['students'][] = $new_student;
}
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
            text-align: center;
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
        nav {
            background-color: black;
            color: white;
            padding: 10px;
            text-align: center;
        }
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        nav ul li a {
            color: white;
            text-decoration: none;
        }
        section {
            padding: 20px;
            text-align: center;
            position: relative;
            margin-bottom: 60px; /* Added margin to prevent footer overlap */
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
        .add-student-form {
            margin-top: 20px;
            text-align: left;
        }
        .add-student-form .form-group {
            margin-bottom: 15px;
        }
        .add-student-form .form-group label {
            font-weight: bold;
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
        <li><a href="calificaciones.php"><i class="fas fa-clipboard-check"></i> Calificaciones</a></li>
        <li><a href="asistencia.php"><i class="fas fa-user-check"></i> Asistencia</a></li>
        <li><a href="#"><i class="fas fa-tasks"></i> Tareas</a></li>
        <li><a href="#"><i class="fas fa-chalkboard"></i> Aulas</a></li>
        <li><a href="https://www.utp.edu.pe/web/"><i class="fas fa-address-book"></i> Contacto</a></li>
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
                        <th>Ciencias</th>
                        <th>Historia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Mostrar la lista de estudiantes
                    foreach ($_SESSION['students'] as $student) {
                        echo "<tr>";
                        echo "<td>" . $student[0] . "</td>";
                        for ($i = 1; $i < count($student); $i++) {
                            echo "<td>" . $student[$i] . "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="add-student-form">
            <h3>Agregar Registro de Asistencia</h3>
            <form method="post" action="">
                <div class="form-group">
                    <label for="student_name">Nombre del Estudiante</label>
                    <input type="text" class="form-control" id="student_name" name="student_name" required>
                </div>
                <div class="form-group">
                    <label for="math_status">Puntualidad de Matemáticas</label>
                    <select class="form-control" id="math_status" name="math_status" required>
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="science_status">Puntualidad de Ciencias</label>
                    <select class="form-control" id="science_status" name="science_status" required>
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="history_status">Puntualidad de Historia</label>
                    <select class="form-control" id="history_status" name="history_status" required>
                        <option value="Presente">Presente</option>
                        <option value="Ausente">Ausente</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Registro</button>
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

