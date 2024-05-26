<?php
    // FUNCION PARA CONECTAR A LA BASE DE DATOS
    function conectarBD($nombreBD = "CitoHealth", $servidor = "localhost", $usuario = "root", $password = "") {
        $conexion = mysqli_connect($servidor, $usuario, $password);
        if (!$conexion) {
            die("Conexión fallida: " . mysqli_connect_error());
        }

        mysqli_select_db($conexion, $nombreBD) or die("No se pudo seleccionar la base de datos: " . mysqli_error($conexion));

        return $conexion;
    }
    
    //FIX: Error aquí, redirecciones infinitas buscar posible solucion
    function verificarSesion() {
        if (!isset($_SESSION["DNI"])) {
            header('Location: login.php');
            exit();
        }else{
            header('Location: home.php');
            exit();
        }
    }

    //HEADER
    
    function includeHeader() {
        echo '<nav class="header">
                <div class="header">
                    <div class="redes">
                        <!--NOMBRE APELLIDO Y REDES SOCIALES-->
                        <p>Hola ' . $_SESSION["no"] . ' ' . $_SESSION["PASS"] . '</p>
                        <a href="https://www.instagram.com/luismiguel.ff/"><img src="../assets/media/instagram.png" alt="info"></a>
                        <a href="https://twitter.com/Luis_Fentanez"><img src="../assets/media/twitter.png" alt="info"></a>
                    </div>
                </div>
            </nav>';
    }

?>