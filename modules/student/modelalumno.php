<?php
class Modelo {
    private $proximas_clases = [
        ['Matemáticas', 'Lunes, 8:00 AM'],
        ['Lengua', 'Lunes, 9:00 AM'],
        ['Inglés', 'Martes, 9:00 AM'],
        ['Ciencias Sociales', 'Miércoles, 10:00 AM'],
        ['Ciencias Naturales', 'Jueves, 9:00 AM'],
        ['Arte', 'Viernes, 11:00 AM']
    ];

    private $notas_recientes = [
        ['Matemáticas', '18/20'],
        ['Lengua', '15/20'],
        ['Historia', '17/20'],
        ['Ciencias Sociales', '16/20'],
        ['Ciencias Naturales', '19/20'],
        ['Arte', '14/20']
    ];

    private $tareas_pendientes = [
        ['Matemáticas', 'Resolver ejercicios página 45'],
        ['Lengua', 'Leer capítulo 4 del libro'],
        ['Ciencias Sociales', 'Hacer resumen del tema 2'],
        ['Ciencias Naturales', 'Investigar sobre ecosistemas'],
        ['Inglés', 'Preparar presentación oral'],
        ['Arte', 'Crear una composición artística']
    ];

    public function obtenerProximasClases() {
        return $this->proximas_clases;
    }

    public function obtenerNotasRecientes() {
        return $this->notas_recientes;
    }

    public function obtenerTareasPendientes() {
        return $this->tareas_pendientes;
    }

    public function calcularPromedioNotas($notas) {
        $total_notas = count($notas);
        if ($total_notas === 0) {
            return 0;
        }

        $suma_notas = 0;
        foreach ($notas as $nota) {
            $suma_notas += (int) explode('/', $nota[1])[0];
        }

        return $suma_notas / $total_notas;
    }

    public function buscarClasePorDia($dia) {
        $clases_en_dia = [];
        foreach ($this->proximas_clases as $clase) {
            if (strpos(strtolower($clase[1]), strtolower($dia)) !== false) {
                $clases_en_dia[] = $clase;
            }
        }
        return $clases_en_dia;
    }

    public function obtenerPromediosPorMateria() {
        $promedios = [];
        foreach ($this->notas_recientes as $nota) {
            $materia = $nota[0];
            $calificacion = (int) explode('/', $nota[1])[0];

            if (isset($promedios[$materia])) {
                $promedios[$materia]['total_notas']++;
                $promedios[$materia]['suma_notas'] += $calificacion;
            } else {
                $promedios[$materia] = [
                    'total_notas' => 1,
                    'suma_notas' => $calificacion
                ];
            }
        }

        foreach ($promedios as $materia => &$datos) {
            $datos['promedio'] = $datos['suma_notas'] / $datos['total_notas'];
        }

        return $promedios;
    }
}
?>
