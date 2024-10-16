<?php

$ruta_cursos = '../data/asignaturas.csv';
$ruta_docentes_planificados = '../data/docentes_planificados.csv';
$ruta_estudiantes = '../data/estudiantes.csv';
$ruta_notas = '../data/notas.csv';
$ruta_planeacion = '../data/planeacion.csv';
$ruta_planes = '../data/planes.csv';
$ruta_prerrequisitos = '../data/prerrequisitos.csv';

ini_set('memory_limit', '256M');

function leerCSV($ruta, $delimitador = ";") {
    $datos_array = [];
    if (($archivo = fopen($ruta, "r")) !== false) {
        $encabezados = fgetcsv($archivo, 0, $delimitador); // Leer encabezados
        while (($datos = fgetcsv($archivo, 0, $delimitador)) !== false) {
            $datos_array[] = $datos;
        }
        fclose($archivo);
    } else {
        echo "No se pudo abrir el archivo: $ruta<br>";
    }
    return $datos_array;
}

// Uso de la función
$prerrequisitos = leerCSV($ruta_prerrequisitos);
$notas = leerCSV($ruta_notas);

?>