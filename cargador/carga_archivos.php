<?php

$ruta_cursos = '../archivos/asignaturas.csv';
$ruta_docentes_planificados = '../archivos/docentes_planificados.csv';
$ruta_estudiantes = '../archivos/estudiantes.csv';
$ruta_notas = '../archivos/notas.csv';
$ruta_planeacion = '../archivos/planeacion.csv';
$ruta_planes = '../archivos/planes.csv';
$ruta_prerrequisitos = '../archivos/prerrequisitos.csv';

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