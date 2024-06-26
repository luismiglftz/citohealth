<?php
    include_once ("../backend/functions.php");
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Ver citas</title>
</head>
<body id="infocitas">
<?php include_once "../templates/header.php"; ?>
    <?php
    $citas = obtenerCitas();

    if (empty($citas)) {
        echo "<h2>NO HAY NINGUNA CITA A TU NOMBRE</h2>";
        echo "<a href='pedir-cita.php' class='registro'>Solicitar cita</a>";
    }else{
        ?>
        <div class="padrecontenedor">
            <table id="tabla">
                <tr>
                    <td>Código</td>
                    <td>Médico</td>
                    <td>Fecha</td>
                    <td>Tipo de cita</td>
                    <td>Motivo de la cita</td>
                </tr>
                <?php
                foreach ($citas as $cita){
                    ?>
                    <tr>
                        <td><?php echo $cita["CITA_COD"]; ?></td>
                        <td><?php echo $cita["EMPLE_NOM_APE"] . " (" . $cita["EMPLE_COD"] . ")"; ?></td>
                        <td><?php echo $cita["CITA_FEC"]; ?></td>
                        <td>
                            <?php
                            switch ($cita["CITA_TIPO"]){
                                case 1:
                                    echo "Presencial en la clínica";
                                    break;
                                case 2:
                                    echo "Visita a casa";
                                    break;
                            }
                            ?>
                        </td>
                        <td><?php echo $cita["CITA_AFEC"]; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <div class="desplazamientoTablas" id="despTablas">
                <img src="../assets/media/flecha.png" onclick="anteriorPagina()">
                <p id="infoPagina"></p>
                <img src="../assets/media/flecha.png" onclick="siguientePagina()">
            </div>
            <a href="pacientespedircita.php" class="registro">Solicitar cita</a>
        </div>
        <?php
    }
    ?>

<?php include_once "../templates/footer.php"; ?>
<script src="../assets/js/functions.js"></script>
</body>
</html>