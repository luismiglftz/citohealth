<?php
include_once "../backend/functions.php";
verificarSesion();
obtenerDatosUsuarios();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Información personal</title>
</head>
<body id="infopers">
<?php include_once "../templates/header.php"; ?>
<div class="padrecontenedor">
    <h2>Actualizar Información Personal</h2>
    <form method="post" action="" name="chg_info" class="form">
        <?php if($_SESSION["ROL_SESSION"] == 'EMPLEADO' ||$_SESSION["ROL_SESSION"] == 'ADMIN' ){ ?>
            <div class="linea_form">
                <label for="cod">Código de empleado:</label>
                <input type="text" id="cod" name="cod" value="<?php echo $_SESSION["EMPLE_COD"]; ?>" readonly>
            </div>
        <?php } ?>

        <div class="linea_form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $_SESSION["USER_NOM"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?php echo $_SESSION["USER_APE"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" value="<?php echo $_SESSION["DNI_SESSION"]; ?>" readonly>
        </div>
        <div class="linea_form">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" value="<?php echo $_SESSION["USER_TEL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION["USER_MAIL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $_SESSION["USER_NAC"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" value="<?php echo $_SESSION["USER_COD_POSTAL"]; ?>" required>
        </div>
        <div class="linea_form">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo $_SESSION["USER_DIR"]; ?>" required>
        </div>

        <?php if ($_SESSION["ROL_SESSION"] == 'PACIENTE'){ ?>
            <div class="linea_form">
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" value="<?php echo $_SESSION["USER_CIU"]; ?>" required>
            </div>
            <div class="linea_form">
                <label for="provincia">Provincia:</label>
                <input type="text" id="provincia" name="provincia" value="<?php echo $_SESSION["USER_PROV"]; ?>" required>
            </div>
            <div class="linea_form">
                <label for="medico_cabecera">Médico de Cabecera:</label>
                <input type="text" id="medico_cabecera" name="medico_cabecera" value="<?php echo $_SESSION["MED_CAB"]; ?>" readonly>
            </div>
        <?php }elseif($_SESSION["ROL_SESSION"] == 'EMPLEADO' || $_SESSION["ROL_SESSION"] == 'ADMIN' ){ ?>
            <div class="linea_form">
                <label for="provincia">Sueldo:</label>
                <input type="text" id="sueldo" name="sueldo" value="<?php echo $_SESSION["USER_SUELDO"] . "€"; ?>" readonly>
            </div>
            <div class="linea_form">
                <label for="provincia">Puesto:</label>
                <input type="text" id="puesto" name="puesto" value="<?php echo $_SESSION["USER_PUE"]; ?>" readonly>
            </div>
            <div class="linea_form">
                <label for="provincia">Departamento:</label>
                <input type="text" id="departamento" name="departamento" value="<?php echo $_SESSION["USER_DEP"]; ?>" readonly>
            </div>
        <?php } ?>


        <button type="submit" name="submitCambios" class="submitCambios">Actualizar Información</button>
    </form>
    <a href="../pages/globalrestablecerpass.php" class="reset-password">Restablecer Contraseña</a>
</div>
<?php include_once "../templates/footer.php"; ?>
</body>
</html>