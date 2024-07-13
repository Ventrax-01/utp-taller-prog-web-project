<?php
session_start();
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');

require_once MAIN_PATH . '/modules/administrator/controllers/AdministratorController.php';
$administratorController = new AdministratorController();
$cursos = $administratorController->getCursos();
$grados = $administratorController->getGrados();

foreach ($grados as $grado) {
    $labels[] = $grado['grado'] . ' ' . $grado['seccion']; // Concatenar grado y sección para la etiqueta
    $data[] = $grado['cantidad'];
}

?>

<div class="px-2 px-sm-5 px-lg-5">
    <div class="row g-2 g-sm-4 g-lg-4">
        <div class="col-12 col-lg-4">
            <div
                class="cell bg-danger bg-opacity-10 border border-danger rounded h-100"
            >
                <div class="m-3">
                    <h3 class="module-tag-header">
                        Hola, Alonso Giraldo
                    </h3>
                    <span
                        >Bienvenido al panel de administrador. Aquí
                        tendrás la capacidad de supervisar y ajustar
                        diversos aspectos del sistema escolar según las
                        necesidades de la institución.
                    </span>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div
                class="cell bg-danger bg-opacity-10 border border-danger rounded h-100"
            >
                <div class="m-3">
                    <h3 class="module-tag-header">
                        Últimas conexiones
                    </h3>
                    <table
                        class="table table-striped table-bordered border-danger small"
                    >
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Persona</th>
                                <th scope="col">Cargo</th>
                                <th scope="col">Fecha y hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>

                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-4">
            <div
                class="cell bg-danger bg-opacity-10 border border-danger rounded"
            >
                <div class="m-3">
                    <h3 class="module-tag-header">Cursos</h3>
                    <table
                        class="table table-striped table-bordered border-danger small"
                    >
                        <thead>
                            <tr>
                                <th scope="col">#ID</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Profesor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cursos as $curso): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($curso['id']); ?></td>
                                    <td><?php echo htmlspecialchars($curso['nombre_curso']); ?></td>
                                    <td><?php echo htmlspecialchars($curso['nombre_profesor']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div
                class="cell bg-danger bg-opacity-10 border border-danger rounded"
            >
                <div class="m-3">
                    <h3 class="module-tag-header">Grados</h3>
                    <table
                        class="table table-striped table-bordered border-danger small"
                    >
                        <thead>
                            <tr>
                                <th scope="col">Grado</th>
                                <th scope="col">Seccion</th>
                                <th scope="col">Nro. Alumnos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($grados as $grado): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($grado['grado']); ?></td>
                                    <td><?php echo htmlspecialchars($grado['seccion']); ?></td>
                                    <td><?php echo htmlspecialchars($grado['cantidad']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <canvas id="myBarChart" width="200" height="100"></canvas>
                            <script>
                                // Obtener los datos de PHP
                                const labels = <?php echo json_encode($labels); ?>;
                                const data = <?php echo json_encode($data); ?>;
                                
                                // Crear el gráfico de barras
                                const ctx = document.getElementById('myBarChart').getContext('2d');
                                const myBarChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Cantidad de Alumnos',
                                            data: data,
                                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            </script>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>