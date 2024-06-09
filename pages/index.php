<?php
    include_once ("../backend/functions.php");
    verificarSesionIndex();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="../assets/style/style.css">

</head>
<body>
    <?php include_once "../templates/header.php"; ?>
    <center>
    <div class="bienvenido">
        <h1>
            BIENVENIDO A SU PORTAL DE PACIENTE
        </h1>
        <p> 
        Desde este portal usted podra acceder a sus citas, asi como cambiar su información personal y consultar los tratamientos que los medicos le han mandado
        Gracias a nuestro equipo de especialistas usted podrá disfrutar de las mejores atenciones, y los mejores tratamientos, y asi dejar de preocuparse por su salud
         pues nosotros nos ocuparemos de ella.
        </p>
    </div>
    <div class="global">
        <div class="columna uno">
            <img src="../assets/media/clinicainicio.jpg" alt="clinicinicio">
            <img src="../assets/media/logo.png" class="imgdeco" alt="logodeco">
        </div>
        <div class="columna dos">
            <div class="fila uno">
                <table class="ventajas">
                    <tr>
                        <th class="titulo">
                            Tranquilidad
                        </th>
                        <th class="titulo">
                            Atención personalizada
                        </th>
                    </tr>

                    <tr>
                        <td class="cuerpo">
                            Sabiendo que siempre va a haber un profesional disponible para tus necesidades
                        </td>
                        <td class="cuerpo">
                            Trato a nuestros pacientes de gran calidad y con una atencion personalizada
                        </td>
                    </tr>
                    <tr class="espaciado">
                        <td colspan="4"></td>
                    </tr>
                    <tr>
                        <th class="titulo">
                            Calidad y rapidez
                        </th>
                        <th class="titulo">
                            Medicina moderna
                        </th>
                    </tr>
                    <tr>
                        <td class="cuerpo">
                            Perteneciente a una ampliar red de hospitales y clinicas que permiten la gestion de las pruebas necesarias con rapidez
                        </td>
                        <td class="cuerpo">
                            Desarrolladores de nuevas tecnologias y tratamientos personalizado a cada pacientes
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </center>
    
    <?php include_once "../templates/footer.php"; ?>
    <script src="../assets/js/functions.js"></script>
</body>
</html>