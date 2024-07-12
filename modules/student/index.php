<?php
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "<script> location.href='/modules/auth/login.php'; </script>";
    exit();
}

if (!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'alumno') {
    echo "<script> location.href='/modules/auth/login.php'; </script>";
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
            background-color: #fe9187; /* Cambiado a #fe9187 */
            color: #fff;
            padding: 10px;
            text-align: center;
            position: relative;
            border-bottom: 3px solid #e87b6f; /* Agregar borde al encabezado */
            box-shadow: 0 4px 8px rgba(0,0,0,0.1); /* Sombra para efecto visual */
        }
        .menu-toggle-container {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .menu-toggle {
            background-color: #fe9187; /* Cambiado a #fe9187 */
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .menu-toggle:hover {
            background-color: #e87b6f; /* Efecto hover */
        }
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100%;
            background-color: #333; /* Cambiado a #333 */
            color: #fff;
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1); /* Sombra para efecto visual */
            border-right: 3px solid #444; /* Agregar borde a la barra deslizante */
        }
        .sidebar-header {
            padding: 10px;
            text-align: center;
            background-color: #333; /* Cambiado a #333 */
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
            background-color: #444; /* Efecto hover */
        }
        .sidebar ul li a {
            color: #fff;
            text-decoration: none;
        }
        #menu-hide {
            background-color: #333; /* Cambiado a #333 */
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }
        #menu-hide:hover {
            background-color: #444; /* Efecto hover */
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
            background-color: #f5f5f5; /* Fondo blanco humo para los cuadros */
            border: 1px solid #ddd; /* Borde alrededor de los cuadros */
        }
        .card:hover {
            transform: scale(1.05); /* Efecto hover */
        }
        .card-header {
            background-color: #fe9187; /* Cambiado a #fe9187 */
            color: #fff;
            padding: 10px;
            font-weight: bold;
            border-bottom: 2px solid #e87b6f; /* Agregar borde al encabezado de las tarjetas */
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
            background-color: #fe9187; /* Fondo del encabezado de la tabla */
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
            background-color: #f5f5f5; /* Fondo blanco humo para el calendario */
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
        /* Estilos para el popup */
        .popup {
            display: none;
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            background-color: #fe9187; /* Cambiar el fondo del popup */
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            z-index: 1000;
            border-radius: 10px;
            text-align: center;
            color: #fff; /* Cambiar el color del texto */
        }
        .popup.show {
            display: block;
        }
        .popup h2 {
            margin-top: 0;
        }
        .popup .close-btn {
            background-color: #e87b6f;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .popup .close-btn:hover {
            background-color: #c76b5d;
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
        <button id="menu-hide" class="menu-toggle">✖</button>
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
                            <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control form-control-sm" style="width: auto;" required>
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

    <!-- Popup de notificación -->
    <div id="popup" class="popup">
        <h2>Notificación de Curso</h2>
        <p id="popup-message"></p>
        <button class="close-btn" onclick="closePopup()">Cerrar</button>
    </div>

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

        function closePopup() {
            document.getElementById('popup').classList.remove('show');
        }

        // Función para mostrar el popup de notificación
        function showPopup(message) {
            document.getElementById('popup-message').textContent = message;
            document.getElementById('popup').classList.add('show');
        }

        // Función para calcular el tiempo hasta el próximo curso y mostrar el popup
        function checkNextClass(horario) {
            const now = new Date();
            const today = now.toLocaleString('es-ES', { weekday: 'long' });
            const currentTime = now.getHours() + ':' + String(now.getMinutes()).padStart(2, '0');

            let nextClass = null;
            let nextClassTime = null;

            for (let clase of horario) {
                if (clase.dia_semana.toLowerCase() === today.toLowerCase() && clase.hora_inicio > currentTime) {
                    if (!nextClassTime || clase.hora_inicio < nextClassTime) {
                        nextClass = clase.curso;
                        nextClassTime = clase.hora_inicio;
                    }
                }
            }

            if (nextClass) {
                showPopup(`Tu próximo curso es ${nextClass} a las ${nextClassTime}`);
            } else {
                showPopup('No tienes más clases hoy.');
            }
        }

        // Verificar el próximo curso al cargar la página principal
        window.addEventListener('load', function() {
            const horario = <?php echo json_encode($horario); ?>;
            checkNextClass(horario);
        });
    </script>
</body>
</html>