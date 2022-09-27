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
$miConsulta=$miPDO->PREPARE('SELECT * FROM novedades;');
$miConsulta->execute();
$consul=isset($_REQUEST['consul'])? $_REQUEST['consul']:null;
if($consul==Null){
  $consul="N/A";
}

$conss=$miPDO->PREPARE("SELECT * FROM clientes where Cli_Cedula='$consul';");
$conss->execute();
$cliente=$conss->fetch();

$fecha_inicio=isset($_REQUEST['fecha_inicio'])? $_REQUEST['fecha_inicio']:null;
$fecha_fin=isset($_REQUEST['fecha_fin'])? $_REQUEST['fecha_fin']:null;


$filtro=$miPDO->PREPARE("SELECT * FROM novedades WHERE Nov_Fecha BETWEEN '$fecha_inicio' and '$fecha_fin';");
$filtro->execute();
if (isset($_POST['Agregar'])){
    //RECOGER LAS VARIABLES
    
    $Prd_ID=isset($_REQUEST['Prd_ID'])? $_REQUEST['Prd_ID']:null;
    $Cli_ID=isset($_REQUEST['Cli_ID'])? $_REQUEST['Cli_ID']:null;
    $Nov_Descripcion=isset($_REQUEST['Nov_Descripcion'])? $_REQUEST['Nov_Descripcion']:null;
    $Nov_Tipo=isset($_REQUEST['Nov_Tipo'])? $_REQUEST['Nov_Tipo']:null;
    $Nov_Fecha=isset($_REQUEST['Nov_Fecha'])? $_REQUEST['Nov_Fecha']:null;
    $miInsert=$miPDO->prepare("INSERT INTO novedades (Nov_Descripcion, Nov_Tipo, Nov_Fecha, Prd_ID, Cli_ID) VALUES ('$Nov_Descripcion','$Nov_Tipo','$Nov_Fecha', '$Prd_ID', '$Cli_ID')");
     //EJECUTAR 
$miInsert-> execute ();


//Redireccionar a leer

header ('Location: 4_Novedades_Administrador.php'); 
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
            &nbsp;&nbsp;&nbsp;Electrodomesticos SERRCALL <br>
            Informe de novedades existentes</strong>
        </p>
    </center>
            <div class="hora">

<center>
<h3>Reporte de novedades</h3>
</center>

<table cellspacing="0" class="table table-striped table-bordered ">
            <thead class="thead-dark">
                   <tr>
                       <th class="negro descrip text-center">Producto</th>
                       <th class="negro text-center">Cliente</th>
                       <th class="negro descrip text-center">Tipo de novedad</th>
                       <th class="negro text-center">Descripción novedad</th>
                       <th class="negro descrip text-center">Fecha de novedad</th>
                   </tr>
               </thead>
               <tbody>
               <tr>  
               <?php foreach ($miConsulta as $valor):?>
           <tr>   
                   <td class="gris"><?= $valor['Prd_ID'];?></td>
                   <td><?= $valor['Cli_ID'];?></td>
                   <td class="gris"><?= $valor['Nov_Tipo'];?></td>
                   <td><?= $valor['Nov_Descripcion'];?></td>
                   <td class="gris"><?= $valor['Nov_Fecha'];?></td>
                   </tr>
                  <?php endforeach ?>
                  
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
    <strong><p align="center">Almacen de electrodomesticos Serrcall &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Carrera 100 #22G 34 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NIT 79.141.592-0 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Teléfono:(1)2984829</p>
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