<?php
class AdministratorModel {
    private $db;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    public function getCursos($alumno_id) {
        $stmt = $this->db->prepare("
            SELECT cursos.id, cursos.nombre, profesores.nombre as profesor 
            FROM asignaciones_cursos 
            JOIN cursos ON asignaciones_cursos.curso_id = cursos.id 
            JOIN profesores ON cursos.profesor_id = profesores.id 
            WHERE asignaciones_cursos.alumno_id = :alumno_id
        ");
        $stmt->bindParam(':alumno_id', $alumno_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
