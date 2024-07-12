<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal del Profesor - Cursos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('fondo21.jpg');
            background-size: cover;
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
            margin-bottom: 70px; /* Añade margen inferior para evitar que la barra fija oculte el contenido */
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
            margin-bottom: 20px;
        }
        .module {
            border: 1px solid #ddd;
            padding: 20px;
            margin: 10px 0;
            border-radius: 10px;
            background-color: #f9f9f9;
            text-align: left;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .module h3 {
            margin-top: 0;
            color: #333;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .module p {
            color: #666;
        }
        .module:hover {
            background-color: #eaeaea;
        }
        .module-content {
            display: none;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-top: 10px;
        }
        .module h3:hover {
            background-color: #f0f0f0;
        }
        .module h3.active {
            background-color: #f0f0f0;
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
            .sidebar {
                left: -100%;
            }
            .menu-toggle.active {
                transform: rotate(0deg);
            }
        }
    </style>
</head>
<body>

<div class="header-container">
    <div class="menu-toggle-container">
        <button id="menu-toggle" class="menu-toggle">☰</button>
    </div>
    <h1>Portal del Profesor - Cursos</h1>
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

<<section class="container">
    <h2>Módulos del Curso</h2>
   <div class="module">
    <h3>Semana 1 <i class="fas fa-chevron-down"></i></h3>
    <div class="module-content" style="text-align: center;">
        <p>Contenido de la semana 1 y datos de PDF aquí.</p>
        <video src="video.mp4" controls width="320" height="240" style="display: block; margin: 0 auto;">
            Tu navegador no soporta el elemento de video.
        </video>
    </div>
    <div class="module-content">
        <p>Módulo de explicación.</p>

            <?php
            // Configuración de la base de datos
            $servername = "18.217.140.227"; // Host de MySQL
            $username_db = "admin_xyz"; // Usuario de MySQL
            $password_db = "colegio_xyz"; // Contraseña de MySQL
            $database = "colegio_xyz"; // Nombre de la base de datos
            $tabla_tareas = "subir_tareas"; // Nombre correcto de la tabla de tareas

            // Conexión a la base de datos
            $conn = new mysqli($servername, $username_db, $password_db, $database);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta SQL para obtener las tareas de la semana actual
            $sql = "SELECT titulo, descripcion, fecha_entrega FROM $tabla_tareas WHERE fecha_entrega = '2024-02-01'";

            // Ejecutar la consulta
            $result = $conn->query($sql);

            // Verificar si la consulta fue exitosa
            if ($result === false) {
                echo "Error en la consulta: " . $conn->error;
            } else {
                // Verificar si hay resultados y mostrar los datos
                if ($result->num_rows > 0) {
                    echo '<div class="module-content">';
                    echo '<table class="table table-striped">';
                    echo '<thead>';
                    echo '<tr><th>Título</th><th>Descripción</th><th>Fecha de Entrega</th></tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    // Imprimir los datos de las tareas en filas de la tabla
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row["titulo"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["descripcion"]) . '</td>';
                        echo '<td>' . htmlspecialchars($row["fecha_entrega"]) . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '</div>';
                } else {
                    echo "No se encontraron tareas para esta semana.";
                }
            }

            // Cerrar conexión a la base de datos
            $conn->close();
            ?>
    </div>


    </div>
    <div class="module-content">
        <p>Práctica.</p>
        <a href="Semana.pdf">Descargar PDF</a>
    </div>
    <div class="module-content">
        <p>Material de lectura.</p>
        <a href="Semana.pdf">Descargar PDF</a>
    </div>
</div>

    <div class="module">
        <h3>Semana 2 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 2 y datos de PDF aquí.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
        <div class="module-content">
            <p>Módulo de explicación.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
        <div class="module-content">
            <p>Práctica.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
        <div class="module-content">
            <p>Material de lectura.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
    <h3>Semana 3 <i class="fas fa-chevron-down"></i></h3>
    <div class="module-content" style="text-align: center;">
        <p>Contenido de la semana 3 y datos de PDF aquí.</p>
        <video src="video.mp4" controls width="320" height="240" style="display: block; margin: 0 auto;">
            Tu navegador no soporta el elemento de video.
        </video>
    </div>
    <div class="module-content">
        <p>Módulo de explicación.</p>
        <a href="Semana.pdf">Descargar PDF</a>
    </div>
    <div class="module-content">
        <p>Práctica.</p>
        <a href="Semana.pdf">Descargar PDF</a>
    </div>
    <div class="module-content">
        <p>Material de lectura.</p>
        <a href="Semana.pdf">Descargar PDF</a>
    </div>
</div>
<div class="module">
        <h3>Semana 4 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 4 y datos de PDF aquí.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
        <div class="module-content">
            <p>Módulo de explicación.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
        <div class="module-content">
            <p>Práctica.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
        <div class="module-content">
            <p>Material de lectura.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 5 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 5 y datos de PDF aquí.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 6 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 6 y datos de PDF aquí.</p>
            <a href="Semana.pdf">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 7 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 7 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 8 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 8 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 9 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 9 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 10 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 10 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 11 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 11 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 12 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 12 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 13 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 13 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 14 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 14 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 15 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 15 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 16 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 16 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 17 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 17 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
    <div class="module">
        <h3>Semana 18 <i class="fas fa-chevron-down"></i></h3>
        <div class="module-content">
            <p>Contenido de la semana 18 y datos de PDF aquí.</p>
            <a href="#">Descargar PDF</a>
        </div>
    </div>
</section>

<div class="bajo">
    <h3>Todos los derechos reservados</h3>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menu-toggle');
        const sidebar = document.getElementById('sidebar');

        menuToggle.addEventListener('click', function () {
            const sidebarLeft = getComputedStyle(sidebar).left;
            sidebar.style.left = sidebarLeft === '0px' ? '-250px' : '0px';
            menuToggle.classList.toggle('active');
        });

        // Cerrar el menú si se hace clic fuera de él
        document.addEventListener('click', function(event) {
            const sidebarLeft = getComputedStyle(sidebar).left;
            const menuToggleActive = menuToggle.classList.contains('active');
            const target = event.target;

            if (sidebarLeft === '0px' && !sidebar.contains(target) && target !== menuToggle) {
                sidebar.style.left = '-250px';
                menuToggle.classList.remove('active');
            }
        });

        const modules = document.querySelectorAll('.module h3');

        modules.forEach(module => {
            module.addEventListener('click', function () {
                const contents = this.parentElement.querySelectorAll('.module-content');
                contents.forEach(content => {
                    content.style.display = content.style.display === 'block' ? 'none' : 'block';
                });
                this.classList.toggle('active');
            });
        });
    });
</script>

</body>
</html>
