<?php
    obtenerDatosUsuarios();
?>
<header class="header">
    <div class="header">
        <div class="logo">
            <a href="../pages/index.php"><img src="../assets/media/logowhite.png" alt=""></a>
        </div>
        <div class="nombre">
            <div>
                <!--NOMBRE APELLIDO Y REDES SOCIALES-->
                <p>Bienvenido  <a href="../pages/globalinfopersonal.php"><b><?php echo $_SESSION['USER_NOM'] . " " . $_SESSION['USER_APE']; ?></b></a></p>
                <a href="../backend/cerrar-sesion.php"><img src="../assets/media/logout.png" alt="" height="30px"></a>
            </div>

            <?php include_once "../templates/menu.php"; ?>



        </div>
    </div>
</header>