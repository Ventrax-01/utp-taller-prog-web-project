<?php
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script> location.href='/modules/auth/login.php'; </script>";
    exit();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'profesor') {
    echo "<script> location.href='/modules/auth/login.php'; </script>";
    exit();
}

// Aquí puedes agregar consultas adicionales a la base de datos si es necesario
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
            order: 2;
            flex: 1;
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
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .image-container {
            position: relative;
            width: 100%;
            max-width: 580px;
            height: auto;
            margin-right: 20px;
        }
        .image-container img {
            width: 100%;
            height: auto;
            object-fit: cover;
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            transition: opacity 1s;
        }
        .image-container img:first-child {
            opacity: 1;
            position: relative;
        }
        .content-container, .news-container {
            max-width: 500px;
            background-color: white;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .footer {
            background-color: #fe9187;
            color: black;
            padding: 10px;
            text-align: center;
            position: relative;
            width: 100%;
            margin-top: 20px;
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
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
            }
            .header-container h1 {
                order: 1;
                text-align: center;
            }
            .menu-toggle-container {
                order: 2;
                margin-right: 0;
            }
            section {
                flex-direction: column;
            }
            .image-container {
                width: 100%;
                height: auto;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<div class="header-container">
    <div class="menu-toggle-container">
        <button id="menu-toggle" class="menu-toggle">☰</button>
    </div>
    <h1>Portal del Profesor - Bienvenido <?php echo $_SESSION['correo']; ?></h1>

</div>

<div class="sidebar" id="sidebar">
    <div class="sidebar-header">MENU</div>
    <ul>
        <li><a href="#"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="Cursos.php"><i class="fas fa-book"></i> Cursos</a></li>
        <li><a href="calificaiones.php"><i class="fas fa-clipboard-check"></i> Calificaciones</a></li>
        <li><a href="asistencia.php"><i class="fas fa-user-check"></i> Asistencia</a></li>
        <li><a href="tarea_profe.php"><i class="fas fa-tasks"></i> Tareas</a></li>
        <li><a href="aula.php"><i class="fas fa-chalkboard"></i> Aulas</a></li>
        
    </ul>
</div>

<section>
    <div class="image-container">
        <img src="imagen1.jpg" alt="Imagen de bienvenida">
        <img src="imagen3.jpg" alt="Imagen de bienvenida">
        <img src="imagen4.jpg" alt="Imagen de bienvenida">
        <img src="imagen6.jpg" alt="Imagen de bienvenida">
    </div>
    <div class="content-container">
        <h2>Bienvenido, Profesor</h2>
        <p>¡Aquí puedes gestionar tus clases y mantener el contacto con tus alumnos!</p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Gestión de Clases</h5>
                <p class="card-text">Administra tus horarios, contenidos y más.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Contacto con Alumnos</h5>
                <p class="card-text">Responde dudas y mantente en comunicación con tus alumnos.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Herramientas Educativas</h5>
                <p class="card-text">Accede a recursos y herramientas para mejorar la enseñanza.</p>
            </div>
        </div>
    </div>
    <div class="news-container">
        <h3>Últimas Noticias</h3>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reunión de Padres</h5>
                <p class="card-text">Reunión de padres y maestros el próximo viernes a las 3pm.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Entrega de Trabajos</h5>
                <p class="card-text">Se recuerda a los alumnos entregar los trabajos pendientes antes del viernes.</p>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Nuevo Curso</h5>
                <p class="card-text">Se ha añadido un nuevo curso de programación a la currícula.</p>
            </div>
        </div>
    </div>
</section>

<div class="footer">
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

    document.addEventListener("DOMContentLoaded", function(event) { 
        var images = document.querySelectorAll('.image-container img');
        var currentImageIndex = 0;

        setInterval(function() {
            images[currentImageIndex].style.opacity = '0';
            setTimeout(function() {
                images[currentImageIndex].style.position = 'absolute';
                currentImageIndex = (currentImageIndex + 1) % images.length;
                images[currentImageIndex].style.position = 'relative';
                images[currentImageIndex].style.opacity = '1';
            }, );
        }, 5000);
    });
</script>

</body>
</html>