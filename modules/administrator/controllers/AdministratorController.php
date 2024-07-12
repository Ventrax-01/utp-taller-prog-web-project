<?php
echo "2.1";
define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
require_once MAIN_PATH . '/modules/administrator/models/AdministratorModel.php';
echo "2.2";
class AdministratorController {
    private $model;

    public function __construct() {
        echo " controller construct ";
        $this->model = new AdministratorModel();
    }

    public function getAlumnosList($filtro1 = null, $filtro2 = null) {
        echo " pre call getalumnos model ";

        echo print_r($this->model->getAlumnosList($filtro1 = null, $filtro2 = null));
        return $this->model->getAlumnosList($filtro1 = null, $filtro2 = null);
    }
}
?>
