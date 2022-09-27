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
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
//Consulta SElect
$miConsulta=$miPDO->PREPARE('SELECT * FROM clientes;');
//Ejecutar Consulta 
$miConsulta->execute();
$admin=$miPDO->PREPARE("SELECT * FROM clientes where Cli_ID='admin';");
//Ejecutar Consulta 
$admin->execute();

$usuario=$miPDO->PREPARE("SELECT * FROM clientes where Cli_ID='clientes';");
//Ejecutar Consulta 
$usuario->execute();


if ($_SERVER['REQUEST_METHOD']=='POST'){
    //RECOGER LAS VARIABLES
    $Cli_ID=isset($_REQUEST['Cli_ID'])? $_REQUEST['Cli_ID']:null;
    $Cli_Cedula=isset($_REQUEST['Cli_Cedula'])? $_REQUEST['Cli_Cedula']:null;
    $Cli_Nombre=isset($_REQUEST['Cli_Nombre'])? $_REQUEST['Cli_Nombre']:null;
    $Cli_Direccion=isset($_REQUEST['Cli_Direccion'])? $_REQUEST['Cli_Direccion']:null;
    $Cli_Ciudad=isset($_REQUEST['Cli_Ciudad'])? $_REQUEST['Cli_Ciudad']:null;
    $Cli_Email=isset($_REQUEST['Cli_Email'])? $_REQUEST['Cli_Email']:null;
    $Cli_Celular=isset($_REQUEST['Cli_Celular'])? $_REQUEST['Cli_Celular']:null;
    
     //conexion a la DB
     require_once('../conn/conexion.php');
     $miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
     $hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
      //insertar
      $miInsert=$miPDO->prepare("INSERT INTO clientes (Cli_Cedula,Cli_Nombre,Cli_Direccion,Cli_Ciudad,Cli_Email,Cli_Celular) VALUES ('$Cli_Cedula','$Cli_Nombre','$Cli_Direccion','$Cli_Ciudad','$Cli_Email','$Cli_Celular')");

    //EJECUTAR 
$miInsert-> execute ();

//Redireccionar a leer

header ('Location: 7_Clientes_Administrador.php'); 
}
?>


<div style="position:absolute; top:0; left:955px;"><strong>
<?php
            date_default_timezone_set("America/Bogota");
            echo date("d-m-y"); ?>
            </strong></div>
            <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/serrcall/serrcall/img/serrcall_d.png" width="70px"/>
           
            <strong><p style="position:absolute; top:0; left:390px;">
            Electrodomesticos SERRCALL <br>
            Informe de clientes existentes</strong>
        </p>
           
<br>
<br>
<br>
<center>
<h2>informe de clientes</h2>
</center>

<table cellspacing="0" class="table table-striped table-bordered ">
            <thead class="thead-dark">
                <tr>
                    <th class="negro text-center">Numero de identificación</th>
                    <th class="negro text-center">Nombre cliente</th>
                    <th class="negro descrip text-center">Direccion</th>
                    <th class="negro text-center">Ciudad</th>
                    <th class="negro descrip text-center">Email</th>
                    <th class="negro text-center">Celular</th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <?php if($miConsulta->rowCount()==0){
                      ?><tr><td colspan="8" rowspan="3" class="borde1 gris"><img src="../img/portapapeles.png" width="300px" class="jake" margin-><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
                    </tr><?php
                    } ?>  
                   <?php foreach ($miConsulta as $valor):?>
            <tr>
            
                <td class="gris"><?= $valor['Cli_Cedula'];?></td>
                <td><?= $valor['Cli_Nombre'];?></td>
                <td class="gris"><?= $valor['Cli_Direccion'];?></td>
                <td><?= $valor['Cli_Ciudad'];?></td>
                <td class="gris"><?= $valor['Cli_Email'];?></td>
                <td><?= $valor['Cli_Celular'];?></td>
                
                </tr>
              <?php endforeach ?>  
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10" class="negro text-center">Serrcall</th>
                    
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
</html>
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
//DESCARGAR $dompdf->stream("reporte_.pdf", array("Attachment"=> true));
?>
