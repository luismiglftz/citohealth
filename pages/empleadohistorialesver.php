<?php
include_once "../backend/functions.php";
verificarSesion();

// Obtener el DNI del empleado desde la sesión
$DNI = $_SESSION['DNI_SESSION'];
$empleado = obtenerEmpleado($DNI);

if (!$empleado) {
    echo "Error: Empleado no encontrado.";
    exit;
}

$_SESSION['codemple'] = $empleado['EMPLE_COD'];

$pacientes = obtenerPacientes($empleado['EMPLE_COD']);

if (empty($pacientes)) {
    echo "<h1>NO TIENES NINGUN PACIENTE A TU NOMBRE</h1>";
    echo '<div><a href="empleadocrearpaciente.php" class="registro">Añadir paciente</a></div>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Historiales</title>
</head>
<body id="info" class="pacienteslista separar">
<?php include_once "../templates/header.php"; ?>
<center>

    <form method="post" action="" name="select_paciente" class="bloque">
        
        <select name="seleccion">
        
 <?php foreach ($pacientes as $paciente){ ?>
       
        <option value="<?php echo $paciente['PAC_DNI']; ?>">
            <?php echo $paciente['PAC_APE'] . ", " . $paciente['PAC_NOM'] . " (" . $paciente['PAC_DNI'] . ")"; ?>
        </option>
        
    <?php } echo "</select>"?>
        <button type="submit" name="sel" value="sel" class="seleccion">Consultar este usuario</button>
    
    </form>
    <?php 
    //CUANDO PULSAMOS EL BOTON SEL:

    if(isset($_POST['sel'])){
        $seleccion=$_POST['seleccion'];
        
        $pacienteSeleccionado = obtenerPaciente($seleccion);
        $nombre = $pacienteSeleccionado['PAC_NOM'] . " " . $pacienteSeleccionado['PAC_APE'];

        
        $historiales = obtenerHistorialPaciente($seleccion);

        $conexion = conectarBD();
        $compdniPaciente = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$seleccion';";
        $registroPaciente = mysqli_query($conexion, $compdniPaciente);
        

    
        

        ?>
    <!--EMPEZAMOS LA TABLA DONDE IRAN ALMACENADOS LOS DATOS DE LOS PACIENTES PERTENECIENTES AL -->
    
        <div class="padrecontenedor">
        <h2> <?php echo $nombre ;  ?></h2>
    <table>
        <tr>
            <td>Código</td>
            <td>Paciente</td>
            <td>Medico que lo atendió</td>
            <td>Fecha de la visita</td>
            <td>Descripción visita</td>
        </tr>
        <?php
            foreach ($historiales as $historial) {

            ?>
                <!--MOSTRAMOS POR PANTALLAS LAS CITAS QUE TIENE EL EMPLEADO SELECCIONADO-->
            <tr>
                <td> <?php echo $historial['COD_HIS']?></td>
                <td><?php echo $nombre ?></td>
                <td><?php echo $empleado['EMPLE_NOM'] . $empleado['EMPLE_APE'] ?></td>
                <td><?php echo $historial['HIS_FEC']?></td>
                <td><?php echo $historial['HIS_DESC']?></td>
            
                <td><a href="../backend/functions.php?eliminarhistorial=true&hisCod=<?php echo $historial['COD_HIS'] ?>" class="enviar">Eliminar</a></td>
            </tr>
            <?php }  ?>
    </table>
    <!--BOTONES DE AÑADIR NUEVA CITA Y ELIMINAR CITA-->
        <div>
            <a href="empleadohistorialcrear.php" class="registro">Añadir nuevo historial</a>
        </div>

        <?php }  ?>
        </center>
   
        <?php include_once "../templates/footer.php"; ?>
</body>
</html>