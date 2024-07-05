<?php
session_start();

if (!isset($_SESSION['alumno_id'])) {
    header('Location: login.php');
    exit();
}

require_once 'controllerAlumno.php';
$controller = new ControllerAlumno();

$cursos = $controller->getCursos($_SESSION['alumno_id']);
$notas = $controller->getNotas($_SESSION['alumno_id']);
$tareas = $controller->getTareas($_SESSION['alumno_id']);
$horario = $controller->getHorario($_SESSION['alumno_id']);
?>

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
            background-color: #f8f9fa;
        }
        .header-container {
            background-color: #FF0000; /* Cambiado a rojo */
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
            border-bottom: 3px solid #cc0000; /* Agregar borde al encabezado */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra para efecto visual */
        }
        .menu-toggle-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .menu-toggle {
            background-color: #FF0000; /* Cambiado a rojo */
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .menu-toggle:hover {
            background-color: #cc0000; /* Efecto hover */
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #FF0000; /* Cambiado a rojo */
            color: #fff;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1); /* Sombra para efecto visual */
            border-right: 3px solid #cc0000; /* Agregar borde a la barra deslizante */
        }
        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #FF0000; /* Cambiado a rojo */
        }
        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px;
            transition: background-color 0.3s ease;
        }
        .sidebar ul li:hover {
            background-color: #cc0000; /* Efecto hover */
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }
        main {
            margin-left: 260px;
            padding: 20px;
        }
        .hidden {
            display: none;
        }
        .card {
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra para los cuadros */
            border-radius: 10px; /* Bordes redondeados */
            overflow: hidden;
            transition: transform 0.3s ease; /* Efecto al pasar el cursor */
            background-color: #fff; /* Fondo blanco para los cuadros */
            border: 1px solid #ddd; /* Borde alrededor de los cuadros */
        }
        .card:hover {
            transform: scale(1.05); /* Efecto hover */
        }
        .card-header {
            background-color: #FF0000; /* Cambiado a rojo */
            color: #fff;
            padding: 10px;
            font-weight: bold;
            border-bottom: 2px solid #cc0000; /* Agregar borde al encabezado de las tarjetas */
        }
        .card-body {
            padding: 10px;
        }
        .table {
            margin-bottom: 0;
            border-collapse: collapse; /* Colapsar los bordes de la tabla */
            width: 100%;
        }
        .table th, .table td {
            border: 1px solid #ddd; /* Bordes de las celdas */
            padding: 8px;
        }
        .table th {
            background-color: #FF0000; /* Fondo del encabezado de la tabla */
            color: white;
            font-weight: normal; /* Más delgado */
            padding: 4px; /* Ajustar el padding */
        }
        .table tr:nth-child(even) {
            background-color: #f2f2f2; /* Fondo para las filas pares */
        }
        .table tr:hover {
            background-color: #ddd; /* Fondo al pasar el cursor por encima */
        }
        .calendar-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .calendar {
            display: grid;
            grid-template-columns: 80px repeat(5, 1fr); /* Añadimos una columna para las horas */
            gap: 10px;
            width: 100%;
            max-width: 800px; /* Ajustar el ancho máximo para centrar */
            border: 1px solid #ddd; /* Borde alrededor del calendario */
            background-color: #fff; /* Fondo blanco para el calendario */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra para efecto visual */
        }
        .calendar .hour-label {
            text-align: center;
            padding: 5px;
            font-weight: bold;
            border-right: 1px solid #ddd; /* Borde derecho para separar horas */
            border-bottom: 1px solid #ddd; /* Borde inferior para separar horas */
        }
        .calendar .day {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .calendar .day .hour {
            border-bottom: 1px solid #ddd;
            padding: 5px;
            font-size: 0.9em;
            border-top: 1px solid #000; /* Agregar borde superior */
        }
        .calendar .day .hour:last-child {
            border-bottom: none;
        }
        .calendar .day {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body>
    <div class="header-container">
        <div class="menu-toggle-container">
            <button id="menu-toggle" class="menu-toggle">☰</button>
        </div>
        <h1>Mi Página de Estudiante</h1>
        <p>Bienvenido, <?php echo isset($_SESSION['nombre_alumno']) ? htmlspecialchars($_SESSION['nombre_alumno']) : 'Usuario'; ?></p>
        <a href="logout.php" class="btn btn-danger">Cerrar Sesión</a>
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
        <button id="menu-hide" class="menu-toggle">✖</button> <!-- Botón para ocultar la barra lateral -->
    </div>

    <main>
        <section id="principal">
            <div class="card">
                <div class="card-header">Resumen de Cursos</div>
                <div class="card-body">
                    <ul>
                        <?php if (isset($cursos) && is_array($cursos) && !empty($cursos)): ?>
                            <?php foreach ($cursos as $curso): ?>
                                <li><?php echo htmlspecialchars($curso['nombre']) . ' - ' . htmlspecialchars($curso['profesor']); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No hay cursos disponibles.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Resumen de Notas</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>PC1</th>
                                <th>PC2</th>
                                <th>EF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($notas) && is_array($notas) && !empty($notas)): ?>
                                <?php foreach ($notas as $nota): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($nota['curso']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['pc1']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['pc2']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['ef']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No hay notas disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header">Tareas Pendientes</div>
                <div class="card-body">
                    <ul>
                        <?php if (isset($tareas) && is_array($tareas) && !empty($tareas)): ?>
                            <?php foreach ($tareas as $tarea): ?>
                                <li><?php echo htmlspecialchars($tarea['curso']) . ': ' . htmlspecialchars($tarea['descripcion']) . ' (Fecha de entrega: ' . htmlspecialchars($tarea['fecha_entrega']) . ')'; ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No hay tareas pendientes.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        <section id="cursos" class="hidden">
            <div class="card">
                <div class="card-header">Cursos</div>
                <div class="card-body">
                    <ul>
                        <?php if (isset($cursos) && is_array($cursos) && !empty($cursos)): ?>
                            <?php foreach ($cursos as $curso): ?>
                                <li><?php echo htmlspecialchars($curso['nombre']) . ' - ' . htmlspecialchars($curso['profesor']); ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No hay cursos disponibles.</li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </section>
        <section id="notas" class="hidden">
            <div class="card">
                <div class="card-header">Notas</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Materia</th>
                                <th>PC1</th>
                                <th>PC2</th>
                                <th>EF</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($notas) && is_array($notas) && !empty($notas)): ?>
                                <?php foreach ($notas as $nota): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($nota['curso']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['pc1']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['pc2']); ?></td>
                                        <td><?php echo htmlspecialchars($nota['ef']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">No hay notas disponibles.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section id="tareas" class="hidden">
            <div class="card">
                <div class="card-header">Tareas</div>
                <div class="card-body">
                    <ul>
                        <?php if (isset($tareas) && is_array($tareas) && !empty($tareas)): ?>
                            <?php foreach ($tareas as $tarea): ?>
                                <li><?php echo htmlspecialchars($tarea['curso']) . ': ' . htmlspecialchars($tarea['descripcion']) . ' (Fecha de entrega: ' . htmlspecialchars($tarea['fecha_entrega']) . ')'; ?></li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <li>No hay tareas pendientes.</li>
                        <?php endif; ?>
                    </ul>
                    <form method="post" action="procesar_formulario.php">
                        <input type="hidden" name="alumno_id" value="<?php echo $_SESSION['alumno_id']; ?>">
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción de la tarea:</label>
                            <input type="text" id="descripcion" name="descripcion" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_entrega" class="form-label">Fecha de entrega:</label>
                            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="curso_id" class="form-label">Curso:</label>
                            <select id="curso_id" name="curso_id" class="form-control" required>
                                <?php if (isset($cursos) && is_array($cursos) && !empty($cursos)): ?>
                                    <?php foreach ($cursos as $curso): ?>
                                        <option value="<?php echo $curso['id']; ?>"><?php echo htmlspecialchars($curso['nombre']); ?></option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="">No hay cursos disponibles</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Agregar Tarea</button>
                    </form>
                </div>
            </div>
        </section>
        <section id="horario" class="hidden">
            <div class="card">
                <div class="card-header">Horario</div>
                <div class="card-body">
                    <div class="calendar-container">
                        <div class="calendar">
                            <div class="hour-label"></div> <!-- Celda vacía para la esquina superior izquierda -->
                            <?php
                            $days = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'];
                            foreach ($days as $day):
                            ?>
                                <div class="day"><strong><?php echo $day; ?></strong></div>
                            <?php endforeach; ?>
                            <?php
                            $hours = ['08:00', '09:00', '10:00', '11:00', '12:00', '13:00', '14:00'];
                            foreach ($hours as $hour):
                            ?>
                                <div class="hour-label"><strong><?php echo $hour; ?></strong></div>
                                <?php foreach ($days as $day): ?>
                                    <div class="day">
                                        <div class="hour">
                                            <?php
                                            $found = false;
                                            foreach ($horario as $clase) {
                                                if ($clase['dia_semana'] == $day && $clase['hora_inicio'] <= $hour . ':00' && $clase['hora_fin'] > $hour . ':00') {
                                                    echo $clase['curso'];
                                                    $found = true;
                                                    break;
                                                }
                                            }
                                            if (!$found) {
                                                echo '&nbsp;';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.style.transform = sidebar.style.transform === 'translateX(0)' ? 'translateX(-100%)' : 'translateX(0)';
        });

        document.getElementById('menu-hide').addEventListener('click', function() {
            var sidebar = document.getElementById('sidebar');
            sidebar.style.transform = 'translateX(-100%)';
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
