<?php
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
require_once MAIN_PATH . '/modules/administrator/models/AdministratorModel.php';
class AdministratorController {
    private $model;

    public function __construct() {
        $this->model = new AdministratorModel();
    }

    public function getAlumnosList($filtro1 = null, $filtro2 = null) {
        return $this->model->getAlumnosList($filtro1, $filtro2);
    }

    public function createNewAlumno($correo, $contrasena, $recontrasena,$nombre, $grado, $seccion) {
        echo "test controller 1";
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del correo electrónico no es válido.");
        }

        // Validar que las contraseñas sean iguales
        if ($contrasena !== $recontrasena) {
            throw new Exception("Las contraseñas no coinciden.");
        }

        // Validar el grado
        if (!in_array($grado, [1, 2, 3, 4, 5, 6])) {
            throw new Exception("El grado debe estar entre 1 y 6.");
        }

        // Validar la sección
        if (!in_array($seccion, ['A', 'B', 'C'])) {
            throw new Exception("La sección debe ser A, B o C.");
        }

        try {
            echo "test controller 2";
            $this->model->createNewAlumno($correo, $contrasena, $nombre, $grado, $seccion);
            echo "Alumno creado exitosamente.";
        } catch (Exception $e) {
            throw $e;
        }
    }
}
?>
