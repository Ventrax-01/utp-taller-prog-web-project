<?php include 'middleware.php'; ?>

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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            <?php include 'views/inicioView.php'; ?>
        <script src="/styles/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
