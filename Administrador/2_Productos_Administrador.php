<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta=$miPDO->PREPARE('SELECT stock.Prd_Nombre, Prd_Precio, Prd_Descripcion, Prd_Serial, Prd_Categoria, Prd_Modelo, Prd_Marca, productos.Prd_ID ,productos.Encargado FROM stock INNER JOIN productos ON stock.Prd_ID=productos.Stock_ID where productos.Prd_ID;');
$miConsulta->execute();
$ex=$_SESSION['admin_login'];
$Serial = isset($_REQUEST['Serial']) ? $_REQUEST['Serial'] : null;
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
    $miInsert=$miPDO->prepare("INSERT INTO productos (Stock_ID, Prd_Precio, Prd_Descripcion, Prd_Serial, Prd_Categoria, Prd_Modelo, Prd_Marca, Encargado) VALUES ('$Prd_Nombre','$Prd_Precio','$Prd_Descripcion','$Prd_Serial','$Prd_Categoria', '$Prd_Modelo', '$Prd_Marca', '$ex')");
    
    //EJECUTAR 
$miInsert-> execute ();
header ('Location: 2_Productos_Administrador.php'); 
}

$filtro = $miPDO->PREPARE("SELECT * FROM productos WHERE Prd_Serial='$Serial';");
$filtro->execute();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="../img/productos.png">
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
    margin-left: 22%;
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
.buton{
    border: 1px solid rgb(0, 0, 0,0.3);  
    width: 20px;
}
.productos{
  margin-left: 300px;
}
.negro {
    background-color: #006DB2;
    ;
    color: white;
  }
  .formu {
    width: 170px;
    margin-left: 30px;
  }
  .flex-container {
    display: flex;
    flex-direction: row;
    width: 100%;
  }
  .separador{
border-top: 1px solid #cccbc2;
    height:1px;
    width: 106.8%;
    margin-top: 20px;
    margin-left:-16px;
  }
  .stock{
  color: black;
 
  }
  .borde{
    border-bottom: solid black 4px;
    border-bottom-left-radius: 20px;
    border-bottom-right-radius: 20px;
  }
  .conten{
 
        width: 100%;
        height: 100%;
        display: flex;
    flex-direction: row;
    }
    .conten-2{

        width: 50%;
        height: 100%;
    }
    .conten-3{
 
        width: 50%;
        height: 100%;
    }
    .conten-separador{


    height: 500px;
    width: 1px;
    margin-top: 0%;
    margin-right: 10px;
    margin-left: 10px;
    }
  </style>
<body>
  
<button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#modalcanonico">
  Opciones <img src="../img/opciones.png" width="20px">
</button>


<!-- Modal -->
<div class="modal fade" id="modalcanonico" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Opciones</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
  <p>Filtrar</p>
   
  <form action="" method="POST">
  <div class="flex-container">
  <button type="submit" class="btn btn-dark" name="Filtrar">Filtrar <img src="../img/filtrar.png" width="20px"></button>                                                                                             
  <input type="text" name="Serial" class="form-control formu" placeholder="Serial*">   
   </div>  
   </form>
 <br>
 <div class="separador"></div>
 <br>
 <p>Descargar</p>
 <form action="reportes_productos.php" target="_blank"> 
       <button type="submit" class="btn btn-dark">
     Descargar reporte <img src="../img/descargar.png" width="25px"  margin-top="0px"  margin-bottom="5px">
       </button>
       </form>
       <br>
 <div class="separador"></div>
 <br>
 <p>Ir a Stock</p>
                                                                                                  
                <div class="recuadros borde">   
                <a href="8_Stock_Administrador.php">    
                <div class="imagenes">
                  <img src="../img/en-stock.png" width="85px">
                </div>
                <h4 class="titulo stock">Stock</h4>
                </a> 
          </div>
<br><br>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>
                                                                    

 <button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Agregar producto   <img src="../img/agregar.png" width="20px">
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
       
    
        <div class="conten">
    <div class="conten-2">
        <form action="" method="POST">
            <label for="">Nombre del producto</label>
                <select id="" name="Prd_Nombre"  class="form-control">
                <option value="1">Seleccione el producto</option>
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
            <br>
            <label for="">Precio del producto</label><br>
            <input type="text" name="Prd_Precio" id="" class="form-control">
            <br>
            <label for="">Descripción del producto</label><br>
            <textarea class="form-control" name="Prd_Descripcion" rows="3"></textarea>
            <br>
            <label for="">Serial del producto</label><br>
            <input type="text" name="Prd_Serial" id="" class="form-control">
             <br>
            <label for="">Categoria del producto</label><br>
            <select name="Prd_Categoria" id="" class="form-control">
              <option value="Electodomesticos Grandes">Electodomesticos Grandes</option>
              <option value="Electodomesticos Medianos">Electodomesticos Medianos</option>
              <option value="Electrodomesticos Pequeños">Electrodomesticos Pequeños</option>
            </select>
            <br> 
    </div>
    <div class="conten-separador"></div>
    <div class="conten-3">
        <label for="">Marca del producto</label><br>
        <input type="text" name="Prd_Marca" id="" class="form-control">
        <br>
        <label for="">Modelo del producto</label><br>
        <input type="text" name="Prd_Modelo" id="" class="form-control">
        <br>
    
     <label for="">Encargado</label><br>
<input type="text" name="Encargado" class="form-control" value="<?php echo $ex; ?>" disabled>
    
        </center>
      </div>
      <div class="modal-footer">
      <input type="submit" value="Agregar" name="Agregar" class="btn btn-success">
    </form>    
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>


  <?php
  if (isset($_POST['Filtrar'])) {
    switch ($filtro->rowCount()) {
      case 0:
  ?>
        <div class="agr">
          <p>No se encuentran registros con el Serial: <em><?php echo $Serial; ?></em> </p>
        </div>
        <center>

          
<table cellspacing="0" class="productos">
            <thead>
                <tr>
                    <th class="text-center negro">Nombre Producto</th>
                    <th class="text-center negro">Precio</th>
                    <th class="text-center negro">Descripción</th>
                    <th class="text-center negro">Serial</th>
                    <th class="text-center negro">Categoria</th>
                    <th class="text-center negro">Modelo</th>
                    <th class="text-center negro">Marca</th>
                    <th class="text-center negro">Encargado</th>
                    <th class="text-center buton negro">Modificar</th>
                    <th class="text-center buton negro">Eliminar</th>
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
                  <td class="gris"><?= $valor['Prd_Nombre'];?></td>
                  <td><?= $valor['Prd_Precio'];?></td>
                  <td class="gris"><?= $valor['Prd_Descripcion'];?></td>
                  <td><?= $valor['Prd_Serial'];?></td>
                  <td class="gris"><?= $valor['Prd_Categoria'];?></td>
                  <td><?= $valor['Prd_Modelo'];?></td>
                  <td class="gris"><?= $valor['Prd_Marca'];?></td>
                  <td><?= $valor['Encargado'];?></td>
                  <td class="gris"> <a href="../conn/Modificar/Productos_Modificar.php?Prd_ID=<?=$valor['Prd_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                      <td> <a href="../conn/Eliminar/Delete_Productos.php?Prd_ID=<?=$valor['Prd_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                </tr>
               <?php endforeach ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center negro" colspan="11" class="tfoot">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
        <?php
        break;
      case ($filtro->rowCount() >= 1):
        ?>


 </center>
          <div class="agr">
            <p>Filtrando datos con el Serial: <em> <?php echo $Serial; ?></em> </p>
          </div>
          <center>

            
<table cellspacing="0" class="productos">
            <thead>
                <tr>
                    <th class="text-center negro">Serial</th>
                    <th class="text-center negro">Nombre Producto</th>
                    <th class="text-center negro">Precio</th>
                    <th class="text-center negro">Descripción</th>
                    <th class="text-center negro">Categoria</th>
                    <th class="text-center negro">Modelo</th>
                    <th class="text-center negro">Marca</th>
                    <th class="text-center negro">Encargado</th>
                    <th class="text-center buton negro">Modificar</th>
                    <th class="text-center buton negro">Eliminar</th>
                </tr>
            </thead>
            <tbody>
               <tr>
                   <?php foreach ($miConsulta as $valor):?>
                <tr>   
                  <td class="gris"><?= $valor['Prd_Serial'];?></td>
                  <td><?= $valor['Prd_Nombre'];?></td>
                  <td class="gris"><?= $valor['Prd_Precio'];?></td>
                  <td ><?= $valor['Prd_Descripcion'];?></td>
                  <td class="gris"><?= $valor['Prd_Categoria'];?></td>
                  <td><?= $valor['Prd_Modelo'];?></td>
                  <td class="gris"><?= $valor['Prd_Marca'];?></td>
                  <td><?= $valor['Encargado'];?></td>
                  <td class="gris"> <a href="../conn/Modificar/Productos_Modificar.php?Prd_ID=<?=$valor['Prd_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                      <td> <a href="../conn/Eliminar/Delete_Productos.php?Prd_ID=<?=$valor['Prd_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                </tr>
               <?php endforeach ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center negro" colspan="11" class="tfoot">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>






        <?php

        break;
    }
  } else {

        ?>

        <center>

          
<table cellspacing="0" class="productos">
            <thead>
                <tr>
                    <th class="text-center negro">Nombre Producto</th>
                    <th class="text-center negro">Precio</th>
                    <th class="text-center negro">Descripción</th>
                    <th class="text-center negro">Serial</th>
                    <th class="text-center negro">Categoria</th>
                    <th class="text-center negro">Modelo</th>
                    <th class="text-center negro">Marca</th>
                    <th class="text-center negro">Encargado</th>
                    <th class="text-center buton negro">Modificar</th>
                    <th class="text-center buton negro">Eliminar</th>
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
                  <td class="gris"><?= $valor['Prd_Nombre'];?></td>
                  <td><?= $valor['Prd_Precio'];?></td>
                  <td class="gris"><?= $valor['Prd_Descripcion'];?></td>
                  <td><?= $valor['Prd_Serial'];?></td>
                  <td class="gris"><?= $valor['Prd_Categoria'];?></td>
                  <td><?= $valor['Prd_Modelo'];?></td>
                  <td class="gris"><?= $valor['Prd_Marca'];?></td>
                  <td><?= $valor['Encargado'];?></td>
                  <td class="gris"> <a href="../conn/Modificar/Productos_Modificar.php?Prd_ID=<?=$valor['Prd_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                      <td> <a href="../conn/Eliminar/Delete_Productos.php?Prd_ID=<?=$valor['Prd_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                 </tr>
               <?php endforeach ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center negro" colspan="11" class="tfoot">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
          
        <?php
      }
        ?>
    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Administrador</h1>
             </div>
             <div class="selecciones">
          <div class="recuadros">
                 
                <div class="selected">
                  <img src="../img/caja.png" width="85px">
                </div>
                <h4 class="titulo">Productos</h4>
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