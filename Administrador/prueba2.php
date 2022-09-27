<?php
//variables
$hostDB='localhost';
$nombreDB='serrcall';
$usuarioDB='root';
$contraseyaDB='';
//conecta con la base de datos 
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$miConsulta=$miPDO->PREPARE('SELECT * FROM proveedores;');
$miConsulta->execute();


$Prd_ID='9';
$Kar_Cant_Entrada=isset($_REQUEST['Kar_Cant_Entrada'])? $_REQUEST['Kar_Cant_Entrada']:null;
$Kar_Cant_Salida=isset($_REQUEST['Kar_Cant_Salida'])? $_REQUEST['Kar_Cant_Salida']:null;
$Seleccion=$miPDO->prepare("SELECT * FROM stock WHERE Prd_ID='$Prd_ID';");

$Seleccion-> execute ();
$stock=$Seleccion->fetch();
$Stock_Actual=$stock['Prd_Stock'];

if(($Kar_Cant_Entrada==NULL) && ($Kar_Cant_Salida>0)){
    $Resta=$Kar_Cant_Salida;
    $Restar=($Stock_Actual-$Resta);
    $miUpdate=$miPDO->prepare("UPDATE stock SET Prd_Stock='$Restar' WHERE Prd_ID='$Prd_ID';");
    $miUpdate->execute();

}if(($Kar_Cant_Entrada>0) && ($Kar_Cant_Salida==NULL)){
    $Suma=$Kar_Cant_Entrada;
    $Sumar=($Stock_Actual+$Suma);
    $miUpdate=$miPDO->prepare("UPDATE stock SET Prd_Stock='$Sumar' WHERE Prd_ID='$Prd_ID';");
    $miUpdate->execute();
}if(($Kar_Cant_Entrada>0) && ($Kar_Cant_Salida>0)){
    echo "No se permite realizar esta operacion";

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="Kar_Cant_Entrada">
    <input type="text" name="Kar_Cant_Salida">
    <input type="submit" value="Agregar" name="Agregar" class="btn btn-success">
    </form>
</body>
</html>