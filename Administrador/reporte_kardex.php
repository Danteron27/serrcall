<?php

ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../css/Administrador/Estilo_Administrador.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>
<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta=$miPDO->PREPARE('SELECT * FROM kardex INNER JOIN stock ON kardex.Prd_ID = stock.Prd_ID ;');
$miConsulta->execute();


$query=isset($_REQUEST['query'])? $_REQUEST['query']:null;
$conss=$miPDO->PREPARE("SELECT * FROM kardex where Kar_Fecha_Entrada='$query';");
$conss->execute();
$ex=$_SESSION['admin_login'];
if (isset($_POST['agregar'])){
    //RECOGER LAS VARIABLES
    $Prd_Nombre=isset($_REQUEST['Prd_Nombre'])? $_REQUEST['Prd_Nombre']:null;
    $Kar_ID=isset($_REQUEST['Kar_ID'])? $_REQUEST['Kar_ID']:null;
    $Kar_Fecha_Entrada=isset($_REQUEST['Kar_Fecha_Entrada'])? $_REQUEST['Kar_Fecha_Entrada']:null;
    $Kar_Fecha_Salida=isset($_REQUEST['Kar_Fecha_Salida'])? $_REQUEST['Kar_Fecha_Salida']:null;
    $Kar_Cant_Entrada=isset($_REQUEST['Kar_Cant_Entrada'])? $_REQUEST['Kar_Cant_Entrada']:null;
    $Kar_Cant_Salida=isset($_REQUEST['Kar_Cant_Salida'])? $_REQUEST['Kar_Cant_Salida']:null;
    $miInsert=$miPDO->prepare("INSERT INTO kardex (Prd_ID, Kar_Fecha_Entrada, Kar_Fecha_Salida, Kar_Cant_Entrada, Kar_Cant_Salida, Encargado) VALUES ('$Prd_Nombre','$Kar_Fecha_Entrada','$Kar_Fecha_Salida','$Kar_Cant_Entrada',' $Kar_Cant_Salida','$ex')");
    
    //EJECUTAR 
$miInsert-> execute ();


//Redireccionar a leer

header ('Location: 6_Kardex_Administrador.php'); 
}


?>

  

<div style="float: left">
</div>
<div style="position:absolute; top:0; left:955px;"><strong>
<?php
            date_default_timezone_set("America/Bogota");
            echo date("d-m-y"); ?>
            </strong></div>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/serrcall/serrcall/img/serrcall_d.png" width="70px"/>
    <strong><p style="position:absolute; top:0; left:390px;">
            Electrodomesticos SERRCALL <br>
            &nbsp;&nbsp;Informe de kardex existentes</strong>
        </p>
    </center>
            <div class="hora">

<center>
<h3>Reporte de kardex</h3>
</center>

<table cellspacing="0" class="table table-striped table-bordered ">
            <thead class="thead-dark">
                <tr>
                    <th class="negro descrip text-center">Producto</th>
                    <th class="negro text-center">Encargado</th>
                    <th class="negro descrip text-center">Fecha entrada</th>
                    <th class="negro text-center">Fecha salida</th>
                    <th class="negro descrip text-center">Cantidad salida</th>
                    <th class="negro text-center">Cantidad entrada</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <?php if($miConsulta->rowCount()==0){
                        ?><tr><?php
                      } 
                      ?>  
                <?php foreach ($miConsulta as $valor):?>
                  <tr>   
                    <td><?= $valor['Prd_Nombre'];?></td>
                    <td><?= $valor['Encargado'];?></td>
                    <td><?= $valor['Kar_Fecha_Entrada'];?></td>
                    <td><?= $valor['Kar_Fecha_Salida'];?></td>
                    <td><?= $valor['Kar_Cant_Entrada'];?></td>
                    <td><?= $valor['Kar_Cant_Salida'];?></td>
                  </tr>
                <?php endforeach ?>
              </tr>
            </tbody>
            <tfoot>
                <tr>
                <th colspan="7" class="negro text-center">Serrcall</th>
                </tr>
            </tfoot>
    </table>
    <footer>
        <style>
            .footer{
    width: 100%;
    height: 30px;
    background-color: white;
    border-top: 1px solid black;
    bottom: 0;
    left: 0;
    position: fixed;
    align-items: center;
    flex-direction: row;
    justify-content: space-between;
    align-items: center;
  }
        </style>
  <div class="footer">
    <strong><p align="center"><strong><p align="center">Almacen de electrodomesticos Serrcall &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Carrera 100 #22G 34 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NIT 79.141.592-0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Teléfono:(1)2984829</p></p>
    </strong>
    </div>
  </div>
</footer>

</body>
</html
<?php
$html=ob_get_clean();
//echo $html;

require_once '../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

use Dompdf\Options;
$options=new Options();

$options->set(array('isRemoteEnabled' => true)); 
$dompdf = new Dompdf($options);

$options = $dompdf->getOptions();

$dompdf->setOptions($options);

$dompdf->loadHtml($html); 
$dompdf->setPaper('letter');
$dompdf->setPaper('A4','landscape');
$dompdf->render();
$dompdf->stream("reporte_.pdf", array("Attachment"=> false));
//cambiar la configuracion de xampp, en php.ini quitar el ; del gd para que funcionen las imagenes
//DESCARGAR $dompdf->stream("reporte_.pdf", array("Attachment"=> true));
?>