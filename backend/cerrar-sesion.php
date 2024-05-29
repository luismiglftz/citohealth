<?php
    //FIX: CERRAR SESION...
    if(isset($_GET['logout'])) {
        //CERRAMOS SESSION
        unset($_SESSION["DNI"]);
        session_destroy();
        session_unset();
        //VUELVE A HOME.HTML
        header("Location:../login.php");
    }

?>