<?php
require_once '/modules/administrator/models/AdministratorModel.php';

class AdministratorModel {
    private $model;

    public function __construct() {
        $this->model = new AdministratorModel();
    }

/*     public function getCursos($alumno_id) {
        return $this->model->getCursos($alumno_id);
    }

    public function getNotas($alumno_id) {
        return $this->model->getNotas($alumno_id);
    }

    public function getTareas($alumno_id) {
        return $this->model->getTareas($alumno_id);
    }

    public function getHorario($alumno_id) {
        return $this->model->getHorario($alumno_id);
    } */
}
?>
