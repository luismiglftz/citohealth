<?php
    include_once "../backend/functions.php";
    verificarSesion();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Tratamientos</title>
</head>
<body id="info">
<?php include_once "../templates/header.php"; ?>

<?php
$DNI = $_SESSION["DNI_SESSION"];
$tratamientos = obtenerTratamientos($DNI);
?>

<div class="padrecontenedor">
    <table>
        <tr>
            <th>Fecha del tratamiento</th>
            <th>Médico</th>
            <th>Descripción del tratamiento</th>
            <th>Fármacos</th>
        </tr>
        <?php if (empty($tratamientos)): ?>
            <tr>
                <td colspan="4">NO HAY NINGÚN TRATAMIENTO A TU NOMBRE</td>
            </tr>
        <?php else: ?>
            <?php foreach ($tratamientos as $tratamiento): ?>
                <tr>
                    <td><?php echo $tratamiento['TRAT_FEC']; ?></td>
                    <td><?php echo $tratamiento['EMPLE_NOM'] . ' ' . $tratamiento['EMPLE_APE'] . ' (' . $tratamiento['EMPLE_COD'] . ')'; ?></td>
                    <td><?php echo $tratamiento['TRAT_DESC']; ?></td>
                    <td><?php echo $tratamiento['FARMACOS']; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>

<?php include_once "../templates/footer.php"; ?>
</body>
</html>