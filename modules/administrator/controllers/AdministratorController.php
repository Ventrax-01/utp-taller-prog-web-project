<?php
require_once '/modules/administrator/models/AdministratorModel.php';

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
