<?php
require_once('functions.php');

    //SI SE PULSA INICIAR SESION:
    if (isset($_POST["login"])) {
        if (empty($_POST["DNI"]) || empty($_POST["pass"])) {
            $_SESSION['error'] = "El DNI o la contraseña son incorrectas";
            header("Location: ../pages/login.php");
            exit();
        }else{
            $conexion = conectarBD();

            // Define $username y $password
            $usuario=$_POST["DNI"];
            $pass=$_POST["pass"];

            //TODO IMPLEMENTAR EL ANTI-INYECCION DE SQL
            $compdni = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$usuario';";
            $registroPaciente=mysqli_query($conexion,$compdni);

            if ($registroPaciente  = mysqli_fetch_assoc($registroPaciente)) {
                if ($registroPaciente['PAC_PASS'] == $pass) {
                    //SI TODO ESTA CORRECTO LLEVA A PACIENTE
                    $_SESSION["DNI_SESSION"]=$usuario;
                    $_SESSION["ROL_SESSION"] = "PACIENTE";
                    header("Location: ../pages/index.php");
                    exit();
                }else{
                    //CONTRASEÑA INCORRECTA PERO USUARIO CORRECTO
                    $_SESSION['error'] = "Contraseña incorrecta";
                    header("Location: ../pages/login.php");
                    exit();
                }
            }else{
                //SI NO SE ENCUENTRA EN LA TABLA PACIENTES SE BUSCA EN LA DE EMPLEADOS
                $compdniEmpleado = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$usuario';";
                $registroEmpleado=mysqli_query($conexion,$compdniEmpleado);


                if ($registroEmpleado = mysqli_fetch_assoc($registroEmpleado)) {
                    if ($registroEmpleado['EMPLE_PASS'] == $pass) {
                        //SI TODO ESTA CORRECTO LLEVA A EMPLEADO
                        $_SESSION["DNI_SESSION"]=$usuario;
                        $_SESSION["ROL_SESSION"] = $registroEmpleado["EMPLE_ROL"];
                        header("Location: ../pages/index.php");
                        exit();
                    }else{
                        $_SESSION['error'] = "Contraseña incorrecta";
                        header("Location: ../pages/login.php");
                        exit();
                    }
                }else{
                    //USUARIO INCORRECTO
                    $_SESSION['error'] = "El usuario $usuario no se encuentra en la base de datos. Por favor introduzca un DNI válido.";
                    header("Location: ../pages/login.php");
                    exit();
                }
            }
        }
    }

    if (isset($_POST['register'])) {
        $conexion = conectarBD();

        //CONSULTA MAXIMO Y MINIMO PARA SELECCIONAR UN NUMERO ALEATORIO Y ASI ASIGNAR UN EMPLEADO ALEATORIO QUE NO SEA DE ADMINISTRACION
        $codmax = "SELECT MAX(EMPLE_COD) FROM EMPLEADOS WHERE DEP_COD NOT LIKE '6' OR DEP_COD NOT LIKE '1'";
        $MAX = mysqli_query($conexion,$codmax);

        $codmin = "SELECT MIN(EMPLE_COD) FROM EMPLEADOS WHERE DEP_COD NOT LIKE '6' OR DEP_COD NOT LIKE '1'";
        $MIN = mysqli_query($conexion,$codmin);

        $nummax = mysqli_fetch_row($MAX);
        
        $nummin = mysqli_fetch_row($MIN);

        $medaleatorio = mt_rand($nummin[0],$nummax[0]);


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
            $insertarUser = "INSERT INTO PACIENTES (
                PAC_DNI, PAC_NOM, PAC_APE, PAC_COD_POSTAL, PAC_DIRECCION, PAC_CIU, PAC_PROV, PAC_TEL, PAC_MAIL, PAC_FEC_NAC, PAC_PASS, EMPLE_COD
                )VALUES('$DNI', '$NOM', '$APE', '$POSTAL', '$DIR', '$CIU', '$PROV', '$TEL', '$MAIL', '$NAC', '$PASS', '$medaleatorio')";

            if(mysqli_query($conexion,$insertarUser)){
                header("Location: ../pages/login.php");
            }else{
                $_SESSION['error'] = "Contraseña incorrecta";
                header("Location: ../pages/registro.php");
                exit();
            }
        }else{
            //SI SON DIFERENTES MENSAJE DE QUE NO COINCIDEN
            $_SESSION['error'] = "Contraseña incorrecta";
            header("Location: ../pages/registro.php");
            exit();
        }
    }

    if (isset($_POST['registerpac'])) {
        $conexion = conectarBD();

        // DEFINIMOS TODAS LAS VARIABLES PARA FACIL ACCESO
        $DNI=$_POST['DNI'];
        $NOM=$_POST['nombre'];
        $APE=$_POST['apellidos'];
        $TEL=$_POST['telefono'];
        $MAIL=$_POST['email'];
        $PASS=$_POST['pass'];
        $PASSV=$_POST['passv'];
        $POSTAL=$_POST['codigo_postal'];
        $DIR=$_POST['direccion'];
        $CIU=$_POST['ciudad'];
        $PROV=$_POST['provincia'];
        $NAC=$_POST['fecha_nacimiento'];

        obtenerDatosUsuarios();
        $emple_cod = $_SESSION["EMPLE_COD"];

        //SI LAS DOS CONTRASEÑAS SON IGUALES HACE LA CONSULTA DE INSERTAR
        if($PASS==$PASSV){
            $insertarUser = "INSERT INTO PACIENTES (
                PAC_DNI, PAC_NOM, PAC_APE, PAC_COD_POSTAL, PAC_DIRECCION, PAC_CIU, PAC_PROV, PAC_TEL, PAC_MAIL, PAC_FEC_NAC, PAC_PASS, EMPLE_COD
                )VALUES('$DNI', '$NOM', '$APE', '$POSTAL', '$DIR', '$CIU', '$PROV', '$TEL', '$MAIL', '$NAC', '$PASS', '$emple_cod')";

            if(mysqli_query($conexion,$insertarUser)){
                header("Location: ../pages/empleadopacientes.php");
            }else{
                $_SESSION['error'] = "Ha ocurrido un error";
                exit();
            }
        }else{
            //SI SON DIFERENTES MENSAJE DE QUE NO COINCIDEN
            $_SESSION['error'] = "Contraseña incorrecta";
            exit();
        }
    }

    
    //TODO TENGO QUE ARREGLAR ESTO!! SE HA ROTO???? =(

    function comprobarPassword(){
        $conexion = conectarBD();
        $usuario=$_SESSION["DNI_SESSION"];
        $passOld = false;
        echo ("$usuario");
        echo $_SESSION["ROL_SESSION"];


        if($_SESSION["ROL_SESSION"]=="PACIENTE"){
            $selectPass = "SELECT PAC_PASS FROM PACIENTES WHERE PAC_DNI = '$usuario';";
        }else{
            $selectPass = "SELECT EMPLE_PASS FROM EMPLEADOS WHERE EMPLE_DNI = '$usuario';";
        }

        $pass = mysqli_query($conexion, $selectPass);
        if (!$pass) {
            die("ERROR: " . mysqli_error($conexion));
        } else {
            $passwd = mysqli_fetch_assoc($pass);
            if ($passwd) {
                $passOld = $passwd['PAC_PASS'] ?? $passwd['EMPLE_PASS'];
            }
        }

        return $passOld;
    }

    //CUANDO SE PULSA EL BOTON
    if(isset($_POST['reset'])){
        $pass = comprobarPassword();
        $dni = $_SESSION["DNI_SESSION"];
        if($pass !== false && $_POST['passactual']==$pass){
            if($_POST['pass']==$_POST['passv']){
                $conexion = conectarBD();
                $newPass = $_POST['pass'];

                if($_SESSION["ROL_SESSION"]=="PACIENTE"){
                    //CONSULTA QUE ACTUALIZA LA CONTRASEÑA
                    $actpass = "UPDATE PACIENTES SET PAC_PASS = '$newPass' WHERE PAC_DNI = '$dni';";

                    if(mysqli_query($conexion,$actpass)) {
                        $_SESSION['PASS'] = $newPass;
                        mysqli_close($conexion);
                        header("Location: ../pages/globalinfopersonal.php");
                        exit();
                    } else {
                        die("Error: " . mysqli_error($conexion));
                    }
                }else{
                    //CONSULTA QUE ACTUALIZA LA CONTRASEÑA
                    $actpass = "UPDATE EMPLEADOS SET EMPLE_PASS = '$newPass' WHERE EMPLE_DNI = '$dni';";

                    if(mysqli_query($conexion,$actpass)) {
                        $_SESSION['PASS'] = $newPass;
                        mysqli_close($conexion);
                        header("Location: ../pages/globalinfopersonal.php");
                        exit();
                    } else {
                        die("Error: " . mysqli_error($conexion));
                    }
                }
            }else{
                echo "<h2>Las contraseñas no coinciden</h2>";
            }
        }else{
            echo "<h2>La contraseña introducida no es válida</h2>";
        }
    }
?>