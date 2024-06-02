<?php
//AQUI NO USAMOS EL CONFIG, POR LLAMARSE INDEX Y TENER PROBLEMAS EN LA URL
    include_once ("backend/functions.php");
    verificarSesionIndex();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="assets/style/style.css">

</head>
<body>
    <?php include_once "templates/header.php"; ?>
    <center>

    </center>
    
<?php include_once "templates/footer.php"; ?>
</body>
</html>