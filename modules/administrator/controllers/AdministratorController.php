<?php
require_once '/modules/administrator/models/AdministratorModel.php';

class AdministratorController {
    private $model;

    public function __construct() {
        $this->model = new AdministratorModel();
    }

    public function getAlumnosList($alumno_id, $filtro1 = null, $filtro2 = null) {
        $sql = "
            SELECT 
                a.id,
                a.nombre,
                CASE a.grado 
                    WHEN 1 THEN '1er. Prim'
                    WHEN 2 THEN '2do. Prim'
                    WHEN 3 THEN '3er. Prim'
                    WHEN 4 THEN '4to. Prim'
                    WHEN 5 THEN '5to. Prim'
                    WHEN 6 THEN '6to. Prim'
                END as grado,
                a.seccion,
                (SUM(n.pc1) + SUM(n.pc2) + SUM(n.ef)) / 3 AS promedio,
                u.correo 
            FROM alumnos a
            LEFT JOIN usuario u ON u.user_id = a.user_id 
            LEFT JOIN notas n ON n.alumno_id = a.id 
            WHERE a.id = :alumno_id
        ";
    
        // Añadir condiciones para filtros
        if ($filtro1 !== null) {
            $sql .= " AND a.grado = :filtro1";
        }
    
        if ($filtro2 !== null) {
            $sql .= " AND a.seccion = :filtro2";
        }
    
        // Agrupar después de las condiciones WHERE
        $sql .= " GROUP BY a.id";
    
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':alumno_id', $alumno_id);
    
        if ($filtro1 !== null) {
            $stmt->bindParam(':filtro1', $filtro1);
        }
    
        if ($filtro2 !== null) {
            $stmt->bindParam(':filtro2', $filtro2);
        }
    
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
