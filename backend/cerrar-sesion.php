<?php
include_once "../config/config.php";

    session_start();
    //CERRAMOS SESSION
    unset($_SESSION["DNI"]);
    session_destroy();
    session_unset();
    //VUELVE A HOME.HTML
    header("Location: ../pages/login.php");

?>