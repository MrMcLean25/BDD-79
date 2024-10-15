<?php
// Inicializamos las variables para la conexion

$host = "bdd1.ing.puc.cl";
$dbname = "grupo79";
$user = "grupo79";
$password = "grupo79";

// Establecemos la conexion con la base de date_offset_get

// Establecemos la conexión con la base de datos
$conn = pg_connect("host=$host dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

?>