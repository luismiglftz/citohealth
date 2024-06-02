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
        
        // Buscar primero en la tabla PACIENTES
        $compdniPaciente = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$usuario';";
        $registroPaciente=mysqli_query($conexion,$compdniPaciente);

        if ($registroPaciente = mysqli_fetch_assoc($registroPaciente)){
            $_SESSION["USER_NOM"] = $registroPaciente["PAC_NOM"];
            $_SESSION["USER_APE"] = $registroPaciente["PAC_APE"];
            $_SESSION["USER_COD_POSTAL"] = $registroPaciente["PAC_COD_POSTAL"];
            $_SESSION["USER_DIR"] = $registroPaciente["PAC_DIRECCION"];
            $_SESSION["USER_TEL"] = $registroPaciente["PAC_TEL"];
            $_SESSION["USER_NAC"] = $registroPaciente["PAC_FEC_NAC"];
            $_SESSION["USER_MAIL"] = $registroPaciente["PAC_MAIL"];
            $_SESSION["USER_ROL"] = "PACIENTE"; // ES PACIENTE
            $_SESSION["USER_CIU"] = $registroPaciente["PAC_CIU"];
            $_SESSION["USER_PROV"] = $registroPaciente["PAC_PROV"];
            $empleCod = $registroPaciente["EMPLE_COD"];
            //PARA SABER SU MEDICO DE CABECERA
            $medcab = "SELECT EMPLE_NOM, EMPLE_APE, EMPLE_COD FROM EMPLEADOS WHERE EMPLE_COD = '$empleCod';";
            $infomed=mysqli_query($conexion,$medcab);
            $medcab=mysqli_fetch_row($infomed);
            $_SESSION["MED_CAB"] = $medcab[0] . " " . $medcab[1] . " (" . $medcab[2] . ")";
            $_SESSION["EMPLE_COD"] = $medcab[2];
            
        }else{
            // NO EXISTE EL PACIENTE, BUSCAR EN EMPLEADOS
            $compdniEmpleado = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$usuario';";
            $registroEmpleado=mysqli_query($conexion,$compdniEmpleado);

            if ($registroEmpleado = mysqli_fetch_assoc($registroEmpleado)) {
                $_SESSION["USER_NOM"] = $registroEmpleado["EMPLE_NOM"];
                $_SESSION["USER_APE"] = $registroEmpleado["EMPLE_APE"];
                $_SESSION["USER_COD_POSTAL"] = $registroEmpleado["EMPLE_COD_POSTAL"];
                $_SESSION["USER_DIR"] = $registroEmpleado["EMPLE_DIR"];
                $_SESSION["USER_TEL"] = $registroEmpleado["EMPLE_TEL"];
                $_SESSION["USER_NAC"] = $registroEmpleado["EMPLE_NAC"];
                $_SESSION["USER_MAIL"] = $registroEmpleado["EMPLE_MAIL"];
                $_SESSION["USER_ROL"] = $registroEmpleado["EMPLE_ROL"]; // DIFERENCIAR ROL
                $_SESSION["USER_SUELDO"] = $registroEmpleado["EMPLE_SUELDO"];
                $_SESSION["USER_PUE"] = $registroEmpleado["EMPLE_PUE"];
                $_SESSION["DEP_COD"] = $registroEmpleado["DEP_COD"];
            }else{
                //NO EXISTE EL USUARIO
                echo "Usuario no encontrado en ninguna tabla.";
            }
        }
        mysqli_close($conexion);
    }
    
    function verificarSesion() {
        if (!isset($_SESSION["DNI"])) {
            header('Location: ../pages/login.php');
            exit();
        }
    }

    function verificarSesionIndex() {
        if (!isset($_SESSION["DNI"])) {
            header('Location: pages/login.php');
            exit();
        }
    }


    function pedirCita(){
        verificarSesion();
        obtenerDatosUsuarios();

        $DNI = $_SESSION['DNI'];
        $emplecod = $_SESSION['EMPLE_COD'];
        
        // Cuando se pulsa el botón enviar se insertan los datos
        if (isset($_POST['enviar'])) {
            // Pasamos las variables que se van a necesitar
            $fec = $_POST['fec'];
            $afec = $_POST['afec'];
            $tipo = $_POST['tipo'];

            $conexion = conectarBD();

            // Se insertan los datos y redirige
            $insertarCIT = "INSERT INTO CITAS (CITA_COD, PAC_DNI, EMPLE_COD, CITA_FEC, CITA_AFEC, CITA_TIPO) 
                            VALUES (NULL, '$DNI', '$emplecod', '$fec', '$afec', '$tipo');";

            if (!mysqli_query($conexion, $insertarCIT)) {
                die("Error al insertar la cita: " . mysqli_error($conexion));
            }

            mysqli_close($conexion);

            header('Location: pacientevercitas.php');
            exit;
        }

    }

    function obtenerCitas() {
        $conexion = conectarBD();
        $dni = $_SESSION['DNI'];
    
        $compcita = "SELECT * FROM CITAS WHERE PAC_DNI = '$dni';";
        $vercita = mysqli_query($conexion, $compcita);
    
        $citas = [];
        while ($info = mysqli_fetch_assoc($vercita)) {
            $emplecod = $info['EMPLE_COD'];
            $compemple = "SELECT * FROM EMPLEADOS WHERE EMPLE_COD = '$emplecod';";
            $infoemple1 = mysqli_query($conexion, $compemple);
            $infoemple = mysqli_fetch_assoc($infoemple1);
            $info['EMPLE_NOM_APE'] = $infoemple['EMPLE_NOM'] . ' ' . $infoemple['EMPLE_APE'];
            $citas[] = $info;
        }
    
        mysqli_close($conexion);
    
        return $citas;
    }

    function obtenerTratamientos() {
        $conexion = conectarBD();
        $dni = $_SESSION['DNI'];
    
        $tratamientosQuery = "SELECT T.TRAT_COD, T.TRAT_FEC, T.EMPLE_COD, T.TRAT_DESC, E.EMPLE_NOM, E.EMPLE_APE FROM TRATAMIENTOS T JOIN EMPLEADOS E ON T.EMPLE_COD = E.EMPLE_COD WHERE T.PAC_DNI = '$dni';";
    
        $tratamientosResult = mysqli_query($conexion, $tratamientosQuery);
        $tratamientos = [];
    
        while ($tratamiento = mysqli_fetch_assoc($tratamientosResult)) {
            $tratCod = $tratamiento['TRAT_COD'];
            
            // Obtener los fármacos asociados a este tratamiento
            $farmacosQuery = "SELECT F.FARM_NOM FROM TRATAMIENTOS_FARMACOS TF JOIN FARMACOS F ON TF.FARM_COD = F.FARM_COD WHERE TF.TRAT_COD = '$tratCod';";
            
            $farmacosResult = mysqli_query($conexion, $farmacosQuery);
            $farmacos = [];
    
            while ($farmaco = mysqli_fetch_assoc($farmacosResult)) {
                $farmacos[] = $farmaco['FARM_NOM'];
            }
    
            $tratamiento['FARMACOS'] = implode(', ', $farmacos);
            $tratamientos[] = $tratamiento;
        }
    
        mysqli_close($conexion);
        return $tratamientos;
    }
    


?>