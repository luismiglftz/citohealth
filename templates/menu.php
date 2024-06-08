<nav class="menu_sup">
    <?php if ($_SESSION['USER_ROL'] == 'PACIENTE'){ ?>
        <a href="../pages/pacientespedircita.php">Pedir Cita</a>
        <a href="../pages/pacientevercitas.php">Ver Cita</a>
        <a href="../pages/pacientetratamiento.php">Ver Tratamiento</a>
        <a href="../pages/globalinfopersonal.php">Información Personal</a>
    <?php }elseif ($_SESSION['USER_ROL'] == 'EMPLEADO' || $_SESSION['USER_ROL'] == 'ADMIN'){ ?>
        <a href="../pages/empleadopacientes.php">Gestión de Pacientes</a>
        <a href="../pages/empleadocitaver.php">Ver Citas</a>
        <a href="../pages/empleadohistorialesver.php">Ver Historiales</a>
        <a href="../pages/empleadotratamientosver.php">Ver tratamientos</a>
        <?php if($_SESSION['USER_ROL'] == "ADMIN"){ ?>
            <a href="ver_citas.php">ADMIN</a> 
        <?php } ?>
    <?php } ?>
    
    <input type="text" id="barraBusqueda" onkeyup="Buscar()">
</nav>