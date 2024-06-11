<?php
/* 
        <div class="errores" id="errores">
        <?php
            if (isset($_SESSION["error"])) {
                echo "<div id='errores' class='errores'>" . $_SESSION["error"] . "</div>";
                unset($_SESSION["error"]); // LIMPIAR MENSAJE DE ERROR
            }
        ?>
        </div>
*/
    /*####-------------------------------------####*/
    /*##- CONECTAMOS A LA BASE DE DATOS FUNCION -##*/
    /*####-------------------------------------####*/

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

    /*####-------------------------####*/
    /*##- VERIFICACIONES SEGUIRIDAD -##*/
    /*####-------------------------####*/

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


    /*####-------------------------------------####*/
    /*##- OBTENEMOS LOS DATOS DE LOS USUARIOS -##*/
    /*####-------------------------------------####*/
    ## DEPENDIENDO SI SON PACIENTES O EMPLEADOS...

    function obtenerDatosUsuarios(){
        $conexion = conectarBD();
        $usuario=$_SESSION["DNI_SESSION"];
        
        // BUSCA PRIMERO EN TABLA PACIENTES
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


    # OBTENEMOS DATOS PACIENTE PASANDOLE EL DNI DEL PACIENTE
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

      # OBTENEMOS DATOS PACIENTE PASANDOLE EL DNI DEL PACIENTE
      function obtenerDatosEmpleado($empleDNI){
        $conexion = conectarBD();
        $compdniEmple = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$empleDNI';";
        $registroEmpleado = mysqli_query($conexion, $compdniEmple);
    
        if ($registroEmpleado = mysqli_fetch_assoc($registroEmpleado)){
            $_SESSION["EMPLE_COD_SEL"] = $registroEmpleado["EMPLE_COD"];
            $_SESSION["EMPLE_DNI"] = $registroEmpleado["EMPLE_DNI"];
            $_SESSION["EMPLE_NOM"] = $registroEmpleado["EMPLE_NOM"];
            $_SESSION["EMPLE_APE"] = $registroEmpleado["EMPLE_APE"];
            $_SESSION["EMPLE_COD_POSTAL"] = $registroEmpleado["EMPLE_COD_POSTAL"];
            $_SESSION["EMPLE_DIR"] = $registroEmpleado["EMPLE_DIR"];
            $_SESSION["EMPLE_TEL"] = $registroEmpleado["EMPLE_TEL"];
            $_SESSION["EMPLE_NAC"] = $registroEmpleado["EMPLE_NAC"];
            $_SESSION["EMPLE_MAIL"] = $registroEmpleado["EMPLE_MAIL"];
            $_SESSION["EMPLE_ROL"] = $registroEmpleado["EMPLE_ROL"]; // DIFERENCIAR ROL
            $_SESSION["EMPLE_SUELDO"] = $registroEmpleado["EMPLE_SUELDO"];
            $_SESSION["EMPLE_PUE"] = $registroEmpleado["EMPLE_PUE"];
            $_SESSION["EMPLE_DEP"] = $registroEmpleado["DEP_COD"];
            $_SESSION["EMPLE_PASS"] = $registroEmpleado["EMPLE_PASS"];
        } else {
            echo "Error: Empleado no encontrado.";
            exit;
        }
    }

    /*###------------####*/
    /*##- PEDIR CITAS -##*/
    /*####-----------####*/
    function pedirCita(){
        verificarSesion();
        obtenerDatosUsuarios();

        
        //CUANDO SE PULSA EL BOTON DE ENVIAR SE INSERTA EN CITAS
        if (isset($_POST['enviarCita'])) {
            $fec = $_POST['fec'];
            $afec = $_POST['afec'];
            $tipo = $_POST['tipo'];
            obtenerDatosUsuarios();
            $DNI = $_SESSION["DNI_SESSION"];
            $emplecod = $_SESSION['EMPLE_COD'];

            $conexion = conectarBD();

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

    //CUANDO SE PULSA EL BOTON DE ENVIAR SE INSERTA EN CITAS
    if (isset($_POST['enviarCitaEmple'])) {
        $conexion = conectarBD();
        $fec = $_POST['fec'];
        $afec = $_POST['afec'];
        $tipo = $_POST['tipo'];
        
        $DNI = $_SESSION['DNI_PAC_CIT'];
        obtenerDatosUsuarios();
        $emplecod = $_SESSION['EMPLE_COD'];

        

        $insertarCIT = "INSERT INTO CITAS (PAC_DNI, EMPLE_COD, CITA_FEC, CITA_AFEC, CITA_TIPO) 
                        VALUES ('$DNI', '$emplecod', '$fec', '$afec', '$tipo');";

        if (!mysqli_query($conexion, $insertarCIT)) {
            die("Error al insertar la cita: " . mysqli_error($conexion));
        }

        mysqli_close($conexion);

        header('Location: empleadocitaver.php');
        exit;
    }


    /*###-------------------------####*/
    /*##- OBTENER LISTADO DE CITAS -##*/
    /*####------------------------####*/

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

    /*###---------------------####*/
    /*##- OBTENER TRATAMIENTOS -##*/
    /*####--------------------####*/ 
    function obtenerTratamientos() {
        $conexion = conectarBD();
        $dni = $_SESSION["DNI_SESSION"];
    
        $tratamientosQuery = "SELECT T.TRAT_COD, T.TRAT_FEC, T.EMPLE_COD, T.TRAT_DESC, E.EMPLE_NOM, E.EMPLE_APE FROM TRATAMIENTOS T JOIN EMPLEADOS E ON T.EMPLE_COD = E.EMPLE_COD WHERE T.PAC_DNI = '$dni';";
    
        $tratamientosResult = mysqli_query($conexion, $tratamientosQuery);
        $tratamientos = [];
    
        while ($tratamiento = mysqli_fetch_assoc($tratamientosResult)) {
            $tratCod = $tratamiento['TRAT_COD'];
            
            // SE BUSCAN LOS FARMACOS DEL TRATAMIENTO SI TIENE
            $farmacosQuery = "SELECT F.FARM_NOM FROM TRATAMIENTOS_FARMACOS TF JOIN FARMACOS F ON TF.FARM_COD = F.FARM_COD WHERE TF.TRAT_COD = '$tratCod';";
            
            $farmacosResult = mysqli_query($conexion, $farmacosQuery);
            $farmacos = [];
    
            while ($farmaco = mysqli_fetch_assoc($farmacosResult)) {
                $farmacos[] = $farmaco['FARM_NOM'];
            }
    
            // LOS UNIMOS POR COMA
            $tratamiento['FARMACOS'] = implode(', ', $farmacos);
            $tratamientos[] = $tratamiento;
        }
    
        mysqli_close($conexion);
        return $tratamientos;
    }

    /*###----------------------####*/
    /*##- CAMBIOS DE INFORMACION-##*/
    /*####---------------------####*/ 
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
        // UPDATE DEPENDIENDO SI SE TRATA DE PACIENTE U EMPLEADO
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

        
        

        // SE EJECUTA SEA CUAL SEA EL USUARIO...
        if(mysqli_query($conexion,$query)) {
            mysqli_close($conexion);
            header("Location: ../pages/globalinfopersonal.php");
            exit();
        } else {
            die("Error: " . mysqli_error($conexion));
        }

    }

     //ACTUALIZAR INFORMACION DE LOS EMPLEADOS
     if (isset($_POST["submitCambiosAdmin"])) {
        $conexion = conectarBD();
        //DATOS DEL FORMULARIO 
        $cod = $_POST['cod'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $dni = $_POST['dni'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $fechaNacimiento = $_POST['fecha_nacimiento'];
        $codigoPostal = $_POST['codigo_postal'];
        $direccion = $_POST['direccion'];
        $sueldo = $_POST['sueldo'];
        $puesto = $_POST['puesto'];
        $departamento = $_POST['departamento'];
        $password = $_POST['password'];

        // UPDATE EMPLEADO
        $query = "UPDATE EMPLEADOS SET 
                    EMPLE_NOM = '$nombre', 
                    EMPLE_APE = '$apellidos', 
                    EMPLE_TEL = '$telefono', 
                    EMPLE_MAIL = '$email', 
                    EMPLE_NAC = '$fechaNacimiento', 
                    EMPLE_COD_POSTAL = '$codigoPostal', 
                    EMPLE_DIR = '$direccion', 
                    EMPLE_SUELDO = '$sueldo', 
                    EMPLE_PUE = '$puesto', 
                    DEP_COD = '$departamento', 
                    EMPLE_PASS = '$password'
                WHERE EMPLE_DNI = '$dni'";
        

        // SE EJECUTA SEA CUAL SEA EL USUARIO...
        if(mysqli_query($conexion,$query)) {
            mysqli_close($conexion);
            header("Location: ../pages/adminempleados.php");
            exit();
        }else{
            die("Error: " . mysqli_error($conexion));
        }

    }

        //ACTUALIZAR PACIENTES DESDE EMPLEADO
        if (isset($_POST["submitCambiosEmpleados"])) {
            $conexion = conectarBD();
    
            // DATOS FORMULARIO
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
    
            // 
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
    




    /**********************/
    /*FUNCIONES EMPLEADOS*/
    /**********************/

    // FUNCION PARA OBTENER LA INFORMACIÓN DEL EMPLEADO MEDIANTE SU DNI (SESSION)
    function obtenerEmpleado($DNI) {
        $conexion = conectarBD();
        $selectcod = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$DNI'";
        $resultado = mysqli_query($conexion, $selectcod);
        $empleado = mysqli_fetch_assoc($resultado);
        return $empleado;
    }

    // FUNCION PARA OBTENER LOS PACIENTES DE UN EMPLEADO MEDIANTE COD EMPLE
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

    // FUNCION PARA OBTENER LOS EMPLEADOS PARA EL ADMIN
    function obtenerEmpleados() {
        $conexion = conectarBD();
        $selectEmple = "SELECT * FROM EMPLEADOS";
        $resultado = mysqli_query($conexion, $selectEmple);
        $empleados = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $empleados[] = $row;
        }
        mysqli_close($conexion);
        return $empleados;
    }


    // FUNCION PARA COMPROBAR SI UN EMPLEADO TIENE PACIENTES ASIGNADOS
    function comprobarPacientesAsignados($empleadoCodigo) {
        $pacientes = obtenerPacientes($empleadoCodigo);
        return !empty($pacientes);
    }

    // FUNCION PARA OBTENER PACIENTE MEDIANTE SU DNI
    function obtenerPaciente($dni) {
        $conexion = conectarBD();

        $query = "SELECT * FROM PACIENTES WHERE PAC_DNI = '$dni';";
        $resultado = mysqli_query($conexion, $query);

        // COMPRUEBA SI EXISTE O NO Y DEVUELVE UN NULL SI NO SE HA ENCONTRADO PACIENTE
        if (mysqli_num_rows($resultado) > 0) {
            return mysqli_fetch_assoc($resultado);
        } else {
            return null;
        }
    }

    //FIX: INTEGRAR EN EL PHP DE CITAS PARA PAGINADO...
    function obtenerCitasPaciente($dni) {
        $conexion = conectarBD();
        //PARA IR SELECCIONANDO EL RANGO DE CADA PAGINA
        
        $query = "SELECT * FROM CITAS WHERE PAC_DNI = '$dni'";
        $resultado = mysqli_query($conexion, $query);
        
        $citas = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $citas[] = $row;
        }
        
        mysqli_close($conexion);
        return $citas;
    }

    //FIX: INTEGRAR EN EL PHP DE CITAS PARA PAGINADO...
    function obtenerHistorialPaciente($dni) {
        $conexion = conectarBD();
        //PARA IR SELECCIONANDO EL RANGO DE CADA PAGINA
        
        $query = "SELECT * FROM HISTORIAL WHERE PAC_DNI = '$dni'";
        $resultado = mysqli_query($conexion, $query);
        
        $citas = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $citas[] = $row;
        }
        
        mysqli_close($conexion);
        return $citas;
    }


    //FUNCION PARA ELIMINAR LA CITA DE LA FILA
    function eliminarCita($citaCod) {
        $conexion = conectarBD();
        $eliminarCita = "DELETE FROM CITAS WHERE CITA_COD = '$citaCod'";
        
        if (mysqli_query($conexion, $eliminarCita)) {
            mysqli_close($conexion);
            return true;
        } else {
            mysqli_close($conexion);
            return false;
        }
    }

    // SI SE LLEGA A LA URL CON ELIMINARCITA
    if (isset($_GET['eliminarcita'])) {
        $citaCod = $_GET['citaCod'];
        if (eliminarCita($citaCod)) {
            header('location: ../pages/empleadocitaver.php');
        } else {
            echo "Error al eliminar la cita.";
        }
    }

    //FUNCION PARA ELIMINAR LA CITA DE LA FILA
    function eliminarHis($hisCod) {
        $conexion = conectarBD();
        $eliminarHistorial = "DELETE FROM HISTORIAL WHERE COD_HIS = '$hisCod'";
        
        if (mysqli_query($conexion, $eliminarHistorial)) {
            mysqli_close($conexion);
            return true;
        } else {
            mysqli_close($conexion);
            return false;
        }
    }

    // SI SE LLEGA A LA URL CON ELIMINARCITA
    if (isset($_GET['eliminarhistorial'])) {
        $hisCod = $_GET['hisCod'];
        if (eliminarHis($hisCod)) {
            header('location: ../pages/empleadohistorialesver.php');
        } else {
            echo "Error al eliminar la cita.";
        }
    }

    // OBSOLETO!!!
    /* function nombreApePac(){
        $conexion = conectarBD();
        $DNI_PAC = $_SESSION['DNI_PAC_CIT'];

        $selectcodpac = "SELECT * FROM PACIENTES WHERE DNI_PAC = '$DNI_PAC'";
        $pacientes = mysqli_query($conexion,$selectcodpac);
        $infopac = mysqli_fetch_row($pacientes);

        return "$infopac[0] . $infopac[1]";

    } */

    //PARA CREAR UNA CITA DESDE PACIENTE RECOGIENDO INFO DEL PACIENTE
    if (isset($_POST['crearCita'])) {
        $conexion = conectarBD();
        $DNI_EMPLE = $_SESSION['DNI_SESSION'];
        $DNI_PAC = $_SESSION['DNI_PAC_CIT'];

            //REALIZAMOS UNA CONSULTA PARA CONSEGUIR EL CODIGO DE EMPLEADO:
            $selectcod = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$DNI_EMPLE'";
            $empleados = mysqli_query($conexion,$selectcod);
            $infoemple = mysqli_fetch_row($empleados);

            $codemple = $infoemple[0];


        // DEFINIMOS TODAS LAS VARIABLES PARA FACIL ACCESO
        $DESC=$_POST['desc'];
        $FEC=$_POST['fec'];
        $tipo=$_POST['tipo'];

        //POR ULTIMO INSERTAMOS LA NUEVA CITA EN EL REGISTRO DE CITAS
            $insertarCIT = "INSERT INTO `CITAS` (`PAC_DNI`, `EMPLE_COD`, `CITA_FEC`, `CITA_AFEC`, `CITA_TIPO`)
            VALUES ('$DNI_PAC', '$codemple', '$FEC', '$DESC', '$tipo')";

            mysqli_query($conexion,$insertarCIT);
            //VOLVEMOS A LA PAGINAS DE CITAS
            header('location: ../pages/empleadocitaver.php');

    }


    //BORRAR PACIENTE
    //TODO: AÑADIR JS CONFIRMAR
    if(isset($_POST['elim'])){
        $seleccion=$_POST['seleccion'];
        $conexion = conectarBD();

        //AÑADIMOS EL CODIGO DE PACIENTE Y CON ESTE HACEMOS DELETE
        $eliminar = "DELETE FROM PACIENTES WHERE  PAC_DNI = '$seleccion'";
        
        mysqli_query($conexion,$eliminar);
        
        header('location: empleadopacientes.php');
    }

    if(isset($_POST['elimEmple'])){
        $seleccion=$_POST['seleccion'];
        $conexion = conectarBD();

        //AÑADIMOS EL CODIGO DE PACIENTE Y CON ESTE HACEMOS DELETE
        $eliminar = "DELETE FROM EMPLEADOS WHERE  EMPLE_COD = '$seleccion'";
        
        mysqli_query($conexion,$eliminar);
        
        header('location: ../pages/adminempleados.php');
    }


    if (isset($_POST['crearhistorial'])) {
        //GUARDAMOS LAS VARIABLES Y NOS CONECTAMOS A LA BD
        $conexion = conectarBD();

        $DNI_PAC=$_SESSION['DNI_PAC_HIS'];
        $DNI_EMPLE=$_SESSION['DNI'];
        
        $codemple = $_SESSION['codemple'];



        // DEFINIMOS TODAS LAS VARIABLES PARA FACIL ACCESO
        $DESC=$_POST['desc'];
        $FEC=$_POST['fec'];
        //POR ULTIMO INSERTAMOS EL NUEVO HISTORIAL EN EL REGISTRO DE CITAS
            $insertarHIS = "INSERT INTO `historial` (`COD_HIS`, `PAC_DNI`, `HIS_FEC`, `HIS_DESC`, `EMPLE_COD`) 
            VALUES (NULL, '$DNI_PAC', '$FEC', '$DESC', '$codemple')";

            mysqli_query($conexion,$insertarHIS);
            header('location: ../pages/empleadohistorialesver.php');

     }

     function obtenerFarmacos() {
        $conexion = conectarBD();
        $consulta = "SELECT * FROM FARMACOS";
        $resultado = mysqli_query($conexion, $consulta);
        $farmacos = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $farmacos[] = $row;
        }
        mysqli_close($conexion);
        return $farmacos;
    }
        
    //TODO: IMPLEMENTACION DE ORDEN, VALORES POR DEFECTO EN LA FUNCION
    function obtenerTratamientosPaciente($dniPaciente) {
        $conexion = conectarBD();
        $consulta = "SELECT * FROM TRATAMIENTOS WHERE PAC_DNI = '$dniPaciente'";
        $resultado = mysqli_query($conexion, $consulta);
        $tratamientos = [];
        while ($row = mysqli_fetch_assoc($resultado)) {
            $tratamientos[] = $row;
        }
        mysqli_close($conexion);
        return $tratamientos;
    }

    function obtenerFarmacosTratamiento($tratCod) {
        $conexion = conectarBD();
        $consulta = "SELECT FARM_NOM, FARM_DESC 
                        FROM FARMACOS 
                        WHERE FARM_COD IN (SELECT FARM_COD 
                                        FROM TRATAMIENTOS_FARMACOS 
                                        WHERE TRAT_COD = $tratCod)";
        $resultado = mysqli_query($conexion, $consulta);
        $farmacos = [];
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $farmacos[] = $fila;
        }
        mysqli_close($conexion);
        return $farmacos;
    }

    if (isset($_POST['creartrat'])) {
        $DNI_PAC = $_SESSION['DNI_PAC_TRAT'];
        $DNI_EMPLE = $_SESSION['DNI_SESSION'];
        $conexion = conectarBD();
        
        //CODIGO DE EMPLEADO:
        $selectcod = "SELECT * FROM EMPLEADOS WHERE EMPLE_DNI = '$DNI_EMPLE'";
        $empleados = mysqli_query($conexion, $selectcod);
        $infoemple = mysqli_fetch_row($empleados);
        $codemple = $infoemple[0];
    
        $DESC = $_POST['desc'];
        $FEC = $_POST['fec'];
        $farmacos = $_POST['farmacos'];
    
        //SE INSERTA NUEVO TRATAMIENTO
        $insertarTRAT = "INSERT INTO TRATAMIENTOS (TRAT_FEC, PAC_DNI, EMPLE_COD, TRAT_DESC) 
                        VALUES ('$FEC', '$DNI_PAC', '$codemple', '$DESC')";
        // INICIA LA CONSULTA
        mysqli_query($conexion, $insertarTRAT);

        //ESTO RECOGE EL ULTIMO ID CREADO
        $tratCod = mysqli_insert_id($conexion);
    
        // INSERTAMOS LOS FÁRMACOS EN LA TABLA RELACIONAL
        foreach ($farmacos as $farmaco) {
            $insertarFarmaco = "INSERT INTO TRATAMIENTOS_FARMACOS (TRAT_COD, FARM_COD) 
                                VALUES ($tratCod, $farmaco)";
            mysqli_query($conexion, $insertarFarmaco);
        }
    
        // VOLVEMOS A LA PÁGINA DE TRATAMIENTOS    
        header('location: ../pages/empleadotratamientosver.php');
    }

       //FUNCION PARA ELIMINAR LA CITA DE LA FILA
       function eliminarTrat($tratCod) {
        $conexion = conectarBD();
        $eliminarFarmacos = "DELETE FROM TRATAMIENTOS_FARMACOS WHERE TRAT_COD = '$tratCod'";
        $eliminarTratamiento = "DELETE FROM TRATAMIENTOS WHERE TRAT_COD = '$tratCod'";
        
        if (mysqli_query($conexion, $eliminarFarmacos) && mysqli_query($conexion, $eliminarTratamiento)) {
            mysqli_close($conexion);
            return true;
        } else {
            mysqli_close($conexion);
            return false;
        }
    }

    // SI SE LLEGA A LA URL CON ELIMINARCITA
    if (isset($_GET['eliminartratamiento'])) {
        $tratCod = $_GET['tratCod'];
        if (eliminarTrat($tratCod)) {
            header('location: ../pages/empleadotratamientosver.php');
        } else {
            echo "Error al eliminar la cita.";
        }
    }
    
    
?>