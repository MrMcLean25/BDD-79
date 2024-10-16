<?php

// Definición de las variables de conexión a la base de datos
$dbname = "grupo79";         // Nombre de la base de datos
$user = "grupo79";           // Nombre de usuario para la conexión
$password = "grupo79";       // Contraseña para la conexión

// Establecer la conexión a la base de datos
$conn = pg_connect("host=localhost port=22 dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Connection failed: " . pg_last_error()); 
}

function crear_tabla_personas($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS personas (
        id_persona SERIAL PRIMARY KEY,       
        nombre VARCHAR(100) NOT NULL,   
        correo VARCHAR(100),
        telefono VARCHAR(9),    
        RUN VARCHAR(10) UNIQUE NOT NULL,
        DV CHAR(1) NOT NULL,
        estamento VARCHAR(20) DEFAULT 'NO VIGENTE' CHECK (estamento IN ('VIGENTE', 'EXALUMNO', 'NO VIGENTE'))
    )";
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: " . pg_last_error($conn) . "\n";
    }
}

function crear_tabla_trabajador($conn) {

    $sql = "CREATE TABLE IF NOT EXISTS trabajadores (
        id_trabajador,
        id_persona,
        cargo,
        dedicacion,
        contrato,
        grado_academico
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";  
    } else {
        echo "Error creando la tabla: " . pg_last_error($conn) . "\n";  
    }
}

function crear_tabla_estudiante($conn) {
    
    $sql = "CREATE TABLE IF NOT EXISTS estudiantes (
        id_estudiante SERIAL PRIMARY KEY,
        id_persona,
        numero_estudiante,
        cohorte,
        estado_bloqueo,
        ultimo_logro,
        ultima_carga
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";  
    } else {
        echo "Error creando la tabla: " . pg_last_error($conn) . "\n";  
    }
}

function crear_tabla_carrera($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS carreras (
        id_carrera,
        nombre
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_planes_estudio($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS planes_estudio (
        id_plan SERIAL PRIMARY KEY,
        id_carrera INTEGER REFERENCES carreras(id_carrera) ON DELETE CASCADE,
        codigo_plan VARCHAR(10) UNIQUE NOT NULL,
        fecha_inicio DATE NOT NULL,
        jornada VARCHAR(10) NOT NULL CHECK (jornada IN ('DIURNA', 'VESPERTINA')),
        modalidad VARCHAR(10) NOT NULL CHECK (modalidad IN ('PRESENCIAL', 'ONLINE', 'HIBRIDA')),
        sede VARCHAR(20) NOT NULL CHECK (sede IN ('HOGWARTS', 'BEAUXBATON', 'UAGADOU')),
        nombre_plan VARCHAR(20) NOT NULL CHECK (sede IN ('HOGWARTS', 'BEAUXBATON'),
        grado_plan VARCHAR(50) NOT NULL CHECK (grado_plan IN 'PROGRAMA ESPECIAL DE LICENCIATURA', 'PREGRADO', 'POSTGRADO'))
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_cursos($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS cursos (
        id_curso SERIAL PRIMARY KEY,
        sigla VARCHAR(10) UNIQUE NOT NULL,
        nombre VARCHAR(255),
        caracter VARCHAR(50),
        nivel INT,
        ciclo VARCHAR(10)
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_historial_academico($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS historiales_academicos (
        id_historial SERIAL PRIMARY KEY,
        id_estudiante SERIAL,
        id_curso,
        nota,
        calificacion,
        descripcion
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_departamentos($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS departamentos (
        codigo_departamento,
        nombre_departamento
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_facultades($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS facultades (
        id_facultad,
        nombre_facultad ,
        codigo_departamento
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_oferta_academica($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS oferta_academica (
        id_oferta ,
        id_curso,
        vacantes,
        sala,
        modulo_horario,
        periodo,
        seccion,
        nombre_profesor
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

function crear_tabla_prerrequisitos($conn) {
    $sql = "CREATE TABLE IF NOT EXISTS prerrequisitos (
        id_prerrequisito,
        id_curso,
        sigla,
        ciclo
    )";

    $result = pg_query($conn, $sql);

    if ($result) {
        echo "Tabla creada correctamente\n";
    } else {
        echo "Error creando la tabla: ".pg_last_error($conn) . "\n";
    }
}

?>

