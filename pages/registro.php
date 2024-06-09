<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Registro</title>
</head>
<body id="registro" class="reg">
<!-- FORMULARIO REGISTRO -->
<div class="padrecontenedor">
    <div class="logo">
        <img src="../assets/media/logo.png" alt="logo" height="200px">
    </div>
    <div class="padrepeque">
        <div class="errores" id="errores">
            <?php
                if (isset($_SESSION["error"])) {
                    echo "<div id='errores' class='errores'>" . $_SESSION["error"] . "</div>";
                    unset($_SESSION["error"]); // LIMPIAR MENSAJE DE ERROR
                }
            ?>
        </div>
        <form method="post" action="../backend/procesarlogin.php" name="registro" class="bloque">
            <div class="columna1">
                <div class="elemento-form">
                    <label>DNI:</label> <br>
                    <input type="text" name="DNI" pattern="[a-zA-Z0-9]+" required />
                </div>
                <div class="elemento-form">
                    <label>Nombre:</label> <br>
                    <input type="text" name="name" required />
                </div>
                <div class="elemento-form">
                    <label>Apellidos:</label> <br>
                    <input type="text" name="ape" required />
                </div>
                <div class="elemento-form">
                    <label>Teléfono:</label> <br>
                    <input type="text" name="tel" required />
                </div>
                <div class="elemento-form">
                    <label>Correo electrónico:</label> <br>
                    <input type="text" name="mail" required />
                </div>
                <div class="elemento-form">
                    <label>Fecha de nacimiento:</label> <br>
                    <input type="date" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>" name="nac" required />
                </div>
            </div>
            <div class="columna2">
                <div class="elemento-form">
                    <label>Código postal:</label> <br>
                    <input type="text" name="pos" required />
                </div>
                <div class="elemento-form">
                    <label>Dirección:</label> <br>
                    <input type="text" name="dir" required />
                </div>
                <div class="elemento-form">
                    <label>Ciudad:</label> <br>
                    <input type="text" name="ciu" required />
                </div>
                <div class="elemento-form">
                    <label>Provincia:</label> <br>
                    <input type="text" name="prov" required />
                </div>
                <div class="elemento-form">
                    <label>Contraseña:</label> <br>
                    <input type="password" name="pass" required />
                    <div class="mostrarPass">
                        <input type="checkbox" onclick="mostrarPass(this)" class="mostrarPass"><p>Mostrar contraseña</p>
                    </div>
                </div>
                <div class="elemento-form">
                    <label>Confirmar contraseña:</label> <br>
                    <input type="password" name="passv" required />
                    <div class="mostrarPass">
                        <input type="checkbox" onclick="mostrarPass(this)" class="mostrarPass"><p>Mostrar contraseña</p>
                    </div>
                </div>
            </div>        
            <button type="submit" name="register" value="register" class="botonreg">Registrarse</button>
        </form>
    </div>
</div>
<a href="login.php" class="registro blanco">Volver atrás</a>

<script src="../assets/js/functions.js"></script>
</body>
</html>
