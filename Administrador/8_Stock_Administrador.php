<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
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
    //EJECUTAR 


//Redireccionar a leer

header ('Location: 8_Stock_Administrador.php'); 
}

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
.recuadros{
  margin-left:0px;
}
.selected{
  background-color: #006DB2;;
}
.negro{
  background-color: #006DB2;;
  color: white;
}
  </style>
<body>
  
<button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#staticBackdrop2">
  Crear Producto
</button>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar producto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
        <form method="POST">
        <label for="">Nombre del producto</label><br>
        <input type="text" name="Prd_Nombre" id="Prd_Nombre" class="form-control">
        <br><br>
        <label for="">Stock Minimo</label><br>
        <input type="number" name="Prd_Stock_Min" id="Prd_Stock_Min" min="2" class="form-control">
        <br><br>
        <label for="">Stock</label><br>
        <input type="number" name="Prd_Stock" id="Prd_Stock" min="1" class="form-control">
         <br><br>
        <label for="">Stock Maximo</label><br>
        <input type="number" name="Prd_Stock_Max" id="Prd_Stock_Max" min="3" class="form-control">
         
     </select>
       
        </center>
      </div>
      <div class="modal-footer">
      <input type="submit" value="Agregar" name="Stock"class="btn btn-success">
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
                    <th class="negro text-center">Nombre</th>
                    <th class="negro text-center descrip">Cantidad minima</th>
                    <th class="negro text-center">Cantidad actual</th>
                    <th class="negro text-center">Cantidad maxima</th>
                    <th class="negro text-center">Modificar</th>
                    <th class="negro text-center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
               <tr>
               <?php if($ConProductos->rowCount()==0){
                      ?><tr><td colspan="7" rowspan="2" class="borde1"><img src="../img/pagina_vacia.png" width="600px" class="jake" ><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
                    </tr><?php
                    } ?>
                   <?php foreach ($ConProductos as $valor):?>
                <tr>  
                  <td><?= $valor['Prd_Nombre'];?></td>
                  <td><?= $valor['Prd_Stock_Min'];?></td>
                  <td><?= $valor['Prd_Stock'];?></td>
                  <td><?= $valor['Prd_Stock_Max'];?></td>
                  <td class="gris"> <a href="../conn/Modificar/Stock_Modificar.php?Prd_ID=<?=$valor['Prd_ID'];?>"><button type="button" class="btn btn-warning"><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                      <td class="gris"> <a href="../conn/Eliminar/Delete_Stock.php?Prd_ID=<?=$valor['Prd_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                </tr>
               <?php endforeach ?>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="negro text-center" colspan="7" class="tfoot">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Administrador</h1>
             </div>
              <center>
          <div class="recuadros">   
                <div class="selected">
                  <img src="../img/stock.png" width="85px">
                </div>
                <h4 class="titulo">Stock</h4>
          </div>
          <br><br>
<a href="2_Productos_Administrador.php"><button type="button" class="btn btn-danger"><img src="../img/regresar.png" width="25px"  margin-top="5px"  margin-bottom="5px"> Regresar</button></a>

          </center>
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