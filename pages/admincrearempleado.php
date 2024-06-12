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
    <title>Editar empleado</title>
</head>
<body id="infopers">
<?php include_once "../templates/header.php"; ?>
<div class="padrecontenedor">
    <h2>Actualizar Información</h2>
    <form method="post" action="" name="chg_info" class="form">
        <div class="linea_form">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div class="linea_form">
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required>
        </div>
        <div class="linea_form">
            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required>
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
                <label for="provincia">Sueldo:</label>
                <input type="text" id="sueldo" name="sueldo" required>
            </div>
            <div class="linea_form">
                <label for="provincia">Puesto:</label>
                <input type="text" id="puesto" name="puesto" required>
            </div>
            <div class="linea_form">
                <label for="provincia">Departamento:</label>
                <input type="text" id="departamento" name="departamento" required>
            </div>
            <div class="linea_form">
            <label for="provincia">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <div class="mostrarPass">
                <input type="checkbox" onclick="mostrarPass(this)" class="mostrarPass"><p>Mostrar contraseña</p>
            </div>
        </div>
        <div class="errores" id="errores">
        <?php
            if (isset($_SESSION["error"])) {
                echo "<div id='errores' class='errores'>" . $_SESSION["error"] . "</div>";
                unset($_SESSION["error"]); // LIMPIAR MENSAJE DE ERROR
            }
        ?>
        </div>
        <button type="submit" name="registeremple" class="registeremple">Crear empleado</button>
    </form>
</div>
<?php include_once "../templates/footer.php"; ?>
<script src="../assets/js/functions.js"></script>
</body>
</html>