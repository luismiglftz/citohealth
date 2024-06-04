<?php
    include_once "../backend/functions.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Pacientes</title>
</head>
<body id="info" class="pacienteslista separar">
<?php include_once "../templates/header.php"; ?>
<center>

    <?php 
    $DNI = $_SESSION["DNI_SESSION"];
    $empleado = obtenerEmpleado($DNI);


    $pacientes = obtenerPacientes($empleado['EMPLE_COD']);
    $tienePacientes = comprobarPacientesAsignados($empleado['EMPLE_COD']);

    if (!$tienePacientes) {
        echo "<h1>NO TIENES NINGUN PACIENTE A TU NOMBRE</h1>";
        ?>
        <div>
            <a href="empleadocrearpaciente.php" class="registro">Añadir paciente</a>
        </div>
        <?php
        exit;
    }
    ?>

    <div class="padrecontenedor">
        <table>
            <tr>
                <td>DNI</td>
                <td>Nombre</td>
                <td>Fecha de nacimiento</td>
                <td>Telefono</td>
                <td>Direccion de correo</td>
                <td>Codigo Postal</td>
                <td>Direccion</td>
                <td>Ciudad</td>
                <td>Provincia</td>
            </tr>
            <?php foreach ($pacientes as $paciente) { ?>
                <tr>
                    <td><?php echo $paciente['PAC_DNI']; ?></td>
                    <td><?php echo $paciente['PAC_APE'] . ", " . $paciente['PAC_NOM']; ?></td>
                    <td><?php echo $paciente['PAC_FEC_NAC']; ?></td>
                    <td><?php echo $paciente['PAC_TEL']; ?></td>
                    <td><?php echo $paciente['PAC_MAIL']; ?></td>
                    <td><?php echo $paciente['PAC_COD_POSTAL']; ?></td>
                    <td><?php echo $paciente['PAC_DIRECCION']; ?></td>
                    <td><?php echo $paciente['PAC_CIU']; ?></td>
                    <td><?php echo $paciente['PAC_PROV']; ?></td>
                    <!-- PARA EDITARPACIENTE -->
                    <td>
                        <a href="empleadoeditarpaciente.php?dnipac=<?php echo $paciente['PAC_DNI']; ?>" class="editar">Editar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <!--BOTONES-->
        <div>
            <a href="empleadocrearpaciente.php" class="registro">Añadir paciente</a>
            <a href="empleadoborrarpaciente.php" class="registro">Eliminar paciente</a>
        </div>
    </div>
    </center>
<?php include_once "../templates/footer.php"; ?>

</body>
</html>
