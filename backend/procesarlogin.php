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

            if ($registro = mysqli_fetch_assoc($registro1)) {
                if ($registro['USER_PASS'] == $pass) {
                    //SI TODO ESTA CORRECTO LLEVA A PACIENTE
                    $_SESSION["DNI"]=$usuario;
                    $_SESSION["PASS"]=$pass;
                    $_SESSION["ROL"] = $registro['USER_ROL'];
                    header("Location: ../home.html");
                    exit();
                }else{
                    //CONTRASEÑA INCORRECTA PERO USUARIO CORRECTO
                    $_SESSION['error'] = "Contraseña incorrecta";
                    header('Location: ../login.php');
                    exit();
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
            $insertarUser = "INSERT INTO `USUARIOS` (
                USER_DNI, USER_NOM, USER_APE, USER_COD_POSTAL, USER_DIR, USER_TEL, USER_MAIL, USER_NAC, USER_PASS, USER_ROL, PAC_CIU, PAC_PROV
            ) VALUES (
                '$DNI', '$NOM', '$APE', '$POSTAL', '$DIR', '$TEL', '$MAIL', '$NAC', '$PASS', 'PACIENTE', '$CIU', '$PROV'
            )";

            if(mysqli_query($conexion,$insertarUser)){
                header("location: ../login.php");
            }else{
                $_SESSION['error'] = "Contraseña incorrecta";
                header('Location: ../registro.php');
                exit();
            }
        }else{
            //SI SON DIFERENTES MENSAJE DE QUE NO COINCIDEN
            $_SESSION['error'] = "Contraseña incorrecta";
            header('Location: ../registro.php');
            exit();
        }
    }
?>