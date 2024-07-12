<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Panel Admin</title>
        <script
            src="https://kit.fontawesome.com/c4f86b63aa.js"
            crossorigin="anonymous"
        ></script>
        <link
            href="/styles/bootstrap-5.3.3-dist/css/bootstrap.min.css"
            rel="stylesheet"
        />
        <link
            href="https://fonts.googleapis.com/css?family=Open+Sans"
            rel="stylesheet"
        />

        <link
            rel="stylesheet"
            type="text/css"
            href="/styles/modules-navbar.css"
        />
        <link
            rel="stylesheet"
            type="text/css"
            href="/styles/modules-offcanvas.css"
        />
        <link href="/modules/administrator/styles.css" rel="stylesheet" />
    </head>

    <body>
        <nav
            class="navbar navbar-custom fixed-top border-bottom border-body navbar-dark custom-toggler"
            aria-label="Dark offcanvas navbar"
        >
            <div class="container-fluid">
                
                <?php include 'views/navbarView.php'; ?>
                <?php include 'views/sidebarView.php'; ?>
                
            </div>
        </nav>
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
                            <span
                                >Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Sapiente laborum ipsum hic
                                itaque, obcaecati aliquid nam optio, eum
                                consequatur nostrum atque, autem alias harum
                                pariatur maiores quos! Ad, itaque
                                cupiditate.</span
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div
                        class="cell bg-danger bg-opacity-10 border border-danger rounded"
                    >
                        <div class="m-3">
                            <h3 class="module-tag-header">Grados</h3>
                            <span
                                >Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Sapiente laborum ipsum hic
                                itaque, obcaecati aliquid nam optio, eum
                                consequatur nostrum atque, autem alias harum
                                pariatur maiores quos! Ad, itaque
                                cupiditate.</span
                            >
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div
                        class="cell bg-danger bg-opacity-10 border border-danger rounded"
                    >
                        <div class="m-3">
                            <h3 class="module-tag-header">Finanzas</h3>
                            <span
                                >Lorem ipsum dolor sit, amet consectetur
                                adipisicing elit. Sapiente laborum ipsum hic
                                itaque, obcaecati aliquid nam optio, eum
                                consequatur nostrum atque, autem alias harum
                                pariatur maiores quos! Ad, itaque
                                cupiditate.</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/styles/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
