<?php
//CONECTAMOS A LA BASE DE DATOS
include("functions.php");
session_start();

    
    //SI SE PULSA INICIAR SESION:
    if (isset($_POST["login"])) {
        if (empty($_POST["DNI"]) || empty($_POST["pass"])) {
            $_SESSION['error'] = "El DNI o la contraseña son incorrectas";
            header('Location: ../login.php');
            exit();
        }else{
            $conexion = conectarBD();

            // Define $username y $password
            $usuario=$_POST["DNI"];
            $pass=$_POST["pass"];

            //TODO IMPLEMENTAR EL ANTI-INYECCION DE SQL
            $compdni = "SELECT * FROM USUARIOS WHERE USER_DNI = '$usuario';";

            $registro1=mysqli_query($conexion,$compdni);

            if($registro=mysqli_fetch_row($registro1)){
                if($registro[0]=="$usuario"){
                    if($registro[10]=="$pass"){
                        //SI TODO ESTA CORRECTO LLEVA A PACIENTE
                        $_SESSION["DNI"]=$usuario;
                        $_SESSION["PASS"]=$pass;
                        header("Location: inicio_pac.php");
                        exit();
                    }else{
                        //CONTRASEÑA INCORRECTA PERO USUARIO CORRECTO
                        $_SESSION['error'] = "Contraseña incorrecta";
                        header('Location: ../login.php');
                        exit();
                    }
                }
            }else{
                //USUARIO INCORRECTO
                $_SESSION['error'] = "El usuario $usuario no se encuentra en la base de datos. Por favor introduzca un DNI válido.";
                header('Location: ../login.php');
                exit();
            }
        }
    }

    if (isset($_POST['register'])) {
        $conexion = conectarBD();

        // DEFINIMOS TODAS LAS VARIABLES PARA FACIL ACCESO
        $DNI=$_POST['DNI'];
        $NOM=$_POST['name'];
        $APE=$_POST['ape'];
        $TEL=$_POST['tel'];
        $MAIL=$_POST['mail'];
        $PASS=$_POST['pass'];
        $PASSV=$_POST['passv'];

        $POSTAL=$_POST['pos'];
        $DIR=$_POST['dir'];
        $CIU=$_POST['ciu'];
        $PROV=$_POST['prov'];
        $NAC=$_POST['nac'];

        //SI LAS DOS CONTRASEÑAS SON IGUALES HACE LA CONSULTA DE INSERTAR
        if($PASS==$PASSV){
            $insertarUser = "INSERT INTO `USUARIOS` (`PAC_DNI`, `PAC_NOM`, `PAC_APE`, `PAC_COD_POSTAL`, `PAC_DIRECCION`, `PAC_CIU`, `PAC_PROV`, `PAC_TEL`, `PAC_MAIL`, `PAC_FEC_NAC`, `PAC_PASS`, `EMPLE_COD`) 
            VALUES ('$DNI', '$NOM ', '$APE', '$POSTAL', '$DIR', '$CIU', '$PROV', '$TEL', '$MAIL', '$NAC', '$PASS', '$medaleatorio')";

            mysqli_query($conexion,$insertarUser);
            //REDIRECCIONA A LOGIN PACIENTE
            header('location: login.php');
        }else{
            //SI SON DIFERENTES MENSAJE DE QUE NO COINCIDEN
            echo "Las contraseñas no coinciden";
        }
    }
?>