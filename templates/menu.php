<nav class="menu_sup">
    <?php if ($_SESSION['USER_ROL'] == 'PACIENTE'){ ?>
        <a href="pages/pacientes/pedir-cita.php">Pedir Cita</a>
        <a href="pages/pacientes/ver-tratamiento.php">Ver Tratamiento</a>
        <a href="pages/info-personal.php">Información Personal</a>
    <?php }elseif ($_SESSION['USER_ROL'] == 'EMPLEADO' || $_SESSION['USER_ROL'] == 'ADMIN'){ ?>
        <a href="gestion_pacientes.php">Gestión de Pacientes</a>
        <a href="ver_citas.php">Ver Citas</a>
        <a href="historiales.php">Ver Citas</a>
        <a href="informacion_personal.php">Información Personal</a>
    <?php } ?>
</nav>