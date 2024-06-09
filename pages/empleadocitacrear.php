<?php
include_once "../backend/functions.php";
verificarSesion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Crear cita</title>
</head>
<body id="cita" class="pacienteslista separar">
<?php include_once "../templates/header.php"; ?>
<div class="padrecontenedor crearpac">
    <form method="post" action="" name="inicio_sesion" class="bloque">
        <table>
            <tr>
                <td>
                    <label>Descripción: </label>
                </td>
                <td>
                    <label>Fecha: </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="textarea" name="desc" required />
                </td>
                <td>
                    <input type="date" value="<?php echo date("Y-m-d");?>" min="<?php echo date("Y-m-d");?>" name="fec"/>
               </td>
            </tr>
                <td>

                    <label for="tipo">Tipo de cita:</label> <br>

                    <input type="radio" name="tipo" value="1" required>Presencial en la clinica. <br>

                    <input type="radio" name="tipo" value="2" required>Desde casa. <br>

                </td>

                

            </div>
            <tr>
            <td colspan="2">
                    <button type="submit" name="crearCita" value="crearCita" class="botonreg">Crear cita</button>
                </td>
            </tr>
</table>
</form>
</div>


            <?php include_once "../templates/footer.php"; ?>
            <script src="../assets/js/functions.js"></script>
</body>
</html>