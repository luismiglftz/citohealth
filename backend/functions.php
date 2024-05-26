<?php
    function conectarBD($nombreBD = "CitoHealth", $servidor = "localhost", $usuario = "root", $password = "") {
        $conexion = mysqli_connect($servidor, $usuario, $password);
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        mysqli_select_db($conexion, $nombreBD) or die("No se pudo seleccionar la base de datos: " . mysqli_error($conexion));

        return $conexion;
    }
?>