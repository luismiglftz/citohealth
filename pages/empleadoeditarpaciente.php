<?php
include_once "../backend/functions.php";
verificarSesion();


//RECOGEMOS LA VARIABLE QUE SE LE HA PASADO POR URL
if (isset($_GET['dnipac'])) {
    $pacienteDNI = $_GET['dnipac'];
    obtenerDatosPaciente($pacienteDNI);
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
    <title>Información del paciente</title>
</head>
<body id="infopers">
<?php include_once "../templates/header.php"; ?>
<div class="padrecontenedor">
    <h2>Actualizar Información Personal</h2>
    <form method="post" action="" name="chg_info" class="form">

        <div class="linea_form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION["PAC_NOM"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $_SESSION["PAC_APE"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?php echo $_SESSION["DNI"]; ?>" readonly>
        </div>
        <div class="linea_form">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $_SESSION["PAC_TEL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION["PAC_MAIL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $_SESSION["PAC_NAC"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" value="<?php echo $_SESSION["PAC_COD_POSTAL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $_SESSION["PAC_DIR"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" value="<?php echo $_SESSION["PAC_CIU"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" value="<?php echo $_SESSION["PAC_PROV"]; ?>" required>
        </div>
        <?php if ($_SESSION["PAC_ROL"] == 'PACIENTE'){ ?>
            <div class="linea_form">
                <label for="medico_cabecera">Médico de Cabecera:</label>
                <input type="text" id="medico_cabecera" name="medico_cabecera" value="<?php echo $_SESSION["PAC_MED"]; ?>" readonly>
            </div>
        <?php } ?>
        <div class="linea_form">
            <label for="provincia">Contraseña:</label>
            <input type="password" id="password" name="password" value="<?php echo $_SESSION["PAC_PASS"]; ?>" required>
            <div class="mostrarPass">
                <input type="checkbox" onclick="mostrarPass(this)" class="mostrarPass"><p>Mostrar contraseña</p>
            </div>
        </div>

        <button type="submit" name="submitCambiosEmpleados" class="submitCambiosEmpleados">Actualizar Información</button>
    </form>
</div>
<?php include_once "../templates/footer.php"; ?>
<script src="../assets/js/functions.js"></script>

</body>
</html>