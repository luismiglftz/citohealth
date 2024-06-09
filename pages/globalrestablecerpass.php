<?php
    include_once "../backend/functions.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="../assets/js/functions.js"></script>
<link rel="stylesheet" href="../assets/style/style.css">
    <title>Restablecer contraseña</title>
</head>
<body id="login pass">
<?php include_once "../templates/header.php"; ?>
<?php
    include_once "../backend/procesarlogin.php";
?>
<!--FORMULARIO-->
<div class="padrecontenedor">
    <div class="padrepeque">
        <form method="post" action="" name="inicio_sesion" class="bloque">
            <div class="columna1">
                <div class="elemento-form">
                    <label>Contraseña actual:</label> <br>
                    <input type="password" name="passactual" required/>
                    <div class="mostrarPass">
                        <input type="checkbox" onclick="mostrarPass(this)" class="mostrarPass"><p>Mostrar contraseña</p>
                    </div>
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
                    </div>                </div>
                <button type="submit" name="reset" value="reset" class="botonreg">Restablecer</button>
            </div>
        </form>
    </div>
</div>

<?php include_once "../templates/footer.php"; ?>
<script src="../assets/js/functions.js"></script>

</body>
</html>