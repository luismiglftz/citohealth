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
        $usuario=$_SESSION["DNI_SESSION"];
        
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
                $_SESSION["EMPLE_COD"] = $registroEmpleado["EMPLE_COD"];
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
                $codDepartamento = $registroEmpleado["DEP_COD"];
                $dep = "SELECT DEP_NOM, DEP_COD FROM DEPARTAMENTOS WHERE DEP_COD = '$codDepartamento';";
                $infoDep = mysqli_query($conexion,$dep);
                $infoDepArray = mysqli_fetch_row($infoDep);
                $_SESSION["USER_DEP"] = $infoDepArray[0] . " (" . $infoDepArray[1] . ") "; 
            }else{
                //NO EXISTE EL USUARIO
                echo "Usuario no encontrado en ninguna tabla.";
            }
        }
        mysqli_close($conexion);
    }

    function obtenerDatosPaciente($pacienteDNI){
        $conexion = conectarBD();
        $compdniPaciente = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$pacienteDNI';";
        $registroPaciente = mysqli_query($conexion, $compdniPaciente);
    
        if ($registroPaciente = mysqli_fetch_assoc($registroPaciente)){
            $_SESSION["PAC_NOM"] = $registroPaciente["PAC_NOM"];
            $_SESSION["PAC_APE"] = $registroPaciente["PAC_APE"];
            $_SESSION["PAC_COD_POSTAL"] = $registroPaciente["PAC_COD_POSTAL"];
            $_SESSION["PAC_DIR"] = $registroPaciente["PAC_DIRECCION"];
            $_SESSION["PAC_TEL"] = $registroPaciente["PAC_TEL"];
            $_SESSION["PAC_NAC"] = $registroPaciente["PAC_FEC_NAC"];
            $_SESSION["PAC_MAIL"] = $registroPaciente["PAC_MAIL"];
            $_SESSION["DNI"] = $registroPaciente["PAC_DNI"];
            $_SESSION["PAC_ROL"] = "PACIENTE";
            $_SESSION["PAC_CIU"] = $registroPaciente["PAC_CIU"];
            $_SESSION["PAC_PROV"] = $registroPaciente["PAC_PROV"];
            $_SESSION["PAC_PASS"] = $registroPaciente["PAC_PASS"];
            $empleCod = $registroPaciente["EMPLE_COD"];
            $medcab = "SELECT EMPLE_NOM, EMPLE_APE, EMPLE_COD FROM EMPLEADOS WHERE EMPLE_COD = '$empleCod';";
            $infomed = mysqli_query($conexion, $medcab);
            $medcab = mysqli_fetch_assoc($infomed);
            $_SESSION["PAC_MED"] = $medcab["EMPLE_NOM"] . " " . $medcab["EMPLE_APE"];
        } else {
            echo "Error: Paciente no encontrado.";
            exit;
        }
    }
    
    function verificarSesion() {
        if (!isset($_SESSION["DNI_SESSION"])) {
            header('Location: ../pages/login.php');
            exit();
        }
    }

    function verificarSesionIndex() {
        if (!isset($_SESSION["ROL_SESSION"])) {
            header('Location: pages/login.php');
            exit();
        }
    }


    function pedirCita(){
        verificarSesion();
        obtenerDatosUsuarios();

        $DNI = $_SESSION["DNI_SESSION"];
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
        $dni = $_SESSION["DNI_SESSION"];
    
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
        $dni = $_SESSION["DNI_SESSION"];
    
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

if (isset($_POST["submitCambios"])) {
    $conexion = conectarBD();
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $codigoPostal = $_POST['codigo_postal'];
    $direccion = $_POST['direccion'];
    // Consulta SQL para actualizar la información del paciente
    if($_SESSION["ROL_SESSION"]=="PACIENTE"){
        //ESTAS DOS SON EXCLUSIVAS DE PACIENTES
        $ciudad = $_POST['ciudad'];
        $provincia = $_POST['provincia'];
        $query = "UPDATE PACIENTES SET 
                PAC_NOM = '$nombre', 
                PAC_APE = '$apellidos', 
                PAC_TEL = '$telefono', 
                PAC_MAIL = '$email', 
                PAC_FEC_NAC = '$fechaNacimiento', 
                PAC_COD_POSTAL = '$codigoPostal', 
                PAC_DIRECCION = '$direccion', 
                PAC_CIU = '$ciudad', 
                PAC_PROV = '$provincia' 
              WHERE PAC_DNI = '$dni';";
    }else{
        $query = "UPDATE EMPLEADOS SET 
                EMPLE_NOM = '$nombre', 
                EMPLE_APE = '$apellidos', 
                EMPLE_TEL = '$telefono', 
                EMPLE_MAIL = '$email', 
                EMPLE_NAC = '$fechaNacimiento', 
                EMPLE_COD_POSTAL = '$codigoPostal', 
                EMPLE_DIR = '$direccion'
              WHERE EMPLE_DNI = '$dni';";
    }
    

    // Ejecutar la consulta
    if(mysqli_query($conexion,$query)) {
        mysqli_close($conexion);
        header("Location: ../pages/globalinfopersonal.php");
        exit();
    } else {
        die("Error: " . mysqli_error($conexion));
    }

}




/**********************/
/*FUNCIONES EMPLEADOS*/
/**********************/
// FUNCION PARA OBTENER LA INFORMACIÓN DEL EMPLEADO
function obtenerEmpleado($DNI) {
    $conexion = conectarBD();
    $selectcod = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$DNI'";
    $resultado = mysqli_query($conexion, $selectcod);
    $empleado = mysqli_fetch_assoc($resultado);
    return $empleado;
}

// FUNCION PARA OBTENER LOS PACIENTES DE UN EMPLEADO
function obtenerPacientes($empleadoCodigo) {
    $conexion = conectarBD();
    $selectpac = "SELECT * FROM PACIENTES WHERE EMPLE_COD = '$empleadoCodigo'";
    $resultado = mysqli_query($conexion, $selectpac);
    $pacientes = [];
    while ($row = mysqli_fetch_assoc($resultado)) {
        $pacientes[] = $row;
    }
    mysqli_close($conexion);
    return $pacientes;
}

// FUNCION PARA COMPROBAR SI UN EMPLEADO TIENE PACIENTES ASIGNADOS
function comprobarPacientesAsignados($empleadoCodigo) {
    $pacientes = obtenerPacientes($empleadoCodigo);
    return !empty($pacientes);
}


//BORRAR PACIENTE
if(isset($_POST['elim'])){
    $seleccion=$_POST['seleccion'];
    $conexion = conectarBD();

    //AÑADIMOS EL CODIGO DE PACIENTE Y CON ESTE HACEMOS DELETE
    
    $eliminar = "DELETE FROM PACIENTES WHERE  PAC_DNI = '$seleccion'";
    
    mysqli_query($conexion,$eliminar);
    
    header('location: empleadopacientes.php');
}

if (isset($_POST["submitCambiosEmpleados"])) {
    $conexion = conectarBD();

    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $fechaNacimiento = $_POST['fecha_nacimiento'];
    $codigoPostal = $_POST['codigo_postal'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $provincia = $_POST['provincia'];
    $pass = $_POST['password'];

    // Consulta SQL para actualizar la información del paciente
    $query = "UPDATE PACIENTES SET 
            PAC_NOM = '$nombre', 
            PAC_APE = '$apellidos', 
            PAC_TEL = '$telefono', 
            PAC_MAIL = '$email', 
            PAC_FEC_NAC = '$fechaNacimiento', 
            PAC_COD_POSTAL = '$codigoPostal', 
            PAC_DIRECCION = '$direccion', 
            PAC_CIU = '$ciudad', 
            PAC_PROV = '$provincia', 
            PAC_PASS = '$pass'
            WHERE PAC_DNI = '$dni';";
    

    // Ejecutar la consulta
    if(mysqli_query($conexion,$query)) {
        mysqli_close($conexion);
        header("Location: ../pages/empleadopacientes.php");
        exit();
    } else {
        die("Error: " . mysqli_error($conexion));
        header("Location: ../pages/empleadopacientes.php");

    }

}

?>