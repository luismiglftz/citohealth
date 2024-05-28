<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=ç, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <title>Ver citas</title>
</head>
<body id="infocitas">
    <?php
        //NICIAMOS SESION Y CONECTAMOS A LA BASE DE DATOS    

        session_start(); 

        $DNI=$_SESSION['DNI'];

        $nombreBD='GeoHealth';

        $servidor='localhost';

        $usuario='root';

        $password='';

        $conexion=mysqli_connect($servidor,$usuario,$password);

        mysqli_select_db($conexion,$nombreBD);

        //CONSULTA DONDE SACAMOS LOS DATOS DE TRATAMIENTOS

        $compcita = "SELECT * FROM CITAS WHERE PAC_DNI = '$DNI';";

        $vercita=mysqli_query($conexion,$compcita);

        $compcita = mysqli_fetch_row($vercita);

    
      


        //CONDICION QUE MIENTRAS EXISTA TRATAMIENTO MUESTRE POR PANTALLA ESTOS
        //CON UN BUCLE CON CONTADOR
        if(empty($compcita[0])){
            echo "<h2>NO HAY NINGUNA CITA A TU NOMBRE</h2>";
            echo "<a href='pedir-cita.php' class='registro'>Solicitar cita</a>";
        }else{
        ?>
        
        <div class="padrecontenedor">
            <table>
                <tr>
                    <td>
                        Código
                    </td>
                    <td>
                        Medico
                    </td>
                    <td>
                        Fecha
                    </td>
                    <td>
                        Tipo de cita
                    </td>
                    <td>
                        Motivo de la cita
                    </td>
                </tr>
        <?php   
            while($info=mysqli_fetch_row($vercita)){

                $compemple = "SELECT * FROM EMPLEADOS WHERE EMPLE_COD = '$info[2]';";

                $infoemple1=mysqli_query($conexion,$compemple);

                $infoemple=mysqli_fetch_row($infoemple1);
        
                ?>
                        <tr>
                            <td>
                                <?php echo "$info[0]"?>
                            </td>
                            <td>
                                <?php echo "$infoemple[2] $infoemple[3] ($info[2])"?>
                            </td>
                            <td>
                                <?php echo "$info[3]"?>
                            </td>
                            <td>
                                <?php switch ($info[5]){
                                    case 1:
                                        echo "Presencial en la clínica";
                                        break;
                                    case 2:
                                        echo "Visita a casa";
                                        break;
                                }
                                ?>
                            </td>
                            <td>
                            <?php echo "$info[4]"?>
                            </td>
                        </tr>
                        
        
                        <?php
                            }
                        ?>
                    </table>
                    <!--BOTON SOLICITAR CITA-->
                    <a href="pedir-cita.php" class="registro">Solicitar cita</a>

                </div>
        
        <?php
        }
        ?>
        
</body>
</html>