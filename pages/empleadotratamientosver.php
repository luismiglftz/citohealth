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



?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Historiales</title>
</head>
<body id="info" class="pacienteslista separar corto">
<?php include_once "../templates/header.php"; ?>
<center>
        <?php
        //SI NO HAY NINGUN PACIENTE A SU NOMBRE SE PARA LA CARGA DE LA PAGINA Y TE PERMITE CREAR UN NUEVO PACIENTE
            if (empty($pacientes)) {
                echo "<h1>NO TIENES NINGUN PACIENTE A TU NOMBRE</h1>";
                echo '<div><a href="empleadocrearpaciente.php" class="registro">Añadir paciente</a></div>';
                
                include_once "../templates/footer.php";
                exit;
            }
        ?>
    <form method="post" action="" name="select_paciente" class="bloque">
        
        <select name="seleccion">
        
        <?php foreach ($pacientes as $paciente){ ?>
            <option value="<?php echo $paciente['PAC_DNI']; ?>">
                <?php echo $paciente['PAC_APE'] . ", " . $paciente['PAC_NOM'] . " (" . $paciente['PAC_DNI'] . ")"; ?>
            </option>
        <?php } ?>
        </select>
        <button type="submit" name="sel" value="sel" class="seleccion">Consultar este usuario</button>
    
    </form>
    <?php 
    //CUANDO PULSAMOS EL BOTON SEL:
    if(isset($_POST['sel'])){
        $seleccion = $_POST['seleccion'];
        $_SESSION['DNI_PAC_TRAT'] = $seleccion;
        
        $pacienteSeleccionado = obtenerPaciente($seleccion);
        $nombre = $pacienteSeleccionado['PAC_NOM'] . " " . $pacienteSeleccionado['PAC_APE'];

        $tratamientos = obtenerTratamientosPaciente($seleccion);
        ?>
        <!--EMPEZAMOS LA TABLA DONDE IRAN ALMACENADOS LOS DATOS DE LOS PACIENTES PERTENECIENTES AL -->
        <div class="padrecontenedor">
        <h2><?php echo $nombre; ?></h2>
        <table id="tabla">
            <tr>
                <td>Código</td>
                <td>Paciente</td>
                <td>Médico que lo atendió</td>
                <td>Fecha del tratamiento</td>
                <td>Descripción del tratamiento</td>
                <td>Fármacos Recetados</td>
            </tr>
            <?php
            foreach ($tratamientos as $tratamiento) {
                $tratCod = $tratamiento['TRAT_COD'];
                $farmacos = obtenerFarmacosTratamiento($tratCod);
            ?>
            <tr>
                <td><?php echo $tratamiento['TRAT_COD']; ?></td>
                <td><?php echo $nombre; ?></td>
                <td><?php echo $empleado['EMPLE_NOM'] . " " . $empleado['EMPLE_APE']; ?></td>
                <td><?php echo $tratamiento['TRAT_FEC']; ?></td>
                <td><?php echo $tratamiento['TRAT_DESC']; ?></td>
                <td>
                    <ul>
                        <?php foreach ($farmacos as $farmaco) { ?>
                        <li><?php echo $farmaco['FARM_NOM'] . " - " . $farmaco['FARM_DESC']; ?></li>
                        <?php } ?>
                    </ul>
                </td>
                <td><a href="../backend/functions.php?eliminartratamiento=true&tratCod=<?php echo $tratamiento['TRAT_COD']; ?>" class="enviar">Eliminar</a></td>
            </tr>
            <?php } ?>
        </table>
        <!--BOTONES DE AÑADIR NUEVO TRATAMIENTO Y ELIMINAR TRATAMIENTO-->
        <div>
            <a href="empleadotratamientoscrear.php" class="registro">Añadir nuevo tratamiento</a>
        </div>
        <?php } ?>
        </center>
   
        <?php include_once "../templates/footer.php"; ?>
        <script src="../assets/js/functions.js"></script>
</body>
</html>