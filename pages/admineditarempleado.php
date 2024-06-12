<?php
include_once "../backend/functions.php";
verificarSesion();


//RECOGEMOS LA VARIABLE QUE SE LE HA PASADO POR URL
if (isset($_GET['dniemple'])) {
    $empleDNI = $_GET['dniemple'];
    obtenerDatosEmpleado($empleDNI);
} else {
    echo "DNI del empleado no proporcionado";
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
    <title>Editar empleado</title>
</head>
<body id="infopers">
<?php include_once "../templates/header.php"; ?>
<div class="padrecontenedor">
    <h2>Actualizar Información</h2>
    <form method="post" action="" name="chg_info" class="form">
            <div class="linea_form">
                <label for="cod">Código de empleado:</label>
                <input type="text" id="cod" name="cod" value="<?php echo $_SESSION["EMPLE_COD_SEL"]; ?>" readonly>
            </div>
        <div class="linea_form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION["EMPLE_NOM"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $_SESSION["EMPLE_APE"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?php echo $_SESSION["EMPLE_DNI"]; ?>"required>
        </div>
        <div class="linea_form">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $_SESSION["EMPLE_TEL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION["EMPLE_MAIL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $_SESSION["EMPLE_NAC"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" value="<?php echo $_SESSION["EMPLE_COD_POSTAL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $_SESSION["EMPLE_DIR"]; ?>" required>
        </div>
            <div class="linea_form">
                <label for="provincia">Sueldo:</label>
                <input type="text" id="sueldo" name="sueldo" value="<?php echo $_SESSION["EMPLE_SUELDO"] . "€"; ?>"required>
            </div>
            <div class="linea_form">
                <label for="provincia">Puesto:</label>
                <input type="text" id="puesto" name="puesto" value="<?php echo $_SESSION["EMPLE_PUE"]; ?>">
            </div>
            <div class="linea_form">
                <label for="provincia">Departamento:</label>
                <input type="text" id="departamento" name="departamento" value="<?php echo $_SESSION["EMPLE_DEP"]; ?>"required>
            </div>
            <div class="linea_form">
            <label for="provincia">Contraseña:</label>
            <input type="password" id="password" name="password" value="<?php echo $_SESSION["EMPLE_PASS"]; ?>" required>
            <div class="mostrarPass">
                <input type="checkbox" onclick="mostrarPass(this)" class="mostrarPass"><p>Mostrar contraseña</p>
            </div>
        </div>

        <button type="submit" name="submitCambiosAdmin" class="submitCambiosAdmin">Actualizar Información</button>
    </form>
</div>
<?php include_once "../templates/footer.php"; ?>
<script src="../assets/js/functions.js"></script>
</body>
</html>