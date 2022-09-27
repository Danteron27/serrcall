<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes de productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link href="../css/Administrador/Estilo_Administrador.css" rel="stylesheet" type="text/css" media="screen" />
    
</head>
<body>
    <?php
    require_once('../conn/conexion.php');
    $miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
    $hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
    $miConsulta=$miPDO->PREPARE('SELECT stock.Prd_Nombre, Prd_Precio, Prd_Descripcion, Prd_Serial, Prd_Categoria, Prd_Modelo, Prd_Marca, Pro_ID, Cli_ID, productos.Prd_ID FROM stock INNER JOIN productos ON stock.Prd_ID=productos.Stock_ID where productos.Prd_ID;');
    $miConsulta->execute();
    
    if (isset($_POST['Agregar'])){
        $Prd_Nombre=isset($_REQUEST['Prd_Nombre'])? $_REQUEST['Prd_Nombre']:null;
        $Prd_Precio=isset($_REQUEST['Prd_Precio'])? $_REQUEST['Prd_Precio']:null;
        $Prd_Descripcion=isset($_REQUEST['Prd_Descripcion'])? $_REQUEST['Prd_Descripcion']:null;
        $Prd_Serial=isset($_REQUEST['Prd_Serial'])? $_REQUEST['Prd_Serial']:null;
        $Prd_Categoria=isset($_REQUEST['Prd_Categoria'])? $_REQUEST['Prd_Categoria']:null;
        $Prd_Modelo=isset($_REQUEST['Prd_Modelo'])? $_REQUEST['Prd_Modelo']:null;
        $Prd_Marca=isset($_REQUEST['Prd_Marca'])? $_REQUEST['Prd_Marca']:null;
        $Pro_ID=isset($_REQUEST['Pro_ID'])? $_REQUEST['Pro_ID']:null;
        $Cli_ID=isset($_REQUEST['Cli_ID'])? $_REQUEST['Cli_ID']:null;
        $miInsert=$miPDO->prepare("INSERT INTO productos (Stock_ID, Prd_Precio, Prd_Descripcion, Prd_Serial, Prd_Categoria, Prd_Modelo, Prd_Marca, Pro_ID, Cli_ID, Encargado) VALUES ('$Prd_Nombre','$Prd_Precio','$Prd_Descripcion','$Prd_Serial','$Prd_Categoria', '$Prd_Modelo', '$Prd_Marca', '$Pro_ID', '$Cli_ID', '$ex')");
        
        //EJECUTAR 
    $miInsert-> execute ();
    header ('Location: 2_Productos_Administrador.php'); 
    }
    
    
    $ConProductos=$miPDO->PREPARE('SELECT * FROM stock;');
    $ConProductos->execute();
    if (isset($_POST['Stock'])){
        //RECOGER LAS VARIABLES
        $Prd_Nombre=isset($_REQUEST['Prd_Nombre'])? $_REQUEST['Prd_Nombre']:null;
        $Prd_Stock_Min=isset($_REQUEST['Prd_Stock_Min'])? $_REQUEST['Prd_Stock_Min']:null;
        $Prd_Stock=isset($_REQUEST['Prd_Stock'])? $_REQUEST['Prd_Stock']:null;
        $Prd_Stock_Max=isset($_REQUEST['Prd_Stock_Max'])? $_REQUEST['Prd_Stock_Max']:null;
        $InsProductos=$miPDO->prepare("INSERT INTO stock (Prd_Nombre, Prd_Stock_Min, Prd_Stock, Prd_Stock_Max) VALUES ('$Prd_Nombre','$Prd_Stock_Min','$Prd_Stock','$Prd_Stock_Max')");
        $InsProductos-> execute ();
        //Redireccionar a leer

header ('Location: 2_Productos_Administrador.php'); 
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
            Informe de proveedores existentes</strong>
        </p>
<br>
<br>
<center>
<h2>informe de productos</h2>
</center>

<table cellspacing="0" class="table table-striped table-bordered ">
            <thead class="thead-dark">
                <tr>
                    <th class="negro text-center">Nombre Producto</th>
                    <th class="negro text-center">Precio</th>
                    <th class="negro descrip text-center">Descripción</th>
                    <th class="negro text-center">Serial</th>.
                    <th class="negro text-center">Categoria</th>
                    <th class="negro text-center">Modelo</th>
                    <th class="negro text-center">Marca</th>
                    <th class="negro text-center">Proveedor</th>
                    <th class="negro text-center">Cliente</th>
                    
                </tr>
            </thead>
            <tbody>
               <tr>
               <?php if($miConsulta->rowCount()==0){
                      ?><tr><td colspan="11" rowspan="2" class="borde1"><img src="../img/pagina_vacia.png" width="600px" class="jake" ><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
                    </tr><?php
                    } ?>
                   <?php foreach ($miConsulta as $valor):?>
                <tr>   
                  <td><?= $valor['Prd_Nombre'];?></td>
                  <td><?= $valor['Prd_Precio'];?></td>
                  <td><?= $valor['Prd_Descripcion'];?></td>
                  <td><?= $valor['Prd_Serial'];?></td>
                  <td><?= $valor['Prd_Categoria'];?></td>
                  <td><?= $valor['Prd_Modelo'];?></td>
                  <td><?= $valor['Prd_Marca'];?></td>
                  <td><?= $valor['Pro_ID'];?></td>
                  <td><?= $valor['Cli_ID'];?></td>
                </tr>
               <?php endforeach ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="negro text-center" colspan="10">Serrcall</th>
                    
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
