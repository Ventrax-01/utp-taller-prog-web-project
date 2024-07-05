<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Página de Estudiante</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header-container {
            background-color: #343a40;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
        }
        .menu-toggle-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .menu-toggle {
            background-color: #343a40;
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #343a40;
            color: #fff;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
        }
        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #495057;
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px;
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            margin-left: 260px;
            padding: 20px;
        }
        .resumen-dashboard {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .dashboard-item {
            background-color: #e9ecef;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .hidden {
            display: none;
        }
        .curso-item {
            background-color: #ffffff;
            padding: 20px;
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="menu-toggle-container">
            <button id="menu-toggle" class="menu-toggle">☰</button>
        </div>
        <h1>Mi Página de Estudiante</h1>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">MENU</div>
        <ul>
            <li><a href="#principal"><i class="fas fa-home"></i> Principal</a></li>
            <li><a href="#cursos"><i class="fas fa-book"></i> Cursos</a></li>
            <li><a href="#notas"><i class="fas fa-clipboard-check"></i> Notas</a></li>
            <li><a href="#tareas"><i class="fas fa-tasks"></i> Tareas</a></li>
            <li><a href="#horario"><i class="fas fa-clock"></i> Horario</a></li>
        </ul>
    </div>

    <main>
        <section id="principal">
            <h2>Resumen General</h2>
            <div class="resumen-dashboard">
                <?php
                session_start();
                if (!isset($_SESSION['usuario'])) {
                    header("Location: login.php");
                    exit();
                }

                require_once 'controlleralumno.php';

                $controlador = new Controlador();
                $tipoUsuario = $_SESSION['usuario']; // Este valor debería venir de la sesión
                $datos = $controlador->obtenerDatosDashboard($tipoUsuario);

                // Mostrar próximas clases
                echo "<div class='dashboard-item' style='background-color: #FFDC00;'>"; // Amarillo
                echo "<h3>Próximas Clases</h3>";
                echo "<ul>";
                foreach ($datos['proximas_clases'] as $clase) {
                    echo "<li>{$clase[0]} - {$clase[1]}</li>";
                }
                echo "</ul>";
                echo "</div>";

                // Mostrar notas recientes
                echo "<div class='dashboard-item' style='background-color: #FF851B;'>"; // Naranja
                echo "<h3>Notas Recientes</h3>";
                echo "<ul>";
                foreach ($datos['notas_recientes'] as $nota) {
                    echo "<li>{$nota[0]}: {$nota[1]}</li>";
                }
                echo "</ul>";
                echo "</div>";

                // Mostrar tareas pendientes
                echo "<div class='dashboard-item' style='background-color: #7FDBFF;'>"; // Azul claro
                echo "<h3>Tareas Pendientes</h3>";
                echo "<ul>";
                foreach ($datos['tareas_pendientes'] as $tarea) {
                    echo "<li>{$tarea[0]}: {$tarea[1]}</li>";
                }
                echo "</ul>";
                echo "</div>";

                // Estructuras condicionales para el número de tareas
                $numero_tareas = count($datos['tareas_pendientes']);
                if ($numero_tareas > 5) {
                    echo "<div class='alert alert-warning'>Tienes muchas tareas pendientes. ¡Es hora de empezar a trabajar!</div>";
                } elseif ($numero_tareas > 0) {
                    echo "<div class='alert alert-info'>Tienes algunas tareas pendientes. ¡Sigue así!</div>";
                } else {
                    echo "<div class='alert alert-success'>No tienes tareas pendientes. ¡Bien hecho!</div>";
                }

                // Mostrar promedio de notas
                echo "<div class='dashboard-item' style='background-color: #2ECC40;'>"; // Verde
                echo "<h3>Promedio de Notas</h3>";
                if ($datos['nota_promedio'] >= 18) {
                    echo "<p>Excelente trabajo. Tu promedio es {$datos['nota_promedio']}.</p>";
                } elseif ($datos['nota_promedio'] >= 14) {
                    echo "<p>Buen trabajo. Tu promedio es {$datos['nota_promedio']}. Puedes mejorar.</p>";
                } else {
                    echo "<p>Necesitas mejorar. Tu promedio es {$datos['nota_promedio']}. ¡No te rindas!</p>";
                }
                echo "</div>";

                // Uso de while y do...while
                $i = 0;
                echo "<div class='dashboard-item'>";
                echo "<h3>Clases Repetitivas</h3>";
                echo "<ul>";
                while ($i < count($datos['proximas_clases'])) {
                    echo "<li>{$datos['proximas_clases'][$i][0]} - {$datos['proximas_clases'][$i][1]}</li>";
                    $i++;
                }
                echo "</ul>";
                echo "</div>";

                $j = 0;
                echo "<div class='dashboard-item'>";
                echo "<h3>Notas Repetitivas</h3>";
                echo "<ul>";
                do {
                    echo "<li>{$datos['notas_recientes'][$j][0]}: {$datos['notas_recientes'][$j][1]}</li>";
                    $j++;
                } while ($j < count($datos['notas_recientes']));
                echo "</ul>";
                echo "</div>";
                ?>
            </div>
        </section>
        <section id="cursos" class="hidden">
            <h2>Cursos</h2>
            <div class="resumen-dashboard">
                <div class="curso-item">
                    <h3>Matemáticas</h3>
                    <p>Profesor: García</p>
                </div>
                <div class="curso-item">
                    <h3>Lengua</h3>
                    <p>Profesor: López</p>
                </div>
                <div class="curso-item">
                    <h3>Ciencias Sociales</h3>
                    <p>Profesor: Martínez</p>
                </div>
                <div class="curso-item">
                    <h3>Ciencias Naturales</h3>
                    <p>Profesor: Rodríguez</p>
                </div>
                <div class="curso-item">
                    <h3>Historia</h3>
                    <p>Profesor: Pérez</p>
                </div>
            </div>
        </section>
        <section id="notas" class="hidden">
            <h2>Notas</h2>
            <p>Bienvenido a la sección de notas.</p>
        </section>
        <section id="tareas" class="hidden">
            <h2>Tareas</h2>
            <p>Bienvenido a la sección de tareas.</p>
        </section>
        <section id="horario" class="hidden">
            <h2>Horario</h2>
            <p>Bienvenido a la sección de horario.</p>
        </section>
    </main>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(0)' ? 'translateX(-100%)' : 'translateX(0)';
        });

        document.querySelectorAll('.sidebar ul li a').forEach(function(link) {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                document.querySelectorAll('main section').forEach(function(section) {
                    section.classList.add('hidden');
                });
                var target = document.querySelector(this.getAttribute('href'));
                target.classList.remove('hidden');

                // Ocultar la barra lateral
                var sidebar = document.getElementById('sidebar');
                sidebar.style.transform = 'translateX(-100%)';
            });
        });
    </script>
</body>
</html>
