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
                <?php include 'views/inicioView.php'; ?>
            </div>
        </div>
        <script src="/styles/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
