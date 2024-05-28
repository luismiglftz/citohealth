<?php
    include "../backend/functions.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Pedir cita</title>
</head>
<body id="cita">
<?php 
//CONEXION A LA BASE DE DATO Y GUARDADO VARIABLE DNI INICIO SESION
session_start();

$DNI=$_SESSION['DNI'];

$nombreBD='GeoHealth';

$servidor='localhost';

$usuario='root';

$password='';


$conexion=mysqli_connect($servidor,$usuario,$password);

mysqli_select_db($conexion,$nombreBD);

//CONSULTA TABLA PACIENTES
$compdni = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$DNI';";

$infopac=mysqli_query($conexion,$compdni);

$info=mysqli_fetch_row($infopac);


        //PASAMOS LAS VARIABLES
$nom=$info[1];

$ape=$info[2];

$emplecod=$info[11];


//CUANDO SE PULSA EL BOTON ENVIAR SE INSERTAN LOS DATOS
if (isset($_POST['enviar'])) {

    //PASAMOS LAS VARIABLES QUE SE VAN A NECESITAR
    $fec=$_POST['fec'];
    $afec=$_POST['afec'];
    $tipo=$_POST['tipo'];

    //SE INSERTAN LOS DATOS Y REDIRIGE
    $insertarCIT = "INSERT INTO `citas` (`CITA_COD`, `PAC_DNI`, `EMPLE_COD`, `CITA_FEC`, `CITA_AFEC`, `CITA_TIPO`) 

    VALUES (NULL, '$DNI', '$emplecod', '$fec', '$afec', '$tipo');";

    mysqli_query($conexion,$insertarCIT);

    header('location: ver-citas.php');
}

?>
<!--FORMULARIO-->
<div class="padrecontenedor">
    <div class="contenedorform">
        <form method="post" action="" name="pedir_cita">
            <div class="elemento-form">
                <label>Fecha:</label> <br>
                <input type="date" name="fec" value="<?php echo date("Y-m-d");?>" min="<?php echo date("Y-m-d");?>" required />   
            </div>
            <div class="elemento-form">
                <label>Motivo:</label> <br>
                <input type="text" name="afec" required />
            </div>
            <div class="elemento-form">
                <label for="tipo">Tipo de cita:</label> <br>
                <input type="radio" name="tipo" value="1" required>Presencial en la clinica. <br>
                <input type="radio" name="tipo" value="2" required>Desde casa. <br>
            </div>  
            <button type="submit" name="enviar" value="enviar" class="botonlog">Solicitar cita</button>
        </form>
    </div>
</div>
</body>
</html>