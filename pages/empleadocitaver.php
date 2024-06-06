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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Citas</title>
</head>
<?php include_once "../templates/header.php"; ?>

<body id="info" class="pacienteslista separar">
    <center>
    <form method="post" action="" name="select_paciente" class="bloque">
        <select name="seleccion">
            <?php foreach ($pacientes as $paciente) { ?>
                <option value="<?php echo $paciente['PAC_DNI']; ?>">
                    <?php echo $paciente['PAC_APE'] . ", " . $paciente['PAC_NOM'] . " (" . $paciente['PAC_DNI'] . ")"; ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit" name="sel" value="sel" class="seleccion">Consultar este usuario</button>
    </form>

    <?php
    if (isset($_POST['sel'])) {
        $seleccion = $_POST['seleccion'];
        $_SESSION['DNI_PAC_TRAT'] = $seleccion;

        // Obtener el nombre y apellido del paciente seleccionado
        $pacienteSeleccionado = obtenerPaciente($seleccion);
        $nombre = $pacienteSeleccionado['PAC_NOM'] . " " . $pacienteSeleccionado['PAC_APE'];


        $citas = obtenerCitasPaciente($seleccion);

        $conexion = conectarBD();
        $compdniPaciente = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$seleccion';";
        $registroPaciente = mysqli_query($conexion, $compdniPaciente);
        

    ?>
        <div class="padrecontenedor">
            <h2> <?php echo $nombre ;  ?></h2>
            <table>
                <tr>
                    <td>Código</td>
                    <td>Paciente</td>
                    <td>Medico que lo atendió</td>
                    <td>Fecha de la cita</td>
                    <td>Motivo de la cita</td>
                    <td>Tipo de cita</td>
                </tr>
                <?php foreach ($citas as $cita) { ?>
                    <tr>
                        <td><?php echo $cita['CITA_COD']; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $empleado['EMPLE_APE'] . ", " . $empleado['EMPLE_NOM'] . " (" . $cita['EMPLE_COD'] . ")"; ?></td>
                        <td><?php echo $cita['CITA_FEC']; ?></td>
                        <td><?php echo $cita['CITA_AFEC']; ?></td>
                        <td>
                            <?php
                            switch ($cita['CITA_TIPO']) {
                                case 1:
                                    echo "Presencial en la clínica";
                                    break;
                                case 2:
                                    echo "Visita a casa";
                                    break;
                            }
                            ?>
                        </td>
                        <td>
                            <a href="../backend/functions.php?eliminarcita=true&citaCod=<?php echo $cita['CITA_COD']; ?>" class="enviar">Eliminar</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
            <div>
                <a href="empleadocitacrear.php?" class="registro">Añadir nueva cita</a>
            </div>
        </div>
    <?php } ?>

    <?php include_once "../templates/footer.php"; ?>
    </center>
</body>
</html>
