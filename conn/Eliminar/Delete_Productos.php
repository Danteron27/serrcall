<?php
// variables 
require_once('../conexion.php');
$miPDO = new PDO ($hostPDO, $usuarioDB, $contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";

//obtener codigo del libro a borrar
$Prd_ID=isset ($_REQUEST['Prd_ID']) ? $_REQUEST['Prd_ID']:null ;
// PREPARAR DELETE
if (isset($_POST['eliminar'])){
$miConsulta=$miPDO->prepare("DELETE FROM productos WHERE Prd_ID='$Prd_ID';");
//ejecuta la sentencia SQL
$miConsulta->execute();
//direccion de datos
header('location: ../../Administrador/2_Productos_Administrador.php');
}
 $consull=$miPDO->prepare("SELECT stock.Prd_Nombre, Prd_Precio, Prd_Descripcion, Prd_Serial, Prd_Categoria, Prd_Modelo, Prd_Marca, productos.Prd_ID, productos.Encargado FROM stock INNER JOIN productos ON stock.Prd_ID=productos.Stock_ID where productos.Prd_ID='$Prd_ID';");
    $consull->execute();
    $productos=$consull->fetch();

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
<link rel="icon" href="../../img/senor.png">
    <link href="../../css/Administrador/Estilo_Modificar.css" rel="stylesheet" type="text/css" media="screen" />
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
    width: 400px;
}
.imagenes{
    background-color: #75797d;
    border-radius: 30px;
}
.selected{
  background-color:#f43444;
}

.title{
  margin-top:30px;
}
.negro{
  background-color: #f43444;
  color: white;
}
.larg{
    height: 60px;
}
  </style>
<body>

<center>
    <div class="modifi">
        
      <h1 class="title">??Eliminar registro?</h1>
      <form action="" method="POST">
          <br>
      <table>
    <tr>
                    <th class="descrip fs-1 negro text-center" colspan="2">Datos del registro</th>
                    </tr><tr>
                    <th class="larg text-center"># de producto</th><td><?=$productos['Prd_ID']?></td>
                    </tr><tr>
                    <th class="larg text-center">Nombre del Producto</th><td><?=$productos['Prd_Nombre']?></td>
                    </tr><tr>
                    <th class="larg text-center">Descripci??n</th><td><?=$productos['Prd_Descripcion']?></td>
                    </tr><tr>
                    <th class="larg text-center">Precio</th><td><?=$productos['Prd_Precio']?></td>
                    </tr><tr>
                    <th class="larg text-center">Serial</th><td><?=$productos['Prd_Serial']?></td>
                    </tr><tr>
                    <th class="larg text-center">Categoria</th><td><?=$productos['Prd_Categoria']?></td>
                    </tr><tr>
                    <th class="larg text-center">Modelo</th><td><?=$productos['Prd_Modelo']?></td>
                    </tr><tr>
                    <th class="larg text-center">Marca</th><td><?=$productos['Prd_Marca']?></td>
                    </tr><tr>
                    <th class="larg text-center">Encargado</th><td><?=$productos['Encargado']?></td>
                    </tr>          
                </table>
                <br>
        <input type="submit" value="Eliminar" class="btn btn-danger" name="eliminar">  <a href="../../Administrador/5_Usuario_Administrador.php"><button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancelar</button></a>
    </form>       
  </div>
</center>




    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Administrador</h1>
             </div>
             <div class="selecciones">
          <div class="recuadros">
                
                <div class="selected">
                  <img src="../../img/caja.png" width="85px">
                </div>
                <h4 class="titulo">Productos</h4>
              
          </div>
        

          <div class="recuadros">
          
              <div class="imagenes">
                <img src="../../img/repartidor.png" width="85px">
              </div>
              <h4 class="titulo">Proveedores</h4>
           
          </div>
        
  </div>
  <div class="selecciones">
          <div class="recuadros">
           
              <div class="imagenes">
                <img src="../../img/bombilla.png" width="85px">
              </div>
              <h4 class="titulo">Novedades</h4>
           
      
        </div>
       
        <div class="recuadros">
            
              <div class="imagenes">
                <img src="../../img/usuario.png" width="85px">
              </div>
              <h4 class="titulo">Usuario</h4>
            
      
        </div>
      </div>
      <div class="selecciones">
          <div class="recuadros">
               
              <div class="imagenes">
                <img src="../../img/inventario.png" width="85px">
              </div>
              <h4 class="titulo">Kardex</h4>
           
      
        </div>
       
        <div class="recuadros">
           
              <div class="imagenes">
                <img src="../../img/clientes.png" width="85px">
              </div>
              <h4 class="titulo">Clientes</h4>
          
      
        </div>
      </div>
      <style>
      .hogar{
        width: 150px;
        height: 45px;
        border-radius: 20px;
        border:0px;
        transition: 0.3s;
        background-color:#f43444;
        margin-top: 50%;
        color: white;
    }
      </style>
      <center>
      <form action="">
        <button type="submit" class="hogar" disabled>ELIMINANDO</button>
    </form>    
    </center>
    </div>
   
        
 
</body>
<footer>
  <div class="footer">
    <div class="contenido">
    <p>SERRCALL</p>
    <P>Tel??fono: (1) 2984829</P>
    <p>Direcci??n: Cl. 22g #100-04, Bogot??</p>
    <p><img src="../../img/snail_footer.png" width="23px"></p>
    </div>
  </div>
</footer>
</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>