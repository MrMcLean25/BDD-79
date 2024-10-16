<?php

$dbname = "grupo79";
$user = "grupo79";
$password = "grupo79";

$conn = pg_connect("host=localhost port=22 dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Connection failed: " . pg_last_error());
}

function ejecutar_query($conn, $sql) {
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: " . pg_last_error($conn) . "\n";
    }
}

function crear_tabla_personas($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS personas (
        id_persona SERIAL PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        correo VARCHAR(100),
        telefono VARCHAR(9),
        RUN VARCHAR(10) UNIQUE NOT NULL,
        DV CHAR(1) NOT NULL,
        estamento VARCHAR(20) DEFAULT 'NO VIGENTE' 
            CHECK (estamento IN ('VIGENTE', 'EXALUMNO', 'NO VIGENTE'))
    )";
    ejecutar_query($conn, $sql);
}


function crear_tabla_trabajadores($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS trabajadores (
        id_trabajador SERIAL PRIMARY KEY,
        id_persona INT REFERENCES personas(id_persona),
        cargo VARCHAR(50) NOT NULL,
        dedicacion INT CHECK (dedicacion <= 40),
        contrato VARCHAR(20) CHECK (contrato IN ('FULL TIME', 'PART TIME', 'HONORARIO')),
        grado_academico VARCHAR(50) CHECK (grado_academico IN ('LICENCIATURA', 'MAGISTER', 'DOCTOR'))
    )";
    ejecutar_query($conn, $sql);
}

function crear_tabla_estudiantes($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS estudiantes (
        id_estudiante SERIAL PRIMARY KEY,
        id_persona INT REFERENCES personas(id_persona),
        numero_estudiante VARCHAR(15) UNIQUE NOT NULL,
        cohorte VARCHAR(7),
        estado_bloqueo BOOLEAN DEFAULT FALSE,
        ultimo_logro VARCHAR(50),
        ultima_carga VARCHAR(7)
    )";
    ejecutar_query($conn, $sql);
}


function crear_tabla_planes_estudio($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS planes_estudio (
        id_plan SERIAL PRIMARY KEY,
        id_carrera INT REFERENCES carreras(id_carrera) ON DELETE CASCADE,
        codigo_plan VARCHAR(10) UNIQUE NOT NULL,
        fecha_inicio DATE NOT NULL,
        jornada VARCHAR(10) CHECK (jornada IN ('DIURNA', 'VESPERTINA')),
        modalidad VARCHAR(10) CHECK (modalidad IN ('PRESENCIAL', 'ONLINE', 'HIBRIDA')),
        sede VARCHAR(20) CHECK (sede IN ('HOGWARTS', 'BEAUXBATON', 'UAGADOU')),
        nombre_plan VARCHAR(100) NOT NULL,
        grado_plan VARCHAR(50) 
            CHECK (grado_plan IN ('PROGRAMA ESPECIAL DE LICENCIATURA', 'PREGRADO', 'POSTGRADO'))
    )";
    ejecutar_query($conn, $sql);
}

function crear_tabla_cursos($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS cursos (
        id_curso SERIAL PRIMARY KEY,
        sigla VARCHAR(10) UNIQUE NOT NULL,
        nombre VARCHAR(255),
        caracter VARCHAR(50),
        nivel INT CHECK (nivel >= 1 AND nivel <= 10),
        ciclo INT CHECK (ciclo >= 1 AND nivel <= 10)
    )";
    ejecutar_query($conn, $sql);
}

function crear_tabla_historial_academico($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS historiales_academicos (
        id_historial SERIAL PRIMARY KEY,
        id_estudiante INT REFERENCES estudiantes(id_estudiante),
        id_curso INT REFERENCES cursos(id_curso),
        nota NUMERIC (3,1) CHECK (nota >= 1.0 AND nota <= 7.0),
        calificacion VARCHAR(2) CHECK (calificacion IN ('SO', 'MB', 'B', 'SU', 'I', 'M', 'MM', 'P', 'NP', 'EX', 'A', 'R')),
        descripcion TEXT
    )";
    ejecutar_query($conn, $sql);
}

function crear_tabla_oferta_academica($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS oferta_academica (
        id_oferta SERIAL PRIMARY KEY,
        id_curso INT REFERENCES cursos(id_curso),
        vacantes INT CHECK (vacantes > 0),
        sala VARCHAR(50),
        modulo_horario VARCHAR(50),
        periodo VARCHAR(7),
        seccion VARCHAR(10),
        nombre_profesor VARCHAR(100) DEFAULT 'POR DESIGNAR'
    )";
    ejecutar_query($conn, $sql);
}

?>
