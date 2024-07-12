<?php

define('MAIN_PATH', '/var/www/xyz.lucianogiraldo.com');
$dbConnection = require_once MAIN_PATH . '/db.php';
class AdministratorModel {
    private $db;

    public function __construct() {
        
        $this->db = new PDO('mysql:host=18.217.140.227;dbname=colegio_xyz', 'admin_xyz', 'colegio_xyz');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public function getAlumnosList($filtro1 = null, $filtro2 = null) {
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
            WHERE 1=1
        ";
        // Añadir condiciones para filtros
        if (!empty($filtro1)) {
            $sql .= " AND a.grado = :filtro1";
        }
        if (!empty($filtro2)) {
            $sql .= " AND a.seccion = :filtro2";
        }

        // Agrupar después de las condiciones WHERE
        $sql .= " GROUP BY a.id ORDER BY a.grado, a.id";
        $stmt = $this->db->prepare($sql);

        if (!empty($filtro1)) {
            $stmt->bindParam(':filtro1', $filtro1);
        }

        if (!empty($filtro2)) {
            $stmt->bindParam(':filtro2', $filtro2);
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function createNewAlumno($correo, $contrasena, $nombre, $grado, $seccion) {
        try {
            $this->db->beginTransaction();

            $sql = "INSERT INTO usuario (correo, contrasena, user_type) VALUES (:correo, :contrasena, 'alumno')";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':correo', $correo);
            $stmt->bindParam(':contrasena', $contrasena);
            $stmt->execute();
            $user_id = $this->db->lastInsertId();

            $sql = "INSERT INTO alumnos (nombre, grado, user_id, seccion) VALUES (:nombre, :grado, :user_id, :seccion)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':grado', $grado);
            $stmt->bindParam(':user_id', $user_id);
            $stmt->bindParam(':seccion', $seccion);
            $stmt->execute();

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}
?>
