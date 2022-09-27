<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="../img/usuarios.png">
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
    margin-left: 29.1%;
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
.negro{
  background-color: #006DB2;;
  color: white;
}
  </style>
<body>
  
 <!-- Button trigger modal -->
 <button type="button" class="btn btn-dark agr" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
  Agregar usuario <img src="../img/agregar.png" width="25px"  margin-top="5px"  margin-bottom="5px">
</button>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <center>
        <form action="" method="POST">
        <label for="">Usuario</label><br>
        <input type="text" name="login" id="" class="form-control">
        <br><br>
        <label for="">Contraseña</label><br>
        <input type="text" name="pass" id="" class="form-control">
        <br><br>
        <label for="">Rol</label><br>
        <select name="rol" id="" class="form-control">
            <option value="">-Seleccionar rol-</option>
            <option value="admin">Administrador</option>
            <option value="usuarios">Asesor de ventas</option>
        </select>
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
                    <th class="negro text-center">Usuario</th>
                    <th class="negro descrip text-center">Contraseña</th>
                    <th class="negro text-center">Rol</th>
                    <th class="negro text-center">Modificar</th>
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
                <?php if($admin->rowCount()==1){?> <td>Opcion desactivada</td> <?php }else{?> <td> <a href="../conn/Modificar/Usuario_Modificar.php?Usu_ID=<?=$valor['Usu_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td><?php } ?> 
                <?php if($admin->rowCount()==1){?> <td class="gris">Opcion desactivada</td> <?php }else{?> <td class="gris"><a href="../conn/Eliminar/Delete_Usuario.php?Usu_ID=<?=$valor['Usu_ID'];?>"><button type="button" class="btn btn-danger" ><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td><?php } ?>  
                </tr>
                <?php endforeach ?>
                <?php foreach ($usuario as $valor):?>
        <tr>
                <td class="gris"><?= $valor['Usu_Login'];?></td>
                <td><?= $valor['Usu_Password'];?></td>
                <td class="gris"><?= $valor['Usu_Rol'];?></td>
                <td> <a href="../conn/Modificar/Usuario_Modificar.php?Usu_ID=<?=$valor['Usu_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                <td class="gris"><a href="../conn/Eliminar/Delete_Usuario.php?Usu_ID=<?=$valor['Usu_ID'];?>"><button type="button" class="btn btn-danger" ><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="7" class="negro text-center">Serrcall</th>
                    
                </tr>
            </tfoot>
    </table>
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
            
              <div class="selected">
                <img src="../img/usuario.png" width="85px">
              </div>
              <h4 class="titulo">Usuario</h4>
            
      
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