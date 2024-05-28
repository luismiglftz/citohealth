<?php
    //FIX: CERRAR SESION:
    if(isset($_GET['logout']) && $_GET['logout'] == 'true') {
        //CERRAMOS SESSION
        unset($_SESSION["DNI"]);
        session_destroy();
        //VUELVE A HOME.HTML
        header("Location:../login.php");
    }

?>