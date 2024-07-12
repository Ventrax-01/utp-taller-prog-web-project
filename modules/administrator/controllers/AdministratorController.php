<?php
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
require_once MAIN_PATH . '/modules/administrator/models/AdministratorModel.php';
class AdministratorController {
    private $model;

    public function __construct() {
        $this->model = new AdministratorModel();
    }

    public function getAlumnosList($filtro1 = null, $filtro2 = null) {
        echo $filtro1;
        echo $filtro2;
        return $this->model->getAlumnosList($filtro1, $filtro2);
    }
}
?>
