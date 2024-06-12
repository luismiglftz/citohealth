<?php
include_once "../backend/functions.php";
verificarSesion();

// Obtener todos los fármacos
$farmacos = obtenerFarmacos();

if(isset($_GET['tratdni'])) {
    $_SESSION['DNI_PAC_TRAT'] = $_GET['tratdni'];

} else {
    echo "DNI del paciente no proporcionado";
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
    <title>Crear tratamiento</title>
</head>
<body id="info corto" class="pacienteslista separar">
<?php include_once "../templates/header.php"; ?>

<!--FORMULARIO DE CREACION:-->
<div class="padrecontenedor crearpac">
    <form method="post" action="" name="inicio_sesion" class="bloque">
        <div class="elemento-form">
            <label>Descripción:</label> <br>
            <input type="textarea" name="desc" required />
        </div>
        <div class="elemento-form">
            <label>Fecha:</label> <br>
            <input type="date" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>" name="fec"/>
        </div>
        <div class="elemento-form">
            <label>Farmacos:</label> <br>
                <select name="farmacos[]" multiple required>
                    <?php foreach ($farmacos as $farmaco) { ?>
                        <option value="<?php echo $farmaco['FARM_COD']; ?>"><?php echo $farmaco['FARM_NOM']; ?></option>
                    <?php } ?>
                </select>
        </div>
        <button type="submit" name="creartrat" value="creartrat" class="botonreg">Crear tratamiento</button>
    </form>
</div>
<?php include_once "../templates/footer.php"; ?>
<script src="../assets/js/functions.js"></script>
</body>
</html>
