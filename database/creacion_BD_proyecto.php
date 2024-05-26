<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación Base de Datos</title>
</head>
<body>
<?php

// CREACION DE VARIABLES PARA CONECTAR A LA BD
$BD = 'CitoHealth';
$servidor = 'localhost';
$usuario = 'root';
$password = '';
$conexion = mysqli_connect($servidor, $usuario, $password);

// EN EL CASO DE QUE NO EXISTA LA BASE DE DATOS SE CREA
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE IF NOT EXISTS $BD";
if (mysqli_query($conexion, $sql)) {
    echo "Base de datos del proyecto creada con éxito! <br>";
} else {
    die("Ha ocurrido un error: " . mysqli_error($conexion));
}

// SELECCIONAMOS LA BASE DE DATOS CREADA:
mysqli_select_db($conexion, $BD) or die("No se pudo seleccionar la base de datos: " . mysqli_error($conexion));


// PROCEDE A CREARSE LAS TABLAS:

// CREACION TABLA DE USUARIOS
$USUARIOS = "CREATE TABLE USUARIOS (
    USER_ID       INT(10) PRIMARY KEY AUTO_INCREMENT,
    USER_DNI      VARCHAR(9) NOT NULL,
    USER_NOM      VARCHAR(20) NOT NULL,
    USER_APE      VARCHAR(50) NOT NULL,
    USER_COD_POSTAL INT(4) NOT NULL,
    USER_DIR      VARCHAR(100) NOT NULL,
    USER_TEL      INT(9) NOT NULL,
    USER_NAC      DATE NOT NULL,
    USER_MAIL     VARCHAR(50) NOT NULL,
    USER_PASS     VARCHAR(30) NOT NULL,
    USER_ROL      ENUM('EMPLEADO', 'PACIENTE') NOT NULL,
    EMPLE_SUELDO  INT(10),
    EMPLE_PUE     VARCHAR(20),
    PAC_CIU       VARCHAR(50),
    PAC_PROV      VARCHAR(50),
    DEP_COD       INT(10)
)";

if (mysqli_query($conexion, $USUARIOS)) {
    echo "Tabla usuarios creada correctamente. <br>";
} else {
    echo "La tabla usuarios no se ha creado correctamente. <br>";
}

// CREACION TABLA DEPARTAMENTOS
$DEPARTAMENTOS = "CREATE TABLE DEPARTAMENTOS(
    DEP_COD       INT(10) PRIMARY KEY NOT NULL,
    DEP_NOM       VARCHAR(20) NOT NULL,
    DEP_JEFE      VARCHAR(20) NOT NULL,
    DEP_CONS      INT(1) NOT NULL
)";

if (mysqli_query($conexion, $DEPARTAMENTOS)) {
    echo "Tabla departamentos creada correctamente. <br>";
} else {
    echo "La tabla departamentos no se ha creado correctamente. <br>";
}

// CREACION TABLA HISTORIAL
$HISTORIAL = "CREATE TABLE HISTORIAL(
    COD_HIS       INT(10) PRIMARY KEY AUTO_INCREMENT,
    PAC_DNI       VARCHAR(9) NOT NULL,
    HIS_FEC       DATE NOT NULL,
    HIS_DESC      VARCHAR(400) NOT NULL,
    EMPLE_COD     INT(10) NOT NULL
)";

if (mysqli_query($conexion, $HISTORIAL)) {
    echo "Tabla historial creada correctamente. <br>";
} else {
    echo "La tabla historial no se ha creado correctamente. <br>";
}

// CREACION TABLA TRATAMIENTOS
$TRATAMIENTOS = "CREATE TABLE TRATAMIENTOS(
    TRAT_COD      INT(3) PRIMARY KEY AUTO_INCREMENT,
    TRAT_FEC      DATE NOT NULL,
    PAC_DNI       VARCHAR(9) NOT NULL,
    EMPLE_COD     INT(10) NOT NULL,
    TRAT_DESC     VARCHAR(500) NOT NULL
)";

if (mysqli_query($conexion, $TRATAMIENTOS)) {
    echo "Tabla tratamientos creada correctamente. <br>";
} else {
    echo "La tabla tratamientos no se ha creado correctamente. <br>";
}

// CREACION TABLA CITAS
$CITAS = "CREATE TABLE CITAS(
    CITA_COD      INT(10) PRIMARY KEY AUTO_INCREMENT,
    PAC_DNI       VARCHAR(9) NOT NULL,
    EMPLE_COD     INT(10) NOT NULL,
    CITA_FEC      DATE NOT NULL,
    CITA_AFEC     VARCHAR(200) NOT NULL,
    CITA_TIPO     INT(1) NOT NULL
)";

if (mysqli_query($conexion, $CITAS)) {
    echo "Tabla citas creada correctamente. <br>";
} else {
    echo "La tabla citas no se ha creado correctamente. <br>";
}

// AÑADIMOS LAS CLAVES FORANEAS
$cons1 = "ALTER TABLE USUARIOS ADD CONSTRAINT fk_med_dep FOREIGN KEY (DEP_COD) REFERENCES DEPARTAMENTOS(DEP_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons1);

$cons2 = "ALTER TABLE HISTORIAL ADD CONSTRAINT fk_pac_his FOREIGN KEY (PAC_DNI) REFERENCES USUARIOS(USER_DNI) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons2);

$cons3 = "ALTER TABLE HISTORIAL ADD CONSTRAINT fk_med_his FOREIGN KEY (EMPLE_COD) REFERENCES USUARIOS(USER_ID) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons3);

$cons4 = "ALTER TABLE TRATAMIENTOS ADD CONSTRAINT fk_med_trat FOREIGN KEY (EMPLE_COD) REFERENCES USUARIOS(USER_ID) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons4);

$cons5 = "ALTER TABLE TRATAMIENTOS ADD CONSTRAINT fk_pac_trat FOREIGN KEY (PAC_DNI) REFERENCES USUARIOS(USER_DNI) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons5);

$cons6 = "ALTER TABLE CITAS ADD CONSTRAINT fk_med_cit FOREIGN KEY (EMPLE_COD) REFERENCES USUARIOS(USER_ID) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons6);

$cons7 = "ALTER TABLE CITAS ADD CONSTRAINT fk_pac_cit FOREIGN KEY (PAC_DNI) REFERENCES USUARIOS(USER_DNI) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons7);

?>
</body>
</html>
