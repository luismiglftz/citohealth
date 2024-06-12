<?php
include_once "../backend/functions.php";
verificarSesion();
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Crear historial</title>
</head>
<body id="info" class="pacienteslista separar">
<?php include_once "../templates/header.php"; ?>
<center>
<!--FORMULARIO PARA CREAR HISTORIALES-->
<div class="padrecontenedor crearpac">
    <form method="post" action="" name="inicio_sesion" class="bloque">
        <table>
            <tr>
                <td>
                    <label>Descripción: </label>
                </td>
                <td>
                    <label>Fecha: </label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="textarea" name="desc" required />
                </td>
                <td>
                    <input type="date" value="<?php echo date("Y-m-d");?>" max="<?php echo date("Y-m-d");?>" name="fec"/>
               </td>
            </tr>
            <tr>
            <td colspan="2">
                    <button type="submit" name="crearhistorial" value="crearhistorial" class="botonreg">Crear historial</button>
                </td>
            </tr>
            <?php include_once "../templates/footer.php"; ?>
    <script src="../assets/js/functions.js"></script>

    </center>
</body>
</html>