<?php
class ModelAlumno {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=estudiante_db', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

    public function getNotas($alumno_id) {
        $stmt = $this->db->prepare("
            SELECT cursos.nombre as curso, notas.pc1, notas.pc2, notas.ef 
            FROM notas 
            JOIN cursos ON notas.curso_id = cursos.id 
            WHERE notas.alumno_id = :alumno_id
        ");
        $stmt->bindParam(':alumno_id', $alumno_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTareas($alumno_id) {
        $stmt = $this->db->prepare("
            SELECT cursos.nombre as curso, tareas.descripcion, tareas.fecha_entrega 
            FROM tareas 
            JOIN cursos ON tareas.curso_id = cursos.id 
            WHERE tareas.alumno_id = :alumno_id
        ");
        $stmt->bindParam(':alumno_id', $alumno_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getHorario($alumno_id) {
        $stmt = $this->db->prepare("
            SELECT cursos.nombre as curso, horarios.dia_semana, horarios.hora_inicio, horarios.hora_fin 
            FROM asignaciones_cursos 
            JOIN horarios ON asignaciones_cursos.curso_id = horarios.curso_id 
            JOIN cursos ON horarios.curso_id = cursos.id 
            WHERE asignaciones_cursos.alumno_id = :alumno_id
        ");
        $stmt->bindParam(':alumno_id', $alumno_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
