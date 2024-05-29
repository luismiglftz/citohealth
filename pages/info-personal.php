<?php
    include_once "../backend/functions.php";
    verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="widtd=device-widtd, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Información personal</title>
</head>
<body id="infopac">
<?php 
obtenerDatosUsuarios();

?>

<!--A PARTIR DE AQUI SE MUESTRA LA TABLA DE INFORMACION-->
<div class="padrecontenedor">
    <table>
        <tr>
            <td>
                NOMBRE
            </td>
            <td>
                <?php echo $_SESSION["USER_NOM"];?>
            </td>
        </tr>
        <tr>
            <td>
                DNI
            </td>
            <td>
                <?php echo $_SESSION["DNI"];?>
            </td>
        </tr>
        <tr>
            <td>
                TELEFONO
            </td>
            <td>
                <?php echo $_SESSION["USER_TEL"];?>
            </td>
        </tr>
        <tr>
            <td>
                MAIL
            </td>
            <td>
                <?php  $_SESSION["USER_MAIL"];?>
            </td>
        </tr>
        <tr>
            <td>
                FECHA DE NACIMIENTO
            </td>
            <td>
                <?php echo $_SESSION["USER_NAC"];?>
            </td>
        </tr>
        <tr>
            <td>
                CODIGO POSTAL
            </td>
            <td>
                <?php echo $_SESSION["USER_COD_POSTAL"];?>
            </td>
        </tr>
        <tr>
            <td>
                DIRECCION
            </td>
            <td>
                <?php $_SESSION["USER_DIR"];?>
            </td>
        </tr>
        <tr>
            <td>
                CIUDAD
            </td>
            <td>
                <?php echo $_SESSION["USER_CIU"];?>
            </td>
        </tr>
        <tr>
            <td>
                PROVINCIA
            </td>
            <td>
                <?php echo $_SESSION["USER_PROV"];?>
            </td>
        </tr>
        <tr>
            <td>
                MEDICO DE CABECERA
            </td>
            <td>
                <?php echo $_SESSION["MED_CAB"];?>
            </td>
        </tr>
    </table>

    <a href="restablecer_pass.php" class="registro">Restablecer contraseña</a>
</div>

</body>
</html>