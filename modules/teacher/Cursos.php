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
            order: 2;
            flex: 1;
            text-align: right;
        }
        .menu-toggle-container {
            margin-right: 20px;
            order: 1;
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
        }
        .bajo {
            background-color: #fe9187;
            color: black;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
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
        .course {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .course h3 {
            margin-top: 0;
        }s
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
        <li><a href="#"><i class="fas fa-tasks"></i> Tareas</a></li>
        <li><a href="#"><i class="fas fa-chalkboard"></i> Aulas</a></li>
        <li><a href="https://www.utp.edu.pe/web/"><i class="fas fa-address-book"></i> Contacto</a></li>
    </ul>
</div>

<section>
    <div class="container">
        <h2>Cursos Disponibles</h2>
        <div class="course">
            <h3>Matemáticas</h3>
            <p>Descripción del curso de matemáticas. Aquí los profesores pueden gestionar las asignaciones, notas y más.</p>
        </div>
        <div class="course">
            <h3>Ciencias</h3>
            <p>Descripción del curso de ciencias. Aquí los profesores pueden gestionar las asignaciones, notas y más.</p>
        </div>
        <div class="course">
            <h3>Historia</h3>
            <p>Descripción del curso de historia. Aquí los profesores pueden gestionar las asignaciones, notas y más.</p>
        </div>
    </div>
</section>

<div class="bajo">
    <h3>Todos los derechos reservados</h3>
</div>

<script>
    document.getElementById('menu-toggle').addEventListener('click', function() {
        document.getElementById('sidebar').style.left = '0';
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
