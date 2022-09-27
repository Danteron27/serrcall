<?php 
session_start();
if(!isset($_SESSION['usuarios_login'])){
  header("Location:../index.php");
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
.productos{
  margin-top:30px;
}
  </style>
<body>
<form action="../Administrador/reportes_productos.php"> 
<button type="submit" class="btn btn-dark agr">
  Imprimir reporte <img src="../img/agregar.png" width="25px"  margin-top="0px"  margin-bottom="5px">
</button>
</form>
  
<center>
<table cellspacing="0" class="productos">
            <thead>
                <tr>
                    <th class="text-center">Nombre Producto</th>
                    <th class="text-center">Precio</th>
                    <th class="text-center descrip">Descripción</th>
                    <th class="text-center">Serial</th>
                    <th class="text-center">Proveedor</th>
                </tr>
            </thead>
            <tbody>
                
                <tr>
                    <td class="gris">Plancha</td>
                    <td class="gris">45.000$</td>
                    <td class="gris">Samurai blanca a vapora asd asd asd asd</td>
                    <td class="gris">GCSTBS4801</td>
                    <td class="gris">Corbeta</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center" colspan="7" class="tfoot">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Empleado</h1>
             </div>
             <div class="selecciones">
          <div class="recuadros">
                 
                <div class="selected">
                  <img src="../img/caja.png" width="85px">
                </div>
                <h4 class="titulo">Productos</h4>
          </div>
        

          <div class="recuadros">
            <a href="3_Proveedores_Empleado.php">     
              <div class="imagenes">
                <img src="../img/repartidor.png" width="85px">
              </div>
              <h4 class="titulo">Proveedores</h4>
            </a>
          </div>
        
  </div>
  <div class="selecciones">
          <div class="recuadros">
            <a href="4_Novedades_Empleado.php">     
              <div class="imagenes">
                <img src="../img/bombilla.png" width="85px">
              </div>
              <h4 class="titulo">Novedades</h4>
            </a>
        </div>
        <div class="recuadros">
            <a href="6_Kardex_Empleado.php">     
              <div class="imagenes">
                <img src="../img/inventario.png" width="85px">
              </div>
              <h4 class="titulo">Kardex</h4>
            </a>
        </div>
      </div>
 
      <div class="selecciones">
          
       
        <div class="recuadros">
            <a href="7_Clientes_Empleado.php">     
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
      <form action="home_empleado.php">
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