<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta=$miPDO->PREPARE('SELECT kardex.Kar_ID, kardex.Kar_Cant_Entrada, kardex.Kar_Cant_Salida, kardex.Kar_Fecha_Entrada, kardex.Kar_Fecha_Salida, Kardex.Encargado, proveedores.Pro_Nombre, clientes.Cli_Nombre, stock.Prd_Nombre FROM kardex INNER JOIN clientes ON kardex.Cli_ID=clientes.Cli_ID INNER JOIN proveedores ON kardex.Pro_ID = proveedores.Pro_ID INNER JOIN stock on kardex.Prd_ID=stock.Prd_ID;');
$miConsulta->execute();


$query=isset($_REQUEST['query'])? $_REQUEST['query']:null;
$conss=$miPDO->PREPARE("SELECT * FROM kardex where Kar_Fecha_Entrada='$query';");
$conss->execute();
$ex=$_SESSION['admin_login'];

if (isset($_POST['agregar'])){
    //RECOGER LAS VARIABLES
    $Prd_ID=isset($_REQUEST['Prd_ID'])? $_REQUEST['Prd_ID']:null;
    $Kar_ID=isset($_REQUEST['Kar_ID'])? $_REQUEST['Kar_ID']:null;
    $Kar_Fecha_Entrada=isset($_REQUEST['Kar_Fecha_Entrada'])? $_REQUEST['Kar_Fecha_Entrada']:null;
    $Kar_Fecha_Salida=isset($_REQUEST['Kar_Fecha_Salida'])? $_REQUEST['Kar_Fecha_Salida']:null;
    $Kar_Cant_Entrada=isset($_REQUEST['Kar_Cant_Entrada'])? $_REQUEST['Kar_Cant_Entrada']:null;
    $Kar_Cant_Salida=isset($_REQUEST['Kar_Cant_Salida'])? $_REQUEST['Kar_Cant_Salida']:null;
    $Cli_ID=isset($_REQUEST['Cli_ID'])? $_REQUEST['Cli_ID']:null;
    $Pro_ID=isset($_REQUEST['Pro_ID'])? $_REQUEST['Pro_ID']:null;



    $Seleccion=$miPDO->prepare("SELECT * FROM stock WHERE Prd_ID='$Prd_ID';");

    $Seleccion-> execute ();
    $stock=$Seleccion->fetch();
    $Stock_Actual=$stock['Prd_Stock'];

if(($Kar_Cant_Entrada==NULL) && ($Kar_Cant_Salida>0)){
    $Resta=$Kar_Cant_Salida;
    $Restar=($Stock_Actual-$Resta);
    $miUpdate=$miPDO->prepare("UPDATE stock SET Prd_Stock='$Restar' WHERE Prd_ID='$Prd_ID';");
    $miUpdate->execute();
    $miInsert=$miPDO->prepare("INSERT INTO kardex (Prd_ID, Kar_Fecha_Entrada, Kar_Fecha_Salida, Kar_Cant_Entrada, Kar_Cant_Salida, Encargado, Cli_ID, Pro_ID) VALUES ('$Prd_ID','$Kar_Fecha_Entrada','$Kar_Fecha_Salida','$Kar_Cant_Entrada',' $Kar_Cant_Salida','$ex','$Cli_ID','$Pro_ID')");
    $miInsert-> execute ();

}if(($Kar_Cant_Entrada>0) && ($Kar_Cant_Salida==NULL)){
    $Suma=$Kar_Cant_Entrada;
    $Sumar=($Stock_Actual+$Suma);
    $miUpdate=$miPDO->prepare("UPDATE stock SET Prd_Stock='$Sumar' WHERE Prd_ID='$Prd_ID';");
    $miUpdate->execute();
    $miInsert=$miPDO->prepare("INSERT INTO kardex (Prd_ID, Kar_Fecha_Entrada, Kar_Fecha_Salida, Kar_Cant_Entrada, Kar_Cant_Salida, Encargado, Cli_ID, Pro_ID) VALUES ('$Prd_ID','$Kar_Fecha_Entrada','$Kar_Fecha_Salida','$Kar_Cant_Entrada',' $Kar_Cant_Salida','$ex','$Cli_ID','$Pro_ID')");
    $miInsert-> execute ();
}if(($Kar_Cant_Entrada>0) && ($Kar_Cant_Salida>0)){

header ('Location: 6_Kardex_Administrador.php'); 
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Kardex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="../img/inventarios.png">
<link href="https://trial.chatcompose.com/static/trial/all/global/export/css/main.5b1bd1fd.css" rel="stylesheet">    
<script async type="text/javascript" src="https://trial.chatcompose.com/static/trial/all/global/export/js/main.a7059cb5.js?user=trial_Jhonatan1&lang=ES" user="trial_Jhonatan1" lang="ES"></script>  
    <link href="../css/Administrador/Estilo_Administrador.css" rel="stylesheet" type="text/css" media="screen" />
  </head>
  <style>
*{
  font-family: 'Quicksand', sans-serif;
}
h4{
   font-size: 20px;
   margin-top: 17px;
  }
  a{
    text-decoration: none;
  }
  p{
   margin-top: 10px;
  }
  .agr{
    margin-top: 10px;
    margin-bottom: 10px;
    margin-left: 24%;
  }
  .text-center{
    background-color: rgb(255, 255, 255);
    border: 1px solid rgb(0, 0, 0,0.3);  
    height: 40px;
    width: 150px;
}
.descrip{
    border: 1px solid rgb(0, 0, 0,0.3);  
    width: 200px;
}
.productos{
  margin-left:200px;
}
.consul{
  margin-top: 20px;
  width: 175px;
}
.consul2{
  width: 175px;
}
.abuebo{
  margin-left:460px;
}
.consultt{
  margin-left:460px;
}
  </style>
<body>
<form action="reporte_kardex.php"> 
<button type="submit" class="btn btn-dark agr">
  Imprimir reporte <img src="../img/agregar.png" width="25px"  margin-top="0px"  margin-bottom="5px">
</button>
</form>
<button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Agregar registro Kardex
</button><br>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
        <form action="" method="POST">
        <label for="">Nombre del producto</label>
            <select id="" name="Prd_ID"  class="form-control">
            <?php
            //conexion a la DB
                require_once ('../conn/conexion.php');
                $miPDO =new PDO ($hostPDO,$usuarioDB, $contraseyaDB);
                $Consulta= $miPDO->prepare('SELECT * FROM stock;');
                $Consulta->execute();
                while ($row=$Consulta->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                ?>
                <option value="<?php echo $Prd_ID; ?>"><?php echo $Prd_Nombre; ?></option>
<?php
}
?>
 </select>
        <br><br>
        <label for="">Encargado</label><br>
        <input type="text" name="Encargado" id="" class="form-control" value="<?php echo $ex;?>" disabled>
        <br><br>
        <label for="">Fecha entrada</label><br>
        <input type="date" name="Kar_Fecha_Entrada" id="Kar_Fecha_Entrada" class="form-control">
         <br><br>
         <label for="">Fecha salida</label><br>
        <input type="date" name="Kar_Fecha_Salida" id="Kar_Fecha_Salida" class="form-control">
         <br><br>
         <label for="">Cantidad entrada</label><br>
        <input type="number" name="Kar_Cant_Entrada" id="Kar_Cant_Entrada" class="form-control">
         <br><br>
         <label for="">Cantidad salida</label><br>
        <input type="number" name="Kar_Cant_Salida" id="Kar_Cant_Salida" class="form-control">
         <br><br>
         <label for="">Proveedor</label>
            <select id="Pro_ID" type="selected" name="Pro_ID" class="form-control">
            <option value="">Seleccione el proveedor</option>
            <?php
            //conexion a la DB
                require_once ('../conn/conexion.php');
                $miPDO =new PDO ($hostPDO,$usuarioDB, $contraseyaDB);
                $Consulta= $miPDO->prepare('SELECT * FROM proveedores;');
                $Consulta->execute();
                while ($row=$Consulta->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                
                ?>
                <option value="<?php echo $Pro_ID; ?>"><?php echo $Pro_Nombre; ?></option>
<?php
}
?>
     </select>
     <label for="">Cliente</label>
            <select id="Cli_ID" type="selected" name="Cli_ID" class="form-control">
            <option value="">Seleccione el Cliente</option>
            <?php
            //conexion a la DB
                require_once ('../conn/conexion.php');
                $miPDO =new PDO ($hostPDO,$usuarioDB, $contraseyaDB);
                $Consulta= $miPDO->prepare('SELECT * FROM clientes;');
                $Consulta->execute();
                while ($row=$Consulta->fetch(PDO::FETCH_ASSOC))
                {
                    extract($row);
                
                ?>
                <option value="<?php echo $Cli_ID; ?>"><?php echo $Cli_Nombre; ?></option>
<?php
}
?>
     </select>
        </center>
      </div>
      <div class="modal-footer">
      <input type="submit" value="Agregar" class="btn btn-success" name="agregar">
    </form>    
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
  <center>
    <table cellspacing="0" class="productos">
            <thead>
                <tr>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Encargado</th>
                    <th class="text-center">Fecha entrada</th>
                    <th class="text-center">Fecha salida</th>
                    <th class="text-center">Cantidad entrada</th>
                    <th class="text-center">Cantidad salida</th>
                    <th class="text-center">Proveedor</th>
                    <th class="text-center">Cliente</th>
                    <th class="text-center">Modificar</th>
                    <th class="text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
              <tr>
                <?php if($miConsulta->rowCount()==0){
                        ?><tr><td colspan="10" rowspan="2" class="borde1"><img src="../img/pagina_vacia.png" width="600px" class="jake" ><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
                      </tr><?php
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
                    <td><?= $valor['Pro_Nombre'];?></td>
                    <td><?= $valor['Cli_Nombre'];?></td>
                    <td class="gris"> <a href="../conn/Modificar/Kardex_Modificar.php?Kar_ID=<?=$valor['Kar_ID'];?>"><button type="button" class="btn btn-warning" >?</button></a></td>
                        <td class="gris"> <a href="../conn/Eliminar/Delete_Kardex.php?Kar_ID=<?=$valor['Kar_ID'];?>" button type="button" class="btn btn-danger">X</button> </td>
                  </tr>
                <?php endforeach ?>
              </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10" class="text-center">Serrcall</th>
                </tr>
            </tfoot>
    </table>
    
    </center>
<html>
<form action="" method="POST">
        <input type="date" name="query" id="query" class="form-control consul abuebo col">
        <input type="submit" value="Consulta" name="Consulta" class="btn btn-success consul2 abuebo col">
        </div>
      </div>
</form>
</html>
<?php 
if(isset($_POST['Consulta'])){
   if($conss->rowCount()==0){
     ?> <center><?php 
       echo "No hay registros existentes con la fecha ingresada.";
   }else{
?>

  <br>
  <table cellspacing="0" class="consultt">
            <thead>
                <tr>
                    <th class="text-center">Producto</th>
                    <th class="text-center">Encargado</th>
                    <th class="text-center">Fecha entrada</th>
                    <th class="text-center">Fecha salida</th>
                    <th class="text-center">Cantidad entrada</th>
                    <th class="text-center">Cantidad salida</th>
                   
                </tr>
            </thead>
            <tbody>
              <tr>
    <?php foreach ($conss as $valor):?>
      <td><?= $valor['Kar_ID'];?></td>
      <td><?= $valor['ID_Usuario'];?></td>
      <td><?= $valor['Kar_Fecha_Entrada'];?></td>
    <td><?= $valor['Kar_Fecha_Salida'];?></td>
    <td><?= $valor['Kar_Cant_Entrada'];?></td>
    <td><?= $valor['Cant_Salida'];?></td>
    <?php endforeach ?>
    
    </tbody>
    <tfoot>
        <tr>
            <th colspan="8" class="text-center">Serrcall - Consulta</th>
        </tr>
    </tfoot>
    <?php
}
}
?>
</tr>
            
</center>
  </center>
    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Administrador</h1>
             </div>
             <div class="selecciones">
          <div class="recuadros">
                 <a href="2_Productos_Administrador.php">
                <div class="imagenes">
                  <img src="../img/caja.png" width="85px">
                </div>
                <h4 class="titulo">Productos</h4>
              </a>
          </div>
          <div class="recuadros">
          <a href="3_Proveedores_Administrador.php">
              <div class="imagenes">
                <img src="../img/repartidor.png" width="85px">
              </div>
              <h4 class="titulo">Proveedores</h4>
            </a>
          </div>     
    </div>
    <div class="selecciones">
          <div class="recuadros">
            <a href="4_Novedades_Administrador.php">     
              <div class="imagenes">
                <img src="../img/bombilla.png" width="85px">
              </div>
              <h4 class="titulo">Novedades</h4>
            </a>
        </div>
       
        <div class="recuadros">
            <a href="5_Usuario_Administrador.php">     
              <div class="imagenes">
                <img src="../img/usuario.png" width="85px">
              </div>
              <h4 class="titulo">Usuario</h4>
            </a>
        </div>
      </div>
      <div class="selecciones">
          <div class="recuadros">
              
              <div class="selected">
                <img src="../img/inventario.png" width="85px">
              </div>
              <h4 class="titulo">Kardex</h4>
         
      
        </div>
       
        <div class="recuadros">
            <a href="7_Clientes_Administrador.php">     
              <div class="imagenes">
                <img src="../img/clientes.png" width="85px">
              </div>
              <h4 class="titulo">Clientes</h4>
            </a>
      
        </div>
      </div>
      <style>
        .hogar{
          width: 100px;
          height: 45px;
          border-radius: 20px;
          border: 2px solid black;
          transition: 0.3s;
          background-color: rgb(143, 143, 143);
          margin-top: 50%;
        }
      .hogar:hover{
          background-color: rgb(201, 198, 198);
        }
      </style>
      <center>
        <form action="home_admin.php">
        <button type="submit" class="hogar"><img src="../img/hogar.png" width="30px"></button></a>
      </center>
    </form>    
    </div>

</body>
<footer>
  <div class="footer">
    <div class="contenido">
    <p>SERRCALL</p>
    <P>Teléfono: (1) 2984829</P>
    <p>Dirección: Cl. 22g #100-04, Bogotá</p>
    <p><img src="../img/snail_footer.png" width="23px"></p>
    </div>
  </div>
</footer>
</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>