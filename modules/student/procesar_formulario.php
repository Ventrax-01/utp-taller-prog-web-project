<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procesar Formulario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #FFF;
            color: #000;
            padding: 2rem;
        }
    </style>
</head>
<body>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tarea = $_POST['tarea'];
    $descripcion = $_POST['descripcion'];

    echo "<h1>Nueva Tarea</h1>";
    echo "<p>Tarea: $tarea</p>";
    echo "<p>Descripción: $descripcion</p>";

    echo "<h2>Lista de Tareas</h2>";

    // Ejemplo de estructura repetitiva while()
    $tareas = [
        ['Tarea 1', 'Descripción 1'],
        ['Tarea 2', 'Descripción 2'],
        ['Tarea 3', 'Descripción 3']
    ];
    $i = 0;
    while ($i < count($tareas)) {
        echo "<p>" . $tareas[$i][0] . ": " . $tareas[$i][1] . "</p>";
        $i++;
    }

    // Ejemplo de estructura repetitiva do...while()
    $j = 0;
    do {
        echo "<p>" . $tareas[$j][0] . ": " . $tareas[$j][1] . "</p>";
        $j++;
    } while ($j < count($tareas));

    // Ejemplo de estructura repetitiva foreach()
    foreach ($tareas as $tarea) {
        echo "<p>" . $tarea[0] . ": " . $tarea[1] . "</p>";
    }
} else {
    echo "Método de solicitud no válido.";
}
?>
</body>
</html>
