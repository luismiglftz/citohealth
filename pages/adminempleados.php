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
    <title>Empleados</title>
</head>
<body id="info" class="pacienteslista separar">
<?php include_once "../templates/header.php"; ?>
<center>

    <?php 
    $DNI = $_SESSION["DNI_SESSION"];

        $conexion = conectarBD();
        $empleados = obtenerEmpleados();
    
    ?>

    <div class="padrecontenedor">
        <table id="tabla">
            <tr>
                <td>Codigo</td>
                <td>DNI</td>
                <td>Nombre</td>
                <td>Telefono</td>
                <td>Correo electronico</td>
                <td>Puesto</td>
                <td>Sueldo</td>
                <td>Departamento</td>
            </tr>
            <?php foreach ($empleados as $empleado) { ?>
                <tr>
                    <?php
                        $depCdo = $empleado['DEP_COD'];
                        $dep = "SELECT DEP_NOM, DEP_COD FROM DEPARTAMENTOS WHERE DEP_COD = '$depCdo';";
                        $infoDep = mysqli_query($conexion,$dep);
                        $infoDepArray = mysqli_fetch_row($infoDep);
                    ?>
                    <td><?php echo $empleado['EMPLE_COD']; ?></td>
                    <td><?php echo $empleado['EMPLE_DNI']; ?></td>
                    <td><?php echo $empleado['EMPLE_APE'] . ", " . $empleado['EMPLE_NOM']; ?></td>
                    <td><?php echo $empleado['EMPLE_TEL']; ?></td>
                    <td><?php echo $empleado['EMPLE_MAIL']; ?></td>
                    <td><?php echo $empleado['EMPLE_PUE']; ?></td>
                    <td><?php echo $empleado['EMPLE_SUELDO']; ?></td>
                    <td><?php echo $infoDepArray[0] . " (" . $infoDepArray[1] . ")"; ?></td>
                    <!-- PARA EDITARPACIENTE -->
                    <td>
                        <a href="admineditarempleado.php?dniemple=<?php echo $empleado['EMPLE_DNI']; ?>" class="editar">Editar</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <div class="desplazamientoTablas" id="despTablas">
            <img src="../assets/media/flecha.png" onclick="anteriorPagina()">
            <p id="infoPagina"></p>
            <img src="../assets/media/flecha.png" onclick="siguientePagina()">
        </div>

        <!--BOTONES-->
        <div>
            <a href="admincrearempleado.php" class="registro">Añadir empleado</a>
            <a href="adminborrarempleado.php" class="registro">Eliminar empleado</a>
        </div>
    </div>
    </center>
<?php include_once "../templates/footer.php"; ?>


<script src="../assets/js/functions.js"></script>

</body>
</html>
