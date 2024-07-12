<?php
echo "2.1";
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
require_once MAIN_PATH . '/modules/administrator/models/AdministratorModel.php';
echo "2.2";
class AdministratorController {
    private $model;

    public function __construct() {
        $this->model = new AdministratorModel();
    }

    public function getAlumnosList($alumno_id, $filtro1 = null, $filtro2 = null) {
        return $this->model->getAlumnosList($alumno_id, $filtro1 = null, $filtro2 = null);
    }
}
?>
