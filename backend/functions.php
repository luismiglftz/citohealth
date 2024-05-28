<?php
    session_start();
    // FUNCION PARA CONECTAR A LA BASE DE DATOS
    function conectarBD($nombreBD = "CitoHealth", $servidor = "localhost", $usuario = "root", $password = "") {
        $conexion = mysqli_connect($servidor, $usuario, $password);
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        mysqli_select_db($conexion, $nombreBD) or die("No se pudo seleccionar la base de datos: " . mysqli_error($conexion));

        return $conexion;
    }

    function obtenerDatosUsuarios(){
        $conexion = conectarBD();
        $usuario=$_SESSION["DNI"];

        $compdni = "SELECT * FROM USUARIOS WHERE USER_DNI = '$usuario';";

        $registro1=mysqli_query($conexion,$compdni);

        if ($registro = mysqli_fetch_assoc($registro1)) {
            //GUARDAMOS TODOS LOS DATOS DEL USUARIO
            $_SESSION["USER_NOM"] = $registro["USER_NOM"];
            $_SESSION["USER_APE"] = $registro["USER_APE"];
            $_SESSION["USER_COD_POSTAL"] = $registro["USER_COD_POSTAL"];
            $_SESSION["USER_DIR"] = $registro["USER_DIR"];
            $_SESSION["USER_TEL"] = $registro["USER_TEL"];
            $_SESSION["USER_NAC"] = $registro["USER_NAC"];
            $_SESSION["USER_MAIL"] = $registro["USER_MAIL"];
            $_SESSION["USER_ROL"] = $registro["USER_ROL"];
            $_SESSION["EMPLE_SUELDO"] = $registro["EMPLE_SUELDO"];
            $_SESSION["EMPLE_PUE"] = $registro["EMPLE_PUE"];
            $_SESSION["PAC_CIU"] = $registro["PAC_CIU"];
            $_SESSION["PAC_PROV"] = $registro["PAC_PROV"];
            $_SESSION["DEP_COD"] = $registro["DEP_COD"];
        } else {
            //EN EL CASO QUE INTENTEN ACCEDER SIN USUARIO
            echo "Usuario no encontrado.";
        }
    
        mysqli_close($conexion);
    }
    
    function verificarSesion() {
        if (!isset($_SESSION["DNI"])) {
            header('Location: login.php');
            exit();
        }
    }


    function pedirCita(){
        
    }


?>