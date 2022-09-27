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
$paginacion ='SELECT * FROM proveedores';
$sentencia=$miPDO->prepare($paginacion);
$sentencia->execute();
$resultado=$sentencia->fetchAll();
$articulos_x_pagina = 15; 
$total_proveedores=$sentencia->rowCount();
$paginas=$total_proveedores/15;
$paginas=ceil($paginas);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Proveedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="../img/senor.png">
<link href="../css/Administrador/Estilo_Administrador.css" rel="stylesheet" type="text/css" media="screen" />

<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">  
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
    margin-left: 22.5%;
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
.jake{
  margin-top: 20px;
  margin-bottom: 20px;
}
.error{
  font-size: 50px
}
.negro{
  background-color: #006DB2;;
  color: white;
}
.margen{
  height:100px;
}
.productos{
margin-left:150px;
}
.navegador{
  margin-left: 43%;
}
  </style>
<body>
  
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Agregar proveedor <img src="../img/agregar.png" width="25px"  margin-top="5px"  margin-bottom="5px">
</button>
<form action="reporte_proveedores.php"> 
<button type="submit" class="btn btn-dark agr">
  Imprimir reporte <img src="../img/agregar.png" width="25px"  margin-top="0px"  margin-bottom="5px">
</button>
</form> 

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar proveedor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
        <form action="" method="POST">
        <label for="">Nombre de proveedor</label><br>
        <input type="text" name="Pro_Nombre" id="Pro_Nombre" class="form-control">
        <br><br>
        <label for="">Nit</label><br>
        <input type="text" name="Pro_Nit" id="Pro_Nit" class="form-control">
        <br><br>
        <label for="">Email</label><br>
        <input type="text" name="Pro_Email" id="Pro_Email" class="form-control">
         <br><br>
         <label for="">Celular</label><br>
        <input type="text" name="Pro_Celular" id="Pro_Celular" class="form-control">
         <br><br>
         <label for="">Dirección</label><br>
        <input type="text" name="Pro_Direccion" id="Pro_Direccion" class="form-control">
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
  <div class="container my-5">
      <?php if(!$_GET){
        header('location:3_Proveedores_Administrador.php?pagina=1');
      }
      if($_GET['pagina']>$paginas || $_GET['pagina']<=0 ){
        header('location:3_Proveedores_Administrador.php?pagina=1');
      }

      $iniciar=($_GET['pagina']-1)*$articulos_x_pagina;
     

      $sql_proveedores='SELECT * FROM proveedores LIMIT :inicar,:nproveedores';
      $sentencia_proveedores=$miPDO->prepare($sql_proveedores);
      $sentencia_proveedores->bindParam(':inicar', $iniciar, PDO::PARAM_INT);
      $sentencia_proveedores->bindParam(':nproveedores', $articulos_x_pagina, PDO::PARAM_INT);
      $sentencia_proveedores->execute();
      $resultado_proveedores = $sentencia_proveedores->fetchAll();
      ?>
      <table cellspacing="0" class="productos">
            <thead>
                <tr>
                    <th class="negro descrip text-center">Nombre proveedor
                      <div class="filtro">
                      <a href="Mysql.php?columna=Pro_Nombre&tipo=asc"><i class="fa fa-arrow-up"></i></a>
                      <a href="Mysql.php?columna=Pro_Nombre&tipo=desc"><i class="fa fa-arrow-down"></i></a>
                      </div>
                    </th>
                    <th class="negro text-center">Nit</th>
                    <th class="negro descrip text-center">Email</th>
                    <th class="negro text-center">Celular</th>
                    <th class="negro descrip text-center">Direccion</th>
                    <th class="negro text-center">Modificar</th>
                    <th class="negro text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                <?php if($miConsulta->rowCount()==0){
                      ?><tr><td colspan="7" rowspan="2" class="borde1 gris"><img src="../img/portapapeles.png" width="300px" class="jake"><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
                    </tr><?php
                    } ?>
                   <?php foreach ($resultado_proveedores as $valor):?>
        <tr>   
                <td class="gris"><?= $valor['Pro_Nombre'];?></td>
                <td ><?= $valor['Pro_Nit'];?></td>
                <td class="gris"><?= $valor['Pro_Email'];?></td>
                <td><?= $valor['Pro_Celular'];?></td>
                <td class="gris"><?= $valor['Pro_Direccion'];?></td>
                <td> <a href="../conn/Modificar/Proveedores_Modificar.php?Pro_ID=<?=$valor['Pro_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                    <td class="gris"> <a href="../conn/Eliminar/Delete_Proveedor.php?Pro_ID=<?=$valor['Pro_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                </tr>
               <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="negro text-center">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>     
    </div>
    
    <div class="navegador">
      <nav aria-label="..." position="center">
  <ul class="pagination">
    <li class="page-item <?php echo $_GET['pagina']<=1 ? 'disabled': '' ?>">
      <a class="page-link" 
      href="3_Proveedores_Administrador.php?pagina=<?php echo $_GET['pagina']-1 ?>">
      Anterior
    </a>
    </li>
    <?php for($i=0;$i<$paginas;$i++):?>
    <li class="page-item
    <?php echo $_GET['pagina']==$i+1 ?'active': '' ?>">
      <a class="page-link" href="3_Proveedores_Administrador.php?pagina=<?php echo $i+1?>">
      <?php echo $i+1?>
    </a></li>
    
    <?php endfor ?>
    <li class="page-item
    <?php echo $_GET['pagina']>=$paginas ? 'disabled': '' ?>">
      <a class="page-link" href="3_Proveedores_Administrador.php?pagina=<?php echo $_GET['pagina']+1 ?>">Siguiente</a>
    </li>
  </ul>
</nav>
</div>


    
    <div class="margen"></div>
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
               
              <div class="selected">
                <img src="../img/repartidor.png" width="85px">
              </div>
              <h4 class="titulo">Proveedores</h4>
            
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