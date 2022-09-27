<?php 
session_start();
if(!isset($_SESSION['usuarios_login'])){
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta=$miPDO->PREPARE('SELECT * FROM clientes;');
$miConsulta->execute();
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
.error{
  font-size: 100px
}
.productos{
  margin-top:30px;
  margin-left:150px;
}
.margen{
  height:100px;
}
.negro{
  background-color: #006DB2;;
  color: white;
}
  </style>
<body>
<form action="../Administrador/reportes_clientes.php"> 
<button type="submit" class="btn btn-dark agr">
  Imprimir reporte <img src="../img/agregar.png" width="25px"  margin-top="0px"  margin-bottom="5px">
</button>
</form>
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
                   
                </tr>
            </thead>
            <tbody>
            <tr>
            <?php if($miConsulta->rowCount()==0){
                      ?><tr><td colspan="8" rowspan="2" class="borde1"><img src="../img/pagina_vacia.png" width="600px" class="jake" ><h1 class="error">¡ERROR 404!</h1><h2>No se han encontrado registros <br> :(</h2></td>
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
                </tr>
              <?php endforeach ?>  
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="10" class="negro text-center">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Empleado</h1>
             </div>
             <div class="selecciones">
          <div class="recuadros">
                 <a href="2_Productos_Empleado.php">
                <div class="imagenes">
                  <img src="../img/caja.png" width="85px">
                </div>
                <h4 class="titulo">Productos</h4>
              </a>
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