<?php
//RECOJE LAS VARIABLES
    $Pro_ID=isset ($_REQUEST['Pro_ID']) ? $_REQUEST['Pro_ID']:null ;
    $Pro_Nombre=isset ($_REQUEST['Pro_Nombre']) ? $_REQUEST['Pro_Nombre']:null ;
    $Pro_Nit=isset ($_REQUEST['Pro_Nit']) ? $_REQUEST['Pro_Nit']:null ;
    $Pro_Email=isset ($_REQUEST['Pro_Email']) ? $_REQUEST['Pro_Email']:null ;
    $Pro_Celular=isset ($_REQUEST['Pro_Celular']) ? $_REQUEST['Pro_Celular']:null ;
    $Pro_Direccion=isset ($_REQUEST['Pro_Direccion']) ? $_REQUEST['Pro_Direccion']:null ;
// Conexion con la BD
require_once('../conexion.php');
$miPDO = new PDO($hostPDO,$usuarioDB,$contraseyaDB);
// $hostPDO="mysql:host=$hostDB;dbname=$NombreDB;";
if($_SERVER['REQUEST_METHOD']=='POST'){
    //Consulta Update o Actualizar
    $miUpdate = $miPDO->prepare("UPDATE proveedores SET Pro_Nombre='$Pro_Nombre',Pro_Nit='$Pro_Nit',Pro_Email='$Pro_Email',Pro_Celular='$Pro_Celular',Pro_Direccion='$Pro_Direccion'    WHERE Pro_ID='$Pro_ID';");
    //ejecutar update 
    $miUpdate->execute();
    //redireccionar a leer
    header('Location: ../../Administrador/3_Proveedores_Administrador.php');

}else{
    //preparar select
    $miConsulta=$miPDO->prepare("SELECT * FROM proveedores WHERE Pro_ID='$Pro_ID';");
    //ejecutar consulta
    $miConsulta->execute();
    
}

//obtener resultado 
$proveedores=$miConsulta->fetch();
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
    width: 200px;
}
.imagenes{
    background-color: #75797d;
    border-radius: 30px;
}
.selected{
  background-color:#f7be33;
}
.modifi{
  width: 500px;
}
.title{
  margin-top:30px;
}
  </style>
<body>

<center>
    <div class="modifi">
      <h1 class="title">Modificar registro</h1>
      <form action="" method="POST">
      <label for=""># proveedor</label><br>
        <input type="text" name="Pro_ID" id="Pro_ID" class="form-control" value="<?=$proveedores['Pro_ID']?>" disabled>
        <br><br>
        <label for="">Nombre de proveedor</label><br>
        <input type="text" name="Pro_Nombre" id="Pro_Nombre" class="form-control" value="<?=$proveedores['Pro_Nombre']?>">
        <br><br>
        <label for="">Nit</label><br>
        <input type="text" name="Pro_Nit" id="Pro_Nit" class="form-control" value="<?=$proveedores['Pro_Nit']?>">
        <br><br>
        <label for="">Email</label><br>
        <input type="text" name="Pro_Email" id="Pro_Email" class="form-control" value="<?=$proveedores['Pro_Email']?>">
         <br><br>
         <label for="">Celular</label><br>
        <input type="text" name="Pro_Celular" id="Pro_Celular" class="form-control" value="<?=$proveedores['Pro_Celular']?>">
         <br><br>
         <label for="">Dirección</label><br>
        <input type="text" name="Pro_Direccion" id="Pro_Direccion" class="form-control" value="<?=$proveedores['Pro_Direccion']?>">
         <br><br>
        <input type="submit" value="Modificar" class="btn btn-warning">  <a href="../../Administrador/3_Proveedores_Administrador.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></a>
    </form>       
  </div>
</center>




    <div class="barra_lateral">
            <div class="encabezado_lateral">
                <h1 class="fs-2">Serrcall Administrador</h1>
             </div>
             <div class="selecciones">
          <div class="recuadros">
                
                <div class="imagenes">
                  <img src="../../img/caja.png" width="85px">
                </div>
                <h4 class="titulo">Productos</h4>
              
          </div>
        

          <div class="recuadros">
          
              <div class="selected">
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
        border: 2px solid black;
        transition: 0.3s;
        background-color: #f8de3c;
        margin-top: 50%;
        color: black;
    }
      </style>
      <center>
      <form action="">
        <button type="submit" class="hogar" disabled>MODIFICANDO</button>
    </form>    
    </center>
    </div>
   
        
 
</body>
<footer>
  <div class="footer">
    <div class="contenido">
    <p>SERRCALL</p>
    <P>Teléfono: (1) 2984829</P>
    <p>Dirección: Cl. 22g #100-04, Bogotá</p>
    <p><img src="../../img/snail_footer.png" width="23px"></p>
    </div>
  </div>
</footer>
</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>