<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta=$miPDO->PREPARE('SELECT * FROM clientes;');
$miConsulta->execute();
if ($_SERVER['REQUEST_METHOD']=='POST'){
    //RECOGER LAS VARIABLES
    $Cli_ID=isset($_REQUEST['Cli_ID'])? $_REQUEST['Cli_ID']:null;
    $Cli_Cedula=isset($_REQUEST['Cli_Cedula'])? $_REQUEST['Cli_Cedula']:null;
    $Cli_Nombre=isset($_REQUEST['Cli_Nombre'])? $_REQUEST['Cli_Nombre']:null;
    $Cli_Direccion=isset($_REQUEST['Cli_Direccion'])? $_REQUEST['Cli_Direccion']:null;
    $Cli_Ciudad=isset($_REQUEST['Cli_Ciudad'])? $_REQUEST['Cli_Ciudad']:null;
    $Cli_Email=isset($_REQUEST['Cli_Email'])? $_REQUEST['Cli_Email']:null;
    $Cli_Celular=isset($_REQUEST['Cli_Celular'])? $_REQUEST['Cli_Celular']:null;
    $miInsert=$miPDO->prepare("INSERT INTO clientes (Cli_Cedula,Cli_Nombre,Cli_Direccion,Cli_Ciudad,Cli_Email,Cli_Celular) VALUES ('$Cli_Cedula','$Cli_Nombre','$Cli_Direccion','$Cli_Ciudad','$Cli_Email','$Cli_Celular')");

    //EJECUTAR 
$miInsert-> execute ();


//Redireccionar a leer

header ('Location: 7_Clientes_Administrador.php'); 
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="../img/cliente.png">
    <link href="../css/Administrador/Estilo_Administrador.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="https://trial.chatcompose.com/static/trial/all/global/export/css/main.5b1bd1fd.css" rel="stylesheet">    <script async type="text/javascript" src="https://trial.chatcompose.com/static/trial/all/global/export/js/main.a7059cb5.js?user=trial_Jhonatan1&lang=ES" user="trial_Jhonatan1" lang="ES"></script>  
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
    margin-left: 20%;
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
.error{
  font-size: 100px
}
.productos{
  margin-left:150px;
}
.negro{
  background-color: #006DB2;;
  color: white;
}
.margen{
  height: 100px;
}
  </style>
<body>
  
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Agregar cliente  <img src="../img/agregar.png" width="25px"  margin-top="5px"  margin-bottom="5px">
</button>
<form action="reportes_clientes.php"> 
<button type="submit" class="btn btn-dark agr">
  Imprimir reporte <img src="../img/agregar.png" width="25px"  margin-top="0px"  margin-bottom="5px">
</button>
</form>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar cliente</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
        <form action="" method="POST">
        <label for="">Numero de identificación</label><br>
        <input type="text" name="Cli_Cedula" id="Cli_Cedula" class="form-control">
        <br><br>
        <label for="">Nombre cliente</label><br>
        <input type="text" name="Cli_Nombre" id="Cli_Nombre" class="form-control">
        <br><br>
        <label for="">Direccion</label><br>
        <input type="text" name="Cli_Direccion" id="Cli_Direccion" class="form-control">
        <br><br>
        <label for="">Ciudad</label><br>
        <input type="text" name="Cli_Ciudad" id="Cli_Ciudad" class="form-control">
         <br><br>
         <label for="">Email</label><br>
        <input type="text" name="Cli_Email" id="Cli_Email" class="form-control">
         <br><br>
         <label for="">Celular</label><br>
        <input type="text" name="Cli_Celular" id="Cli_Celular" class="form-control">
         <br><br>
        </center>
      </div>
      <div class="modal-footer">
      <input type="submit" value="Agregar" class="btn btn-success">
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
                    <th class="negro text-center">Numero de identificación</th>
                    <th class="negro text-center">Nombre cliente</th>
                    <th class="negro descrip text-center">Direccion</th>
                    <th class="negro text-center">Ciudad</th>
                    <th class="negro descrip text-center">Email</th>
                    <th class="negro text-center">Celular</th>
                    <th class="negro text-center">Modificar</th>
                    <th class="negro text-center">Eliminar</th>
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
                <td class="gris"> <a href="../conn/Modificar/Clientes_Modificar.php?Cli_ID=<?=$valor['Cli_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                    <td><a href="../conn/Eliminar/Delete_Clientes.php?Cli_ID=<?=$valor['Cli_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                </tr>
              <?php endforeach ?>  
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10" class="negro text-center">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
    <div class="margen">
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
            <a href="6_Kardex_Administrador.php">     
              <div class="imagenes">
                <img src="../img/inventario.png" width="85px">
              </div>
              <h4 class="titulo">Kardex</h4>
            </a>
      
        </div>
       
        <div class="recuadros">
           
              <div class="selected">
                <img src="../img/clientes.png" width="85px">
              </div>
              <h4 class="titulo">Clientes</h4>

      
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
      <form action="home_admin.php">
        <button type="submit" class="hogar"><img src="../img/hogar.png" width="30px"></button></a>
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