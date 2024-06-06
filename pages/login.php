<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Login</title>
</head>
<body id="login">
    <div class="padrecontenedor">
        <div class="logo">
            <img src="../assets/media/logo.png" alt="logo" height="200px">
        </div>
        <div class="errores" id="errores">
            <?php
                if (isset($_SESSION["error"])) {
                    echo "<div id='errores' class='errores'>" . $_SESSION["error"] . "</div>";
                    unset($_SESSION["error"]); // LIMPIAR MENSAJE DE ERROR
                }
            ?>
        </div>
        <div class="contenedorform">
            <form method="post" action="../backend/procesarlogin.php" name="inicio_sesion">
                <div class="elemento-form">
                    <label>DNI:</label> <br>
                    <input type="text" name="DNI" pattern="[a-zA-Z0-9]+" required />
                </div>
                <div class="elemento-form">
                    <label>Contraseña:</label> <br>
                    <input type="password" name="pass" required />
                </div>
                <button type="submit" name="login" value="login" class="botonlog">Iniciar sesión</button>
            </form>
            <div class="registro">
                <h1>¿No tienes cuenta?</h1>
                <a href="registro.php" class="registro">Regístrate aquí</a>
            </div>
        </div>
    </div>
</body>
</html>
