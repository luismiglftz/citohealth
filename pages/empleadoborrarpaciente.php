<?php
    include_once "../backend/functions.php";
    include_once "../backend/procesarlogin.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Eliminar paciente</title>
</head>
<body>
<?php include_once "../templates/header.php"; ?>
<center>
    <?php
    
        $DNI = $_SESSION['DNI'];
        $empleado = obtenerEmpleado($DNI);

        if (!$empleado) {
            echo "<h1>Error: Empleado no encontrado</h1>";
            exit;
        }

        $pacientes = obtenerPacientes($empleado['EMPLE_COD']);
        $tienePacientes = comprobarPacientesAsignados($empleado['EMPLE_COD']);

    ?>
        <h2>¿Que paciente deseas eliminar?</h2>

    <!---SELECT PARA SELECCIONAR PACIENTE CON TODAS LOS PACIENTE DISPONIBLES-->

    <form method="post" action="" name="select_paciente" class="bloque eliminarpaciente">
        
        <select name="seleccion">
        
            <?php foreach ($pacientes as $paciente) { ?>
       
                <option value="<?php echo $paciente['PAC_DNI'] ?>"><?php echo $paciente['PAC_APE'] . ', ' . $paciente['PAC_NOM']; ?></option>
        
            <?php } ?>

        </select>
        <button type="submit" name="elim" value="elim" class="enviar registro eliminar">Eliminar este paciente</button>
    
    </form> 


</center>

    <?php include_once "../templates/footer.php"; ?>


</body>
</html>