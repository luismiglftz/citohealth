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
    <title>Eliminar empleado</title>
</head>
<body>
<?php include_once "../templates/header.php"; ?>
<center>
    <?php
    
        $DNI = $_SESSION["DNI_SESSION"];
        $empleados = obtenerEmpleados();

    ?>
        <h2>¿Que empleado deseas eliminar?</h2>

    <!---SELECT PARA SELECCIONAR PACIENTE CON TODAS LOS PACIENTE DISPONIBLES-->

    <form method="post" action="" name="select_empleado" class="bloque eliminarpaciente">
        
        <select name="seleccion">
        
            <?php foreach ($empleados as $empleado) { ?>
       
                <option value="<?php echo $empleado['EMPLE_COD'] ?>"><?php echo $empleado['EMPLE_APE'] . ', ' . $empleado['EMPLE_NOM']; ?></option>
        
            <?php } ?>

        </select>
        <button type="submit" name="elimEmple" value="elimEmple" class="enviar registro eliminar">Eliminar este empleado</button>
    
    </form> 


</center>

    <?php include_once "../templates/footer.php"; ?>
    <script src="../assets/js/functions.js"></script>


</body>
</html>