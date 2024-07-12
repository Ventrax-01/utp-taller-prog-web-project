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
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
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
            flex: 1;
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
        }
        .table-container {
            flex: 1;
            margin-right: 20px;
            overflow-y: auto; /* Agregamos overflow-y para la barra de desplazamiento */
            max-height: 500px; /* Altura máxima para controlar la barra de desplazamiento */
        }
        .form-container {
            flex: 1;
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
        <h2>Calificaciones</h2>
        <div class="table-container">
            
            <table class="table table-bordered" style="border-color: black;">
                <thead>
                    <tr>
                        <th>ALUMNOS</th>
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
                    <?php
                    // Conexión a la base de datos
                    $servername = "18.217.140.227"; // Nombre del servidor
                    $username = "admin_xyz"; // Nombre de usuario de MySQL
                    $password = "colegio_xyz"; // Contraseña de MySQL
                    $database = "colegio_xyz"; // Nombre de la base de datos

                    $conn = new mysqli($servername, $username, $password, $database);

                    // Verificar conexión
                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    // Query para obtener las calificaciones
                    $sql = "SELECT id, nombre, matematicas, quimica, historia, geografia, lenguaje, biologia, psicologia, arte FROM calificaciones";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th>" . $row['nombre'] . "</th>";
                            echo "<td>" . $row['matematicas'] . "</td>";
                            echo "<td>" . $row['quimica'] . "</td>";
                            echo "<td>" . $row['historia'] . "</td>";
                            echo "<td>" . $row['geografia'] . "</td>";
                            echo "<td>" . $row['lenguaje'] . "</td>";
                            echo "<td>" . $row['biologia'] . "</td>";
                            echo "<td>" . $row['psicologia'] . "</td>";
                            echo "<td>" . $row['arte'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No se encontraron resultados.</td></tr>";
                    }

                    // Cerrar conexión
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="form-container">
            <h2>Actualizar Nota</h2>
            <form method="post" action="actualizar_nota.php">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Seleccionar Nombre del Estudiante</label>
                    <select class="form-select" id="nombre" name="nombre" required>
                        <option value="">Seleccionar Estudiante</option>
                        <?php
                        // Conexión a la base de datos (de nuevo para el selector)
                        $conn2 = new mysqli($servername, $username, $password, $database);

                        // Verificar conexión
                        if ($conn2->connect_error) {
                            die("Conexión fallida: " . $conn2->connect_error);
                        }

                        // Query para obtener los nombres de los estudiantes
                        $sql2 = "SELECT nombre FROM calificaciones";
                        $result2 = $conn2->query($sql2);

                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                echo "<option value='" . $row2['nombre'] . "'>" . $row2['nombre'] . "</option>";
                            }
                        }

                        // Cerrar conexión
                        $conn2->close();
                        ?>
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
                    <label for="nota" class="form-label">Ingresar Nueva Nota</label>
                    <input type="number" class="form-control" id="nota" name="nota" min="0" max="20" step="0.1" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar Nota</button>
            </form>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
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
