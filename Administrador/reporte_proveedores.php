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
$miConsulta=$miPDO->PREPARE('SELECT * FROM proveedores;');
$miConsulta->execute();
if ($_SERVER['REQUEST_METHOD']=='POST'){
    //RECOGER LAS VARIABLES
    $Pro_ID=isset($_REQUEST['Pro_ID'])? $_REQUEST['Pro_ID']:null;
    $Pro_Nombre=isset($_REQUEST['Pro_Nombre'])? $_REQUEST['Pro_Nombre']:null;
    $Pro_Nit=isset($_REQUEST['Pro_Nit'])? $_REQUEST['Pro_Nit']:null;
    $Pro_Email=isset($_REQUEST['Pro_Email'])? $_REQUEST['Pro_Email']:null;
    $Pro_Celular=isset($_REQUEST['Pro_Celular'])? $_REQUEST['Pro_Celular']:null;
    $Pro_Direccion=isset($_REQUEST['Pro_Direccion'])? $_REQUEST['Pro_Direccion']:null;
    $miInsert=$miPDO->prepare("INSERT INTO proveedores (Pro_Nombre, Pro_Nit, Pro_Email, Pro_Celular, Pro_Direccion) VALUES ('$Pro_Nombre','$Pro_Nit','$Pro_Email','$Pro_Celular','$Pro_Direccion')");
    
    //EJECUTAR 
$miInsert-> execute ();

//Redireccionar a leer

header ('Location: 3_Proveedores_Administrador.php'); 
}
?>

<div style="float: left">
</div>
<div style="position:absolute; top:0; left:955px;"><strong>
<?php
            date_default_timezone_set("America/Bogota");
            echo date("d-m-y"); ?>
            </strong></div>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/serrcall/img/serrcall_d.png" width="70px"/>
    <strong><p style="position:absolute; top:0; left:390px;">
            &nbsp;&nbsp;&nbsp;Electrodomesticos SERRCALL <br>
            Informe de proveedores existentes</strong>
        </p>
    </center>
            <div class="hora">

<center>
<h3>Reporte de proveedores</h3>
</center>

<table cellspacing="0" class="table table-striped table-bordered ">
            <thead class="thead-dark">
                <tr>
                    <th class="negro descrip text-center">Nombre proveedor</th>
                    <th class="negro text-center">Nit</th>
                    <th class="negro descrip text-center">Email</th>
                    <th class="negro text-center">Celular</th>
                    <th class="negro descrip text-center">Direccion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                   <?php foreach ($miConsulta as $valor):?>
        <tr>   
                <td class="gris"><?= $valor['Pro_Nombre'];?></td>
                <td ><?= $valor['Pro_Nit'];?></td>
                <td class="gris"><?= $valor['Pro_Email'];?></td>
                <td><?= $valor['Pro_Celular'];?></td>
                <td class="gris"><?= $valor['Pro_Direccion'];?></td>
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