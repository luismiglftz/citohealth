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



//AÑADIMOS DATOS A LAS TABLAS PARA PRUEBAS:

//INSERTAMOS EN DEPARTAMENTOS
$insertar = "INSERT INTO DEPARTAMENTOS (DEP_COD, DEP_NOM, DEP_JEFE, DEP_CONS) VALUES (1,'Direccion','Abraham Lincoln',1),
                                                                                    (2,'Pediatria','Alexander Fleming',2),
                                                                                    (3,'Psiquiatria','Edward Jenner',3),
                                                                                    (4,'Oftalmología','Sigmund Freud',4),
                                                                                    (5,'Geriatria','Elizabeth Blackwell',5),
                                                                                    (6,'Administracion','Donald Trump',6)"; 
mysqli_query($conexion,$insertar);


//INSERTAMOS EN EMPLEADOS
$insertarEMPLE = "INSERT INTO EMPLEADOS (EMPLE_COD,EMPLE_DNI, EMPLE_NOM, EMPLE_APE, EMPLE_COD_POSTAL, EMPLE_DIR, EMPLE_TEL, EMPLE_NAC, EMPLE_SUELDO, EMPLE_MAIL, EMPLE_PUE, EMPLE_PASS, EMPLE_ROL, DEP_COD) 
VALUES (102, '76684328B', 'Alexander', 'Fleming Perez', 11300, 'Calle Granada, 84', 606123467, '1992-05-12', 1200, 'Alejandro@citohealth.com', 'Pediatria', 'Alejandro99', 'EMPLEADO', 2), 
        (103, '87264829Z', 'Hipocrates', 'Perez Rodriguez', 11300, 'Avenida España, 4', 345234545, '1999-05-13', 1600, 'hipo@citohealth.com', 'Pediatria', 'hipopo99', 'EMPLEADO', 2),
        (104, '34678345Y', 'Edward', 'Jenner Gómez', 11300, 'Calle Luna, 43', 562427563, '1994-05-10', 1600, 'edu@citohealth.com', 'Psiquiatria', 'edu99', 'EMPLEADO', 3),
        (105, '23455235T', 'William', 'Osler Morillo', 11300, 'Calle Sacra, 12', 767231178, '1993-02-19', 1600, 'william@citohealth.com', 'Psiquiatria', 'will99', 'EMPLEADO', 3),
        (106, '23456734P', 'Sigmund', 'Freud Sánchez', 11300, 'Avenida Avecina, 84', 785327656, '1993-06-17', 1600, 'sigmund@citohealth.com', 'Oftalmología', 'sigmund99', 'EMPLEADO', 4),
        (107, '23457986L', 'Louis', 'Pastteur Ruso', 11300, 'Pasaje Grecia, 8', 786785257, '1998-09-14', 1600, 'louis@citohealth.com', 'Oftalmología', 'louis99', 'EMPLEADO', 4),
        (108, '34567843Z', 'Elizabeth', 'Blackwell del Rio', 11300, 'Urbanización Portugal, 14', 397137569, '2004-02-20', 1600, 'elizabeth@citohealth.com', 'Geriatria', 'eli99', 'EMPLEADO', 5),
        (109, '32425523P', 'Merit', 'Ptah Castaño', 11300, 'Avenida Besteiro, 11', 243452467, '1995-05-10', 1600, 'merit@citohealth.com', 'Geriatria', 'merit99', 'EMPLEADO', 5),
        (101, '23467724L', 'Abraham', 'Lincoln Vega', 11300, 'Urbanización Rio Gande, 31', 143856731, '2004-02-20', 1600, 'elizabeth@citohealth.com', 'Presidente', 'potus99', 'ADMIN', 1),
        (110, '23455467U', 'Christian', 'Bale Mateo', 11300, 'Calle Venecia, 90', 135273632, '2004-02-20', 1600, 'elizabeth@citohealth.com', 'Recepcion', 'cris99', 'EMPLEADO', 6),
        (111, '76643539H', 'Donald', 'Trump Valero', 11300, 'Pasaje China, 68', 753632154, '2004-02-20', 1600, 'elizabeth@citohealth.com', 'Administrador', 'Don99', 'EMPLEADO', 6)"; 
mysqli_query($conexion,$insertarEMPLE);

//INSERTAMOS EN PACIENTES

$insertarPAC = "INSERT INTO PACIENTES (PAC_DNI, PAC_NOM, PAC_APE, PAC_COD_POSTAL, PAC_DIRECCION, PAC_CIU, PAC_PROV, PAC_TEL, PAC_MAIL, PAC_FEC_NAC, PAC_PASS, EMPLE_COD) 
VALUES ('15433080B', 'Luis Miguel ', 'Fernández Fentánez', '11300', 'URBANIZACION JULIAN SANCHEZ', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '606773346', 'luismiguel@gmail.com', '1992-05-12', 'Luis99', '102'),
        ('34234243E', 'Irene ', 'Cabeza Chacon', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '452452345', 'pedro@gmail.com', '1999-05-13', 'pedro99', '102'),
        ('23423424T', 'Iván ', 'Ocaña Heredia', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '345734571', 'irene@gmail.com', '1994-05-10', 'irene99', '102'),
        ('42342344F', 'Jemuel ', 'Agsaway', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '134564577', 'fran@gmail.com', '1993-02-19', 'fran99', '102'),
        ('37346734H', 'Adrián ', 'Sanchez Pascual', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '867234554', 'raquel@gmail.com', '1993-06-17', 'raquel99', '102'),
        ('85845685W', 'Ana ', 'Fentanez Sanchez', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '675234511', 'ana@gmail.com', '1993-04-16', 'ana99', '103'),
        ('46584568W', 'Miguel ', 'Zapata Rodriguez', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '546723623', 'miguel@gmail.com', '1998-09-14', 'miguel99', '103'),
        ('45684565E', 'Juan ', 'Gomez Espinosa', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '767332564', 'juan@gmail.com', '1996-10-23', 'juan99', '103'),
        ('84568456E', 'Alberto ', 'Plana Gonzalez', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '324523434', 'alberto@gmail.com', '1995-05-10', 'alberto99', '103'),
        ('45684568J', 'Pablo ', 'Gonzalez Lara', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '656234524', 'pablo@gmail.com', '1993-02-2', 'pablo99', '104'),
        ('45794574E', 'Borja ', 'León Galeth', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '341462563', 'borja@gmail.com', '1991-07-5', 'borja99', '105'),
        ('23452463H', 'Daniela ', 'Ionela Corduneanu', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '562514544', 'daniela@gmail.com', '1992-09-15', 'daniela99', '106'),
        ('23412463H', 'Francisco', 'Delgado Sanchez', '11300', 'LOS PISOS', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '3423512532', 'frandealante@gmail.com', '1992-09-15', 'fran99', '106'),
        ('34623477R', 'Paloma ', 'Ruso Sánchez', '11300', 'AVENIDA ANDALUCIA', 'LA LINEA DE LA CONCEPCION', 'CADIZ', '747351234', 'paloma@gmail.com', '2004-02-20', 'paloma99', '107')";
mysqli_query($conexion,$insertarPAC);


//INSERTAMOS EN HISTORIALES

$insertarHIS = "INSERT INTO HISTORIAL (COD_HIS, PAC_DNI, HIS_FEC, HIS_DESC, EMPLE_COD) 
VALUES (NULL, '15433080B', '2022-05-10', 'Ha presentado dolor en la zona abdominal, y se le ha recetado paracetamol y mucha agua.', '101'),
        (NULL, '15433080B', '2022-05-12', 'Se ha caido y ha presentado dolor en la zona de la cabeza, ademas de sangrado', '101'),
        (NULL, '23423424T', '2022-05-12', 'Gases', '101'),
        (NULL, '23423424T', '2022-05-12', 'Cortes profundos en la yema de los dedos debido a cables', '101'),
        (NULL, '34623477R', '2022-05-12', 'Ha presentado dolor de cabeza, y se le ha recetado paracetamol y mucha agua', '107');";

mysqli_query($conexion,$insertarHIS);

//INSERTAMOS EN CITAS

$insertarCIT = "INSERT INTO CITAS (CITA_COD, PAC_DNI, EMPLE_COD, CITA_FEC, CITA_AFEC, CITA_TIPO) 
                            VALUES (NULL, '15433080B', '101', '2022-05-10', 'Dolor de estomago', 1), 
                                    (NULL, '15433080B', '101', '2022-05-10', 'Dolor de rodilla', 1),
                                    (NULL, '34234243E', '101', '2022-05-12', 'Mareos constantes', 1),
                                    (NULL, '84568456E', '104', '2022-05-26', 'Infarto de miocardio', 2);";

mysqli_query($conexion,$insertarCIT);

//INSERTAMOS EN TRATAMIENTOS

$insertarTRAT = "INSERT INTO TRATAMIENTOS (TRAT_COD,TRAT_FEC, PAC_DNI, EMPLE_COD, TRAT_DESC)
                                    VALUES (NULL, '2022-05-10', '15433080B', '101', 'PARACETAMOL Y AGUA'), 
                                            (NULL, '2022-05-12', '15433080B', '101', 'IBUPROFENO Y AGUA');";

mysqli_query($conexion,$insertarTRAT);



// FARMACOS
$insertarFARM = "INSERT INTO FARMACOS (FARM_NOM, FARM_DESC)
                                    VALUES ('Paracetamol', 'Analgesico y antipiretico'),
                                        ('Ibuprofeno', 'Anti-inflamatorio no esteroideo');";

mysqli_query($conexion,$insertarFARM);


// TRATAMIENTOS_FARMACOS
$insertarTRAT_FARM = "INSERT INTO TRATAMIENTOS_FARMACOS (TRAT_COD, FARM_COD)
                                    VALUES (1,1),
                                        (2,2);";

mysqli_query($conexion,$insertarTRAT_FARM);

//AHORA VAMOS MEDIANTE LA API DE OPENFDA A INSERTAR DATOS DE FARMACOS PARA TENER EN LA BASE DE DATOS:
$url = "https://api.fda.gov/drug/label.json?limit=1000";
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
        // NOMBRE
        $nombre = $farmaco['openfda']['generic_name'][0];
        // DESCRIPCIÓN
        $descripcion = $farmaco['description'][0];

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

