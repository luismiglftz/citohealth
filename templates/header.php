<?php
    obtenerDatosUsuarios();
?>
<header class="header">
    <div class="header">
        <div class="logo">
            <img src="assets/media/logowhite.png" alt="">    
        </div>
        <div class="nombre">
            <div>
                <!--NOMBRE APELLIDO Y REDES SOCIALES-->
                <p>Bienvenido <b><?php echo $_SESSION['USER_NOM'] . " " . $_SESSION['USER_APE']; ?></b></p>
                <a href="backend/cerrar-sesion.php?logout=true""><img src="assets/media/logout.png" alt="" height="30px"></a>
            </div>

            <?php include_once "templates/menu.php"; ?>


        </div>
    </div>
</header>