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



//PROCEDE A CREARSE LAS TABLAS:

//CREACION TABLA DE EMPLEADOS

$EMPLEADOS= "CREATE TABLE EMPLEADOS(
    EMPLE_COD          INT(3) PRIMARY KEY NOT NULL,
    EMPLE_DNI          VARCHAR(9) NOT NULL,
    EMPLE_NOM          VARCHAR(20) NOT NULL,
    EMPLE_APE          VARCHAR(50) NOT NULL,
    EMPLE_COD_POSTAL   INT(4) NOT NULL,
    EMPLE_DIR          VARCHAR(100) NOT NULL,
    EMPLE_TEL          INT(9) NOT NULL,
    EMPLE_NAC          DATE NOT NULL,
    EMPLE_MAIL         VARCHAR(50) NOT NULL,
    EMPLE_SUELDO       INT(10) NOT NULL,
    EMPLE_PUE          VARCHAR(20) NOT NULL,
    EMPLE_PASS         VARCHAR(30) NOT NULL,
    EMPLE_ROL          ENUM('EMPLEADO', 'ADMIN') NOT NULL,
    DEP_COD            INT(10) NOT NULL
)";


if(mysqli_query($conexion, $EMPLEADOS)){
    echo "Tabla empleados creada correctamente. <br>";
}else{
    echo "La tabla empleados no se ha creado correctamente. <br>";
}



//CREACION TABLA DEPARTAMENTOS

$DEPARTAMENTOS= "CREATE TABLE DEPARTAMENTOS(
    DEP_COD             INT(10) PRIMARY KEY NOT NULL,
    DEP_NOM             VARCHAR(20) NOT NULL,
    DEP_JEFE            VARCHAR(20) NOT NULL,
    DEP_CONS            INT(1) NOT NULL
)";

if(mysqli_query($conexion, $DEPARTAMENTOS)){
    echo "Tabla departamentos creada correctamente. <br>";
}else{
    echo "La tabla departamentos no se ha creado correctamente. <br>";
}


//CREACION TABLA DE PACIENTES

$PACIENTES= "CREATE TABLE PACIENTES(
    PAC_DNI             VARCHAR(9)PRIMARY KEY NOT NULL,
    PAC_NOM             VARCHAR(20) NOT NULL,
    PAC_APE             VARCHAR(50) NOT NULL,
    PAC_COD_POSTAL      INT(4) NOT NULL,
    PAC_DIRECCION       VARCHAR(100) NOT NULL,
    PAC_CIU             VARCHAR(50) NOT NULL,
    PAC_PROV            VARCHAR(50) NOT NULL,
    PAC_TEL             INT(9) NOT NULL,
    PAC_MAIL            VARCHAR(50) NOT NULL,
    PAC_FEC_NAC         date NOT NULL,
    PAC_PASS            VARCHAR(30) NOT NULL,
    EMPLE_COD           INT(3) NOT NULL
)";

if(mysqli_query($conexion, $PACIENTES)){
    echo "Tabla pacientes creada correctamente. <br>";
}else{
    echo "La tabla pacientes no se ha creado correctamente. <br>";
}


//CREACION TABLA DE PACIENTES

$PACIENTES_RESPALDO= "CREATE TABLE PACIENTES_RESPALDO(
    PAC_DNI             VARCHAR(9)PRIMARY KEY NOT NULL,
    PAC_NOM             VARCHAR(20) NOT NULL,
    PAC_APE             VARCHAR(50) NOT NULL,
    PAC_COD_POSTAL      INT(4) NOT NULL,
    PAC_DIRECCION       VARCHAR(100) NOT NULL,
    PAC_CIU             VARCHAR(50) NOT NULL,
    PAC_PROV            VARCHAR(50) NOT NULL,
    PAC_TEL             INT(9) NOT NULL,
    PAC_MAIL            VARCHAR(50) NOT NULL,
    PAC_FEC_NAC         date NOT NULL,
    PAC_PASS            VARCHAR(30) NOT NULL,
    EMPLE_COD           INT(3) NOT NULL
)";

if(mysqli_query($conexion, $PACIENTES_RESPALDO)){
    echo "Tabla de respaldo de pacientes creada correctamente. <br>";
}else{
    echo "La tabla de respaldo de pacientes no se ha creado correctamente. <br>";
}
//CREACION TABLA HISTORIAL

$HISTORIAL= "CREATE TABLE HISTORIAL(
    COD_HIS              INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    PAC_DNI              VARCHAR(9) NOT NULL,
    HIS_FEC              date NOT NULL,
    HIS_DESC             VARCHAR(400) NOT NULL,
    EMPLE_COD            INT(3) NOT NULL
)";

if(mysqli_query($conexion, $HISTORIAL)){
    echo "Tabla historial creada correctamente. <br>";
}else{
    echo "La tabla historial no se ha creado correctamente. <br>";
}

//CREACION TABLA TRATAMIENTOS

$TRATAMIENTOS= "CREATE TABLE TRATAMIENTOS(
    TRAT_COD            INT(3) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    TRAT_FEC            date NOT NULL,
    PAC_DNI             VARCHAR(9) NOT NULL,
    EMPLE_COD           INT(3) NOT NULL,
    TRAT_DESC           VARCHAR(500) NOT NULL
)";

if(mysqli_query($conexion, $TRATAMIENTOS)){
    echo "Tabla tratamientos creada correctamente. <br>";
}else{
    echo "La tabla tratamientos no se ha creado correctamente. <br>";
}

//CREACION TABLA CITAS

$CITAS= "CREATE TABLE CITAS(
    CITA_COD            INT(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    PAC_DNI             VARCHAR(9) NOT NULL,
    EMPLE_COD           INT(3) NOT NULL,
    CITA_FEC            date NOT NULL,
    CITA_AFEC           VARCHAR(200) NOT NULL,
    CITA_TIPO           INT(1) NOT NULL
)";

if(mysqli_query($conexion, $CITAS)){
    echo "Tabla citas creada correctamente. <br>";
}else{
    echo "La tabla citas no se ha creado correctamente. <br>";
}

// CREACION TABLA FARMACOS
$FARMACOS = "CREATE TABLE FARMACOS(
    FARM_COD      INT(10) PRIMARY KEY AUTO_INCREMENT,
    FARM_NOM      VARCHAR(50) NOT NULL,
    FARM_DESC     VARCHAR(200) NOT NULL
)";

if (mysqli_query($conexion, $FARMACOS)) {
    echo "Tabla fármacos creada correctamente. <br>";
} else {
    echo "La tabla fármacos no se ha creado correctamente. <br>";
}

// CREACION TABLA TRATAMIENTOS_FARMACOS
$TRATAMIENTOS_FARMACOS = "CREATE TABLE TRATAMIENTOS_FARMACOS(
    TRAT_COD      INT(3) NOT NULL,
    FARM_COD      INT(10) NOT NULL,
    PRIMARY KEY (TRAT_COD, FARM_COD)
)";

if (mysqli_query($conexion, $TRATAMIENTOS_FARMACOS)) {
    echo "Tabla tratamientos_fármacos creada correctamente. <br>";
} else {
    echo "La tabla tratamientos_fármacos no se ha creado correctamente. <br>";
}


//AÑADIMOS LAS CLAVES FORANEAS...

$cons1 = "ALTER TABLE PACIENTES ADD CONSTRAINT fk_med_pac FOREIGN KEY (EMPLE_COD) REFERENCES EMPLEADOS(EMPLE_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons1);

$cons2 = "ALTER TABLE HISTORIAL ADD CONSTRAINT fk_pac_his FOREIGN KEY (PAC_DNI) REFERENCES PACIENTES(PAC_DNI) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons2);

$cons3 = "ALTER TABLE TRATAMIENTOS ADD CONSTRAINT fk_med_trat FOREIGN KEY (EMPLE_COD) REFERENCES EMPLEADOS(EMPLE_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons3);

$cons4 = "ALTER TABLE TRATAMIENTOS ADD CONSTRAINT fk_pac_trat FOREIGN KEY (PAC_DNI) REFERENCES PACIENTES(PAC_DNI) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons4);

$cons5 = "ALTER TABLE CITAS ADD CONSTRAINT fk_med_cit FOREIGN KEY (EMPLE_COD) REFERENCES EMPLEADOS(EMPLE_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons5);

$cons6 = "ALTER TABLE CITAS ADD CONSTRAINT fk_pac_cit FOREIGN KEY (PAC_DNI) REFERENCES PACIENTES(PAC_DNI) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons6);

$cons7 = "ALTER TABLE EMPLEADOS ADD CONSTRAINT fk_med_dep FOREIGN KEY (DEP_COD) REFERENCES DEPARTAMENTOS(DEP_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons7);

$cons8 = "ALTER TABLE HISTORIAL ADD CONSTRAINT fk_med_his FOREIGN KEY (EMPLE_COD) REFERENCES EMPLEADOS(EMPLE_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion,$cons8);

$cons9 = "ALTER TABLE TRATAMIENTOS_FARMACOS ADD CONSTRAINT fk_trat_farm_trat FOREIGN KEY (TRAT_COD) REFERENCES TRATAMIENTOS(TRAT_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons9);

$cons10 = "ALTER TABLE TRATAMIENTOS_FARMACOS ADD CONSTRAINT fk_trat_farm_farm FOREIGN KEY (FARM_COD) REFERENCES FARMACOS(FARM_COD) ON DELETE CASCADE ON UPDATE CASCADE;";
mysqli_query($conexion, $cons10);



//AÑADIMOS DATOS A LAS TABLAS PARA PRUEBAS (con ayuda de ChatGPT)

//INSERTAMOS EN DEPARTAMENTOS
$insertar = "INSERT INTO DEPARTAMENTOS (DEP_COD, DEP_NOM, DEP_JEFE, DEP_CONS) VALUES 
(1,'Direccion','Abraham Lincoln',1),
(2,'Pediatria','Alexander Fleming',2),
(3,'Psiquiatria','Edward Jenner',3),
(4,'Oftalmología','Sigmund Freud',4),
(5,'Geriatria','Elizabeth Blackwell',5),
(6,'Administracion','Donald Trump',6)"; 
mysqli_query($conexion,$insertar);

//INSERTAMOS EN EMPLEADOS
$insertarEMPLE = "INSERT INTO EMPLEADOS (EMPLE_COD, EMPLE_DNI, EMPLE_NOM, EMPLE_APE, EMPLE_COD_POSTAL, EMPLE_DIR, EMPLE_TEL, EMPLE_NAC, EMPLE_SUELDO, EMPLE_MAIL, EMPLE_PUE, EMPLE_PASS, EMPLE_ROL, DEP_COD) 
VALUES 
(201, '12345678A', 'Meredith', 'Grey', 11300, 'Calle Principal, 1', 600123456, '1980-01-01', 2000, 'meredith@hospital.com', 'Cirugía', 'meredith123', 'ADMIN', 2), 
(202, '87654321B', 'Derek', 'Shepherd', 11300, 'Calle Secundaria, 2', 600654321, '1975-07-18', 2500, 'derek@hospital.com', 'Neurocirugía', 'derek123', 'EMPLEADO', 3),
(203, '56789012C', 'Miranda', 'Bailey', 11300, 'Avenida Siempre, 3', 600567890, '1968-02-22', 2200, 'miranda@hospital.com', 'Cirugía General', 'miranda123', 'EMPLEADO', 2),
(204, '21098765D', 'Gregory', 'House', 11300, 'Calle Enfermedades, 4', 600210987, '1959-06-11', 3000, 'house@hospital.com', 'Diagnóstico', 'house123', 'EMPLEADO', 3),
(205, '34567890E', 'James', 'Wilson', 11300, 'Pasaje Oncología, 5', 600345678, '1969-09-22', 2400, 'wilson@hospital.com', 'Oncología', 'wilson123', 'EMPLEADO', 4),
(206, '23456789F', 'Allison', 'Cameron', 11300, 'Calle Medicina, 6', 600234567, '1978-03-28', 2100, 'cameron@hospital.com', 'Inmunología', 'cameron123', 'EMPLEADO', 4),
(207, '65432109G', 'Eric', 'Foreman', 11300, 'Avenida Diagnóstico, 7', 600654321, '1973-12-15', 2300, 'foreman@hospital.com', 'Neurología', 'foreman123', 'EMPLEADO', 3),
(208, '78901234H', 'Robert', 'Chase', 11300, 'Calle Cirugía, 8', 600789012, '1975-08-14', 2200, 'chase@hospital.com', 'Cirugía', 'chase123', 'EMPLEADO', 2)";
mysqli_query($conexion,$insertarEMPLE);

//INSERTAMOS EN PACIENTES
$insertarPAC = "INSERT INTO PACIENTES (PAC_DNI, PAC_NOM, PAC_APE, PAC_COD_POSTAL, PAC_DIRECCION, PAC_CIU, PAC_PROV, PAC_TEL, PAC_MAIL, PAC_FEC_NAC, PAC_PASS, EMPLE_COD) 
VALUES 
('15433080B', 'Luis Miguel', 'Fernández Fentánez', 11300, 'URBANIZACION JULIAN SANCHEZ', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '606773346', 'luismiguel@gmail.com', '1992-05-12', 'Luis99', '201'),
('34234243E', 'Irene', 'Cabeza Chacón', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '452452345', 'irene@gmail.com', '1999-05-13', 'Irene99', '202'),
('23423424T', 'Iván', 'Ocaña Heredia', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '345734571', 'ivan@gmail.com', '1994-05-10', 'Ivan99', '203'),
('42342344F', 'Jemuel', 'Agsaway', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '134564577', 'jemuel@gmail.com', '1993-02-19', 'Jemuel99', '204'),
('37346734H', 'Adrián', 'Sanchez Pascual', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '867234554', 'adrian@gmail.com', '1993-06-17', 'Adrian99', '205'),
('85845685W', 'Ana', 'Fentanez Sanchez', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '675234511', 'ana@gmail.com', '1993-04-16', 'Ana99', '206'),
('46584568W', 'Miguel', 'Zapata Rodriguez', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '546723623', 'miguel@gmail.com', '1998-09-14', 'Miguel99', '207'),
('45684565E', 'Juan', 'Gomez Espinosa', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '767332564', 'juan@gmail.com', '1996-10-23', 'Juan99', '208'),
('84568456E', 'Alberto', 'Plana Gonzalez', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '324523434', 'alberto@gmail.com', '1995-05-10', 'Alberto99', '201'),
('45684568J', 'Pablo', 'Gonzalez Lara', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '656234524', 'pablo@gmail.com', '1993-02-02', 'Pablo99', '202'),
('45794574E', 'Borja', 'León Galeth', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '341462563', 'borja@gmail.com', '1991-07-05', 'Borja99', '203'),
('23452463H', 'Daniela', 'Ionela Corduneanu', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '562514544', 'daniela@gmail.com', '1992-09-15', 'Daniela99', '204'),
('23412463H', 'Francisco', 'Delgado Sanchez', 11300, 'LOS PISOS', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '3423512532', 'francisco@gmail.com', '1992-09-15', 'Francisco99', '205'),
('34623477R', 'Paloma', 'Ruso Sánchez', 11300, 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '747351234', 'paloma@gmail.com', '2004-02-20', 'Paloma99', '206')";
mysqli_query($conexion,$insertarPAC);

//INSERTAMOS EN HISTORIALES
$insertarHIS = "INSERT INTO HISTORIAL (COD_HIS, PAC_DNI, HIS_FEC, HIS_DESC, EMPLE_COD) 
VALUES 
(NULL, '15433080B', '2023-05-10', 'Dolor de estómago, se le ha recetado paracetamol y agua.', '201'),
(NULL, '15433080B', '2023-05-12', 'Dolor de rodilla, se le ha recomendado reposo.', '201'),
(NULL, '34234243E', '2023-05-12', 'Mareos constantes, se le ha realizado análisis de sangre.', '202'),
(NULL, '84568456E', '2023-05-26', 'Infarto de miocardio, se ha realizado intervención de emergencia.', '204'),
(NULL, '15433080B', '2023-06-01', 'Revisión general, todos los parámetros en rango normal.', '201'),
(NULL, '34234243E', '2023-06-02', 'Control de alergias, se ha ajustado la medicación.', '202'),
(NULL, '23423424T', '2023-06-05', 'Chequeo postoperatorio, la herida está cicatrizando bien.', '203'),
(NULL, '42342344F', '2023-06-10', 'Consulta de seguimiento, el paciente muestra mejoría.', '204'),
(NULL, '37346734H', '2023-06-15', 'Evaluación de tratamiento, el paciente está respondiendo bien a la quimioterapia.', '205'),
(NULL, '85845685W', '2023-06-20', 'Revisión de medicación, se ha cambiado a inmunomoduladores.', '206'),
(NULL, '46584568W', '2023-06-25', 'Evaluación de síntomas, se ha detectado una mejora significativa.', '207'),
(NULL, '45684565E', '2023-06-30', 'Control post cirugía, el paciente ha sido dado de alta.', '208'),
(NULL, '84568456E', '2023-07-01', 'Consulta de emergencia por dolor abdominal, se ha recetado analgésicos.', '204'),
(NULL, '45684568J', '2023-07-05', 'Chequeo de salud, todos los parámetros en rango normal.', '205'),
(NULL, '45794574E', '2023-07-10', 'Revisión de herida, se ha aplicado antibiótico.', '203'),
(NULL, '23452463H', '2023-07-15', 'Control de dolor, se ha aumentado la dosis de analgésicos.', '204'),
(NULL, '23412463H', '2023-07-20', 'Evaluación psicológica, el paciente está respondiendo bien a la terapia.', '205'),
(NULL, '34623477R', '2023-07-25', 'Consulta de seguimiento, se ha observado una mejoría en los síntomas.', '206'),
(NULL, '15433080B', '2023-07-30', 'Chequeo de rutina, el paciente está en buen estado de salud.', '201'),
(NULL, '34234243E', '2023-08-01', 'Consulta de alergias, se ha ajustado la medicación.', '202'),
(NULL, '23423424T', '2023-08-05', 'Chequeo postoperatorio, la herida está cicatrizando bien.', '203'),
(NULL, '42342344F', '2023-08-10', 'Control de tratamiento, se ha observado una mejoría.', '204'),
(NULL, '37346734H', '2023-08-15', 'Evaluación de terapia, el paciente está respondiendo bien.', '205'),
(NULL, '85845685W', '2023-08-20', 'Revisión de síntomas, se ha cambiado la medicación.', '206'),
(NULL, '46584568W', '2023-08-25', 'Consulta de seguimiento, se ha observado una mejora significativa.', '207'),
(NULL, '45684565E', '2023-08-30', 'Control post cirugía, el paciente ha sido dado de alta.', '208'),
(NULL, '84568456E', '2023-09-01', 'Evaluación médica, el paciente está en buen estado de salud.', '204'),
(NULL, '45684568J', '2023-09-05', 'Consulta de emergencia por dolor abdominal, se ha recetado analgésicos.', '205'),
(NULL, '45794574E', '2023-09-10', 'Revisión de tratamiento, se ha ajustado la medicación.', '203'),
(NULL, '23452463H', '2023-09-15', 'Control de dolor, se ha aumentado la dosis de analgésicos.', '204'),
(NULL, '23412463H', '2023-09-20', 'Evaluación psicológica, el paciente está respondiendo bien a la terapia.', '205'),
(NULL, '34623477R', '2023-09-25', 'Consulta de seguimiento, se ha observado una mejoría en los síntomas.', '206'),
(NULL, '15433080B', '2023-09-30', 'Chequeo de rutina, el paciente está en buen estado de salud.', '201'),
(NULL, '34234243E', '2023-10-01', 'Consulta de alergias, se ha ajustado la medicación.', '202'),
(NULL, '23423424T', '2023-10-05', 'Chequeo postoperatorio, la herida está cicatrizando bien.', '203'),
(NULL, '42342344F', '2023-10-10', 'Control de tratamiento, se ha observado una mejoría.', '204'),
(NULL, '37346734H', '2023-10-15', 'Evaluación de terapia, el paciente está respondiendo bien.', '205'),
(NULL, '85845685W', '2023-10-20', 'Revisión de síntomas, se ha cambiado la medicación.', '206'),
(NULL, '46584568W', '2023-10-25', 'Consulta de seguimiento, se ha observado una mejora significativa.', '207'),
(NULL, '45684565E', '2023-10-30', 'Control post cirugía, el paciente ha sido dado de alta.', '208')";
mysqli_query($conexion, $insertarHIS);


//INSERTAMOS EN CITAS
$insertarCIT = "INSERT INTO CITAS (CITA_COD, PAC_DNI, EMPLE_COD, CITA_FEC, CITA_AFEC, CITA_TIPO) 
VALUES 
(NULL, '15433080B', '201', '2023-05-10', 'Dolor de estómago', 1), 
(NULL, '15433080B', '201', '2023-05-10', 'Dolor de rodilla', 1),
(NULL, '34234243E', '202', '2023-05-12', 'Mareos constantes', 1),
(NULL, '84568456E', '204', '2023-05-26', 'Infarto de miocardio', 2),
(NULL, '15433080B', '201', '2023-06-01', 'Revisión general', 1),
(NULL, '34234243E', '202', '2023-06-02', 'Control de alergias', 1),
(NULL, '23423424T', '203', '2023-06-05', 'Chequeo postoperatorio', 1),
(NULL, '42342344F', '204', '2023-06-10', 'Consulta de seguimiento', 1),
(NULL, '37346734H', '205', '2023-06-15', 'Evaluación de tratamiento', 2),
(NULL, '85845685W', '206', '2023-06-20', 'Revisión de medicación', 1),
(NULL, '46584568W', '207', '2023-06-25', 'Evaluación de síntomas', 2),
(NULL, '45684565E', '208', '2023-06-30', 'Control post cirugía', 1),
(NULL, '84568456E', '204', '2023-07-01', 'Consulta de emergencia', 1),
(NULL, '45684568J', '205', '2023-07-05', 'Chequeo de salud', 2),
(NULL, '45794574E', '203', '2023-07-10', 'Revisión de herida', 1),
(NULL, '23452463H', '204', '2023-07-15', 'Control de dolor', 2),
(NULL, '23412463H', '205', '2023-07-20', 'Evaluación psicológica', 1),
(NULL, '34623477R', '206', '2023-07-25', 'Consulta de seguimiento', 2),
(NULL, '15433080B', '201', '2023-07-30', 'Chequeo de rutina', 1),
(NULL, '34234243E', '202', '2023-08-01', 'Consulta de alergias', 1),
(NULL, '23423424T', '203', '2023-08-05', 'Chequeo postoperatorio', 1),
(NULL, '42342344F', '204', '2023-08-10', 'Control de tratamiento', 2),
(NULL, '37346734H', '205', '2023-08-15', 'Evaluación de terapia', 1),
(NULL, '85845685W', '206', '2023-08-20', 'Revisión de síntomas', 2),
(NULL, '46584568W', '207', '2023-08-25', 'Consulta de seguimiento', 1),
(NULL, '45684565E', '208', '2023-08-30', 'Control post cirugía', 1),
(NULL, '84568456E', '204', '2023-09-01', 'Evaluación médica', 2),
(NULL, '45684568J', '205', '2023-09-05', 'Consulta de emergencia', 1),
(NULL, '45794574E', '203', '2023-09-10', 'Revisión de tratamiento', 1),
(NULL, '23452463H', '204', '2023-09-15', 'Control de dolor', 2),
(NULL, '23412463H', '205', '2023-09-20', 'Evaluación psicológica', 1),
(NULL, '34623477R', '206', '2023-09-25', 'Consulta de seguimiento', 2),
(NULL, '15433080B', '201', '2023-09-30', 'Chequeo de rutina', 1),
(NULL, '34234243E', '202', '2023-10-01', 'Consulta de alergias', 1),
(NULL, '23423424T', '203', '2023-10-05', 'Chequeo postoperatorio', 1),
(NULL, '42342344F', '204', '2023-10-10', 'Control de tratamiento', 2),
(NULL, '37346734H', '205', '2023-10-15', 'Evaluación de terapia', 1),
(NULL, '85845685W', '206', '2023-10-20', 'Revisión de síntomas', 2),
(NULL, '46584568W', '207', '2023-10-25', 'Consulta de seguimiento', 1),
(NULL, '45684565E', '208', '2023-10-30', 'Control post cirugía', 1)";
mysqli_query($conexion,$insertarCIT);


//INSERTAMOS EN TRATAMIENTOS
$insertarTRAT = "INSERT INTO TRATAMIENTOS (TRAT_COD, TRAT_FEC, PAC_DNI, EMPLE_COD, TRAT_DESC) 
VALUES 
(NULL, '2023-05-10', '15433080B', '201', 'PARACETAMOL Y AGUA'), 
(NULL, '2023-05-12', '15433080B', '201', 'IBUPROFENO Y AGUA'),
(NULL, '2023-06-15', '34234243E', '202', 'ANTIHISTAMÍNICO Y DESCANSO'),
(NULL, '2023-06-20', '23423424T', '203', 'ANTIBIÓTICO Y LIMPIEZA DE HERIDA'),
(NULL, '2023-06-25', '42342344F', '204', 'ANALGÉSICO Y TERAPIA FÍSICA'),
(NULL, '2023-07-01', '37346734H', '205', 'QUIMIOTERAPIA'),
(NULL, '2023-07-10', '85845685W', '206', 'INMUNOMODULADOR'),
(NULL, '2023-07-15', '46584568W', '207', 'CORTICOSTEROIDES'),
(NULL, '2023-07-20', '45684565E', '208', 'CIRUGÍA MENOR'),
(NULL, '2023-08-01', '84568456E', '204', 'ANALGÉSICO Y REPOSO'),
(NULL, '2023-08-05', '45684568J', '205', 'QUIMIOTERAPIA'),
(NULL, '2023-08-10', '45794574E', '203', 'ANTIBIÓTICO Y REPOSO'),
(NULL, '2023-08-15', '23452463H', '204', 'ANALGÉSICO Y FISIOTERAPIA'),
(NULL, '2023-08-20', '23412463H', '205', 'QUIMIOTERAPIA'),
(NULL, '2023-08-25', '34623477R', '206', 'INMUNOMODULADOR Y REPOSO')";
mysqli_query($conexion,$insertarTRAT);

// FARMACOS
$insertarFARM = "INSERT INTO FARMACOS (FARM_NOM, FARM_DESC) 
VALUES 
('Paracetamol', 'Analgésico y antipirético'), 
('Ibuprofeno', 'Anti-inflamatorio no esteroideo'),
('Antihistamínico', 'Tratamiento de alergias'),
('Antibiótico', 'Tratamiento de infecciones bacterianas'),
('Analgésico', 'Alivio del dolor'),
('Quimioterapia', 'Tratamiento del cáncer'),
('Inmunomodulador', 'Modulación del sistema inmunitario'),
('Corticosteroides', 'Reducción de la inflamación'),
('Anestesia', 'Suministro de anestesia para cirugías menores'),
('Antidepresivo', 'Tratamiento de la depresión'),
('Antipirético', 'Reducción de la fiebre'),
('Anticoagulante', 'Prevención de la coagulación sanguínea'),
('Antiepiléptico', 'Tratamiento de la epilepsia'),
('Broncodilatador', 'Apertura de las vías respiratorias'),
('Diurético', 'Incremento de la producción de orina'),
('Laxante', 'Alivio del estreñimiento'),
('Antipsicótico', 'Tratamiento de trastornos psicóticos')";
mysqli_query($conexion,$insertarFARM);


// INSERTAMOS EN TRATAMIENTOS_FARMACOS
$insertarTRAT_FARM = "INSERT INTO TRATAMIENTOS_FARMACOS (TRAT_COD, FARM_COD)
VALUES 
(1, 1), 
(2, 2), 
(3, 3),
(4, 2),
(5, 3),
(6, 4),
(7, 5),
(8, 6),
(9, 7),
(10, 8),
(11, 9),
(12, 10),
(13, 11),
(14, 12),
(15, 13)";

mysqli_query($conexion, $insertarTRAT_FARM);

//AHORA VAMOS MEDIANTE LA API DE OPENFDA A INSERTAR DATOS DE FARMACOS PARA TENER EN LA BASE DE DATOS:
$url = "https://api.fda.gov/drug/label.json?limit=100";
//OBTENEMOS EL CONTENIDO JSON DESDE LA URL PROPORCIONADA
$json = file_get_contents($url);
// DECODIFICAMOS EL JSON A UN ARRAY ASOCIATIVO DE PHP ASI LOS PODEMOS TRATAR COMO UN ARRAY
$data = json_decode($json, true);
//print_r($data);
//GUARDAMOS LOS DATOS QUE NOS DEVUELVE LA API (RESULTS)
$farmacos = $data['results'];
//print_r($farmacos);

// POR CADA MEDICAMENTO RECIBIDO...
foreach ($farmacos as $farmaco) {
    //PARA SOLO METER LOS MEDICAMENTOS QUE TIENEN DATOS
    if (!empty($farmaco['openfda']['generic_name'][0]) && !empty($farmaco['description'][0])) {
        //TENEMOS QUE PREPARAR LA CONSULTA PUES HAY FARMACOS QUE TIENEN CARACTERES ESPECIALES QUE
        //PUEDEN CAUSAR ERRORES EN LA SINTAXIS DE SQL
        //TODO: ESTUDIAR AGREGAR ESTO AL RESTO DEL CODIGO PARA EVITAR INYECCIONES DE SQL
        // NOMBRE
        $nombre = mysqli_real_escape_string($conexion, $farmaco['openfda']['generic_name'][0]);
        // DESCRIPCIÓN
        $descripcion = mysqli_real_escape_string($conexion, $farmaco['description'][0]);

        // INSERTAMOS LOS DATOS
        $query = "INSERT INTO FARMACOS (FARM_NOM, FARM_DESC) VALUES ('$nombre', '$descripcion')";
       if(mysqli_query($conexion, $query)){
        
       }else{
        echo "Error al insertar el farmaco: " . $nombre;
       }
    }
}


//CREAMOS UN TRIGGER PARA EL RESPALDO DE LOS PACIENTES

$triggerpac = "CREATE TRIGGER CS_PACIENTES BEFORE DELETE ON PACIENTES FOR EACH ROW INSERT INTO PACIENTES_RESPALDO 
            VALUES (OLD.PAC_DNI,OLD.PAC_NOM,OLD.PAC_APE,OLD.PAC_COD_POSTAL,OLD.PAC_DIRECCION, OLD.PAC_CIU, OLD.PAC_PROV, OLD.PAC_TEL,OLD.PAC_MAIL,OLD.PAC_FEC_NAC,OLD.PAC_PASS,OLD.EMPLE_COD)";

mysqli_query($conexion,$triggerpac);
?>


</body>
</html>

