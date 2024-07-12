<?php
session_start();
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once MAIN_PATH . '/modules/administrator/controllers/AdministratorController.php';
    $administratorControler = new AdministratorController();

    $alumnos = $administratorControler->getAlumnosList();
}
?>

<div class="px-2 px-sm-5 px-lg-5">
    <div class="row g-2 g-sm-4 g-lg-4">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link active"
                    id="listado-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#listado"
                    type="button"
                    role="tab"
                    aria-controls="listado"
                    aria-selected="true"
                >
                    Listado
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="añadir-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#añadir"
                    type="button"
                    role="tab"
                    aria-controls="añadir"
                    aria-selected="false"
                >
                    Añadir
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button
                    class="nav-link"
                    id="modificar-tab"
                    data-bs-toggle="tab"
                    data-bs-target="#modificar"
                    type="button"
                    role="tab"
                    aria-controls="modificar"
                    aria-selected="false"
                >
                    Modificar
                </button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="listado"
                role="tabpanel"
                aria-labelledby="listado-tab"
            >
                <form id="formListadoAlumnos">
                    <h3 class="module-tag-header">Listado de Alumnos</h3>
                    <div class="py-1">
                        
                        <span>Seleccione el grado: </span>
                        <select id="selectGrado" class="form-select btn-secondary" aria-label="Default select example">
                        <option value="" selected>Todos</option>
                        <option value="1">1er. Prim</option>
                        <option value="2">2do. Prim</option>
                        <option value="3">3er. Prim</option>
                        <option value="4">4to. Prim</option>
                        <option value="5">5to. Prim</option>
                        <option value="6">6to. Prim</option>
                        </select>
                    </div>
                    <div class="py-1">
                        <span>Seleccione la sección: </span>
                        <select id="selectSeccion" class="form-select btn-secondary" aria-label="Default select example">
                        <option value="" selected>Todos</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">
                        Buscar
                    </button>
                </form>

                <table
                    class="table table-striped table-bordered border-danger small"
                >
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Alumno</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Sección</th>
                            <th scope="col">Promedio</th>
                            <th scope="col">Correo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($alumno['id']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['grado']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['seccion']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['promedio']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['correo']); ?></td>
                                <td>
                                    <button type="button" class="">
                                        <i
                                            class="fa-solid fa-magnifying-glass fa-xs"
                                        ></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div
                class="tab-pane fade"
                id="añadir"
                role="tabpanel"
                aria-labelledby="añadir-tab"
            >
                <form class="w-50">
                    <h3 class="module-tag-header py-2">
                        Registro de Alumnos
                    </h3>
                    <div class="mb-2">
                        <label
                            for="exampleInputEmail1"
                            class="form-label"
                            >Correo</label
                        >
                        <input
                            type="text"
                            class="form-control add"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                        />
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputPassword1"
                            class="form-label"
                            >Contraseña</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="exampleInputPassword1"
                        />
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputPassword1"
                            class="form-label"
                            >Confirmar contraseña</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="exampleInputPassword2"
                        />
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputEmail1"
                            class="form-label"
                            >Nombres</label
                        >
                        <input
                            type="text"
                            class="form-control add"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                        />
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputEmail1"
                            class="form-label"
                            >Apellido Paterno</label
                        >
                        <input
                            type="text"
                            class="form-control add"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                        />
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputEmail1"
                            class="form-label"
                            >Apellido Materno</label
                        >
                        <input
                            type="text"
                            class="form-control add"
                            id="exampleInputEmail1"
                            aria-describedby="emailHelp"
                        />
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputEmail1"
                            class="form-label"
                            >Grado</label
                        >
                        <select
                            class="form-select"
                            aria-label="Default select example"
                        >
                            <option selected>
                                -Seleccione un grado-
                            </option>
                            <option value="1">1er. Prim</option>
                            <option value="2">2do. Prim</option>
                            <option value="3">3ro. Prim</option>
                            <option value="2">4to. Prim</option>
                            <option value="3">5to. Prim</option>
                            <option value="2">6to. Prim</option>
                            <option value="3">1ro. Sec</option>
                            <option value="3">2do. Sec</option>
                            <option value="3">3ro. Sec</option>
                            <option value="3">4to. Sec</option>
                            <option value="3">5to. Sec</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label
                            for="exampleInputEmail1"
                            class="form-label"
                            >Sección</label
                        >
                        <select
                            class="form-select"
                            aria-label="Default select example"
                        >
                            <option selected>
                                -Seleccione una sección-
                            </option>
                            <option value="1">A</option>
                            <option value="2">B</option>
                            <option value="3">C</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mb-2">
                        Registrar
                    </button>
                </form>
            </div>
            <div
                class="tab-pane fade"
                id="modificar"
                role="tabpanel"
                aria-labelledby="modificar-tab"
            >
                <h3 class="module-tag-header py-2">
                    Editar información de Alumno
                </h3>
                <div class="input-group mb-3 w-50">
                    <button
                        class="btn btn-outline-secondary dropdown-toggle"
                        type="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false"
                    >
                        -Seleccione-
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a class="dropdown-item" href="#">DNI</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Correo</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Nombre</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#"
                                >Apellido</a
                            >
                        </li>
                    </ul>
                    <input
                        type="text"
                        class="form-control"
                        aria-label="Text input with dropdown button"
                    />

                    
                </div>
                <table
                        class="table table-striped table-bordered border-danger small"
                    >
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Alumno</th>
                                <th scope="col">Grado</th>
                                <th scope="col">Sección</th>
                                <th scope="col">Correo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Lorem ipsum dolor sit</td>
                                <td>1er. Prim</td>
                                <td>A</td>
                                <td>lorem.ipsum@colegioxyz.com</td>
                                <td>
                                    <button type="button" class="">
                                        <i
                                            class="fa-solid fa-magnifying-glass fa-xs"
                                        ></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Lorem ipsum dolor sit</td>
                                <td>1er. Prim</td>
                                <td>A</td>
                                <td>lorem.ipsum@colegioxyz.com</td>
                                <td>
                                    <button type="button" class="">
                                        <i
                                            class="fa-solid fa-magnifying-glass fa-xs"
                                        ></i>
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <th scope="row">3</th>
                                <td>Lorem ipsum dolor sit</td>
                                <td>1er. Prim</td>
                                <td>A</td>
                                <td>lorem.ipsum@colegioxyz.com</td>
                                <td>
                                    <button type="button" class="">
                                        <i
                                            class="fa-solid fa-magnifying-glass fa-xs"
                                        ></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <form class="w-50">
                        <div class="mb-2">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                                >Correo</label
                            >
                            <input
                                type="text"
                                class="form-control add"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="lorem.ipsum@colegioxyz.com"
                            />
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputPassword1"
                                class="form-label"
                                >Contraseña</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                id="exampleInputPassword1"
                                placeholder="Contraseña"
                            />
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputPassword1"
                                class="form-label"
                                >Confirmar contraseña</label
                            >
                            <input
                                type="password"
                                class="form-control"
                                id="exampleInputPassword2"
                                placeholder="Repita la contraseña"
                            />
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                                >Nombres</label
                            >
                            <input
                                type="text"
                                class="form-control add"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="Lorem Ipsum"
                            />
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                                >Apellido Paterno</label
                            >
                            <input
                                type="text"
                                class="form-control add"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="Dolor"
                            />
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                                >Apellido Materno</label
                            >
                            <input
                                type="text"
                                class="form-control add"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp"
                                placeholder="Sit"
                            />
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                                >Grado</label
                            >
                            <select
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected value="1">1er. Prim</option>
                                <option value="2">2do. Prim</option>
                                <option value="3">3ro. Prim</option>
                                <option value="2">4to. Prim</option>
                                <option value="3">5to. Prim</option>
                                <option value="2">6to. Prim</option>
                                <option value="3">1ro. Sec</option>
                                <option value="3">2do. Sec</option>
                                <option value="3">3ro. Sec</option>
                                <option value="3">4to. Sec</option>
                                <option value="3">5to. Sec</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label
                                for="exampleInputEmail1"
                                class="form-label"
                                >Sección</label
                            >
                            <select
                                class="form-select"
                                aria-label="Default select example"
                            >
                                <option selected value="1">A</option>
                                <option value="2">B</option>
                                <option value="3">C</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">
                            Actualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Capturar el evento de clic en el botón Buscar
        $('#formBusqueda').on('submit', function(e) {
            // Evitar que el formulario se envíe automáticamente
            e.preventDefault();

            // Obtener los valores seleccionados
            var gradoSeleccionado = $('#selectGrado').val();
            var seccionSeleccionada = $('#selectSeccion').val();

            $_SESSION['gradoSeleccionado'] = $gradoSeleccionado;
            $_SESSION['seccionSeleccionada'] = $seccionSeleccionada;

            // Mostrar los valores seleccionados en consola (opcional)
            console.log('Grado seleccionado:', gradoSeleccionado);
            console.log('Sección seleccionada:', seccionSeleccionada);
        });
    });
</script>