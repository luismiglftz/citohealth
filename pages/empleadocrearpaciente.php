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
    <title>Crear paciente</title>
</head>
<body id="registroPAC" class="regpac">
<?php include_once "../templates/header.php"; ?>

<!--FORMULARIO PARA RELLENAR LOS DATOS CON LOS NUEVO USUARIOS-->
<div class="padrecontenedor">
    <form method="post" action="" name="registrarPaciente" class="form">
        <div class="linea_form">
            <label for="DNI">DNI:</label>
            <input type="text" id="DNI" name="DNI" required required>
        </div>
        <div class="linea_form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="linea_form">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
        </div>
        <div class="linea_form">
            <label for="telefono">Teléfono:</label>
            <input type="text" id="telefono" name="telefono" required>
        </div>
        <div class="linea_form">
            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="linea_form">
            <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
        </div>
        <div class="linea_form">
            <label for="codigo_postal">Código Postal:</label>
            <input type="text" id="codigo_postal" name="codigo_postal" required>
        </div>
        <div class="linea_form">
            <label for="direccion">Dirección:</label>
            <input type="text" id="direccion" name="direccion" required>
        </div>
        <div class="linea_form">
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" required>
        </div>
        <div class="linea_form">
            <label for="provincia">Provincia:</label>
            <input type="text" id="provincia" name="provincia" required>
        </div>
        <div class="linea_form">
            <label for="pass">Contraseña:</label>
            <input type="password" id="pass" name="pass" required>
        </div>
        <div class="linea_form">
            <label for="passv">Confirmar contraseña:</label>
            <input type="password" id="passv" name="passv" required>
        </div>
        <button type="submit" name="registerpac" value="registerpac" class="botonreg">Registrar paciente</button>
    </form>
    <?php include_once "../templates/footer.php"; ?>

</body>
</html>