<?php
require_once 'model.php';

class Controlador {
    private $modelo;

    public function __construct() {
        $this->modelo = new Modelo();
    }

    public function obtenerDatosDashboard($tipoUsuario) {
        // Estructura condicional para diferentes tipos de usuarios
        if ($tipoUsuario == 'estudiante') {
            $proximas_clases = $this->modelo->obtenerProximasClases();
            $notas_recientes = $this->modelo->obtenerNotasRecientes();
            $tareas_pendientes = $this->modelo->obtenerTareasPendientes();
            $nota_promedio = $this->modelo->calcularPromedioNotas($notas_recientes);
        } elseif ($tipoUsuario == 'docente') {
            $proximas_clases = $this->modelo->obtenerClasesDocente();
            $notas_recientes = $this->modelo->obtenerEvaluacionesRecientes();
            $tareas_pendientes = $this->modelo->obtenerTareasPorRevisar();
            $nota_promedio = null; // No aplicable para docentes
        } else {
            $proximas_clases = [];
            $notas_recientes = [];
            $tareas_pendientes = [];
            $nota_promedio = null;
        }

        return [
            'proximas_clases' => $proximas_clases,
            'notas_recientes' => $notas_recientes,
            'tareas_pendientes' => $tareas_pendientes,
            'nota_promedio' => $nota_promedio
        ];
    }
}

// Ejemplo de uso del controlador
$controlador = new Controlador();
$tipoUsuario = 'estudiante'; // Este valor podría venir de una sesión o un formulario
$datos = $controlador->obtenerDatosDashboard($tipoUsuario);
?>