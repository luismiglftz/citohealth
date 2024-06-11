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
<?php 
    if(isset($_GET['citadni'])) {
        $_SESSION['DNI_PAC_CIT'] = $_GET['citadni'];

    } else {
        echo "DNI del paciente no proporcionado";
        exit;
    }
?>
<div class="padrecontenedor crearpac">
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
            <button type="submit" name="enviarCitaEmple" value="enviarCitaEmple" class="botonlog">Solicitar cita</button>
        </form>
</div>


            <?php include_once "../templates/footer.php"; ?>
            <script src="../assets/js/functions.js"></script>
</body>
</html>