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
$miConsulta=$miPDO->PREPARE('SELECT * FROM usuarios;');
//Ejecutar Consulta 
$miConsulta->execute();
$admin=$miPDO->PREPARE("SELECT * FROM usuarios where Usu_Rol='admin';");
//Ejecutar Consulta 
$admin->execute();

$usuario=$miPDO->PREPARE("SELECT * FROM usuarios where Usu_Rol='usuarios';");
//Ejecutar Consulta 
$usuario->execute();


if ($_SERVER['REQUEST_METHOD']=='POST'){
    //RECOGER LAS VARIABLES
    $login=isset($_REQUEST['login'])? $_REQUEST['login']:null;
    $pass=isset($_REQUEST['pass'])? $_REQUEST['pass']:null;
    $rol=isset($_REQUEST['rol'])? $_REQUEST['rol']:null;
     //conexion a la DB
     require_once('../conn/conexion.php');
     $miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
     $hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
      //insertar
    $miInsert=$miPDO->prepare("INSERT INTO usuarios (Usu_Login, Usu_Password, Usu_Rol) VALUES ('$login','$pass','$rol')");
    
    //EJECUTAR 
$miInsert-> execute ();

//Redireccionar a leer

header ('Location: 5_Usuario_Administrador.php'); 
}
?>

<div style="float: left">
<img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/serrcall/img/serrl.png" width="100px"  margin-top="5px"  margin-bottom="5px">
</div>
    <center>
            Electrodomesticos SERRCALL <br>
            Informe de usuarios existentes<br>
            </center>
            <div class="hora">

            <?php
            date_default_timezone_set("America/Bogota");
            echo date("d-m-y:i a"); ?>
            </div>
           
<br>
<br>
<br>
<center>
<h2>Lista de usuarios</h2>
</center>

<table cellspacing="0" class="table table-striped table-bordered ">
            <thead class="thead-dark">
                <tr>
                    <th class="negro text-center">Usuario</th>
                    <th class="negro descrip text-center">Contraseña</th>
                    <th class="negro text-center">Rol</th>
                    <th class="negro text-center">Eliminar</th>
                    
                </tr>
            </thead>
            <tbody>
            <?php if($miConsulta->rowCount()==0){
                      ?><tr><td colspan="7" rowspan="2" class="borde1"><img src="../img/pagina_vacia.png" width="600px" class="jake" ><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
                    </tr><?php
                    } ?>   
            <?php foreach ($admin as $valor):?>
        <tr>
                <td class="gris"><?= $valor['Usu_Login'];?></td>
                <td><?= $valor['Usu_Password'];?></td>
                <td class="gris"><?= $valor['Usu_Rol'];?></td>
                <td class="gris"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/serrcall/img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></td>
                </tr>
                <?php endforeach ?>
                <?php foreach ($usuario as $valor):?>
        <tr>
                <td class="gris"><?= $valor['Usu_Login'];?></td>
                <td><?= $valor['Usu_Password'];?></td>
                <td class="gris"><?= $valor['Usu_Rol'];?></td>
                
                <td class="gris"><img src="http://<?php echo $_SERVER['HTTP_HOST'];?>/serrcall/img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></td>
                
              </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="negro text-center">Serrcall </th>
                    
                </tr>
            </tfoot>
    </table>
</body>
</html>
<?php
$html=ob_get_clean();
//echo $html;

require_once '../lib/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true)); 
$dompdf->setOptions($options);

$dompdf->loadHtml($html); 
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4'.'landscape');
$dompdf->render();
$dompdf->stream("reporte_.pdf", array("Attachment"=> false));
?>