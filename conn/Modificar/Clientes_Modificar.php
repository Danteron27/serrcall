<?php
    //RECOGER LAS VARIABLES
    $Cli_ID=isset($_REQUEST['Cli_ID'])? $_REQUEST['Cli_ID']:null;
    $Cli_Cedula=isset($_REQUEST['Cli_Cedula'])? $_REQUEST['Cli_Cedula']:null;
    $Cli_Nombre=isset($_REQUEST['Cli_Nombre'])? $_REQUEST['Cli_Nombre']:null;
    $Cli_Direccion=isset($_REQUEST['Cli_Direccion'])? $_REQUEST['Cli_Direccion']:null;
    $Cli_Ciudad=isset($_REQUEST['Cli_Ciudad'])? $_REQUEST['Cli_Ciudad']:null;
    $Cli_Email=isset($_REQUEST['Cli_Email'])? $_REQUEST['Cli_Email']:null;
    $Cli_Celular=isset($_REQUEST['Cli_Celular'])? $_REQUEST['Cli_Celular']:null;
    // Conexion con la BD
require_once('../conexion.php');
$miPDO = new PDO($hostPDO,$usuarioDB,$contraseyaDB);

// $hostPDO="mysql:host=$hostDB;dbname=$NombreDB;";
if($_SERVER['REQUEST_METHOD']=='POST'){
 //Consulta Update o Actualizar
 $miUpdate = $miPDO->prepare("UPDATE clientes SET Cli_Cedula='$Cli_Cedula',Cli_Nombre='$Cli_Nombre',Cli_Direccion='$Cli_Direccion',Cli_Ciudad='$Cli_Ciudad',Cli_Email='$Cli_Email',Cli_Celular='$Cli_Celular' WHERE Cli_ID='$Cli_ID';");
 //ejecutar update 
 $miUpdate->execute();
 //redireccionar a leer
 header('Location: ../../Administrador/7_Clientes_Administrador.php');

}else{
 //preparar select
 $miConsulta=$miPDO->prepare("SELECT * FROM clientes WHERE Cli_ID='$Cli_ID';");
 //ejecutar consulta
 $miConsulta->execute();
 
}

//obtener resultado 
$clientes=$miConsulta->fetch();
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
<link rel="icon" href="../../img/cliente.png">
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
        <label for=""># Cliente</label><br>
        <input type="text" name="Cli_Cedula" id="Cli_Cedula" class="form-control" value="<?=$clientes['Cli_ID']?>" disabled>
        <br><br>
        <label for="">Numero de identificación</label><br>
        <input type="text" name="Cli_Cedula" id="Cli_Cedula" class="form-control" value="<?=$clientes['Cli_Cedula']?>">
        <br><br>
        <label for="">Nombre cliente</label><br>
        <input type="text" name="Cli_Nombre" id="Cli_Nombre" class="form-control" value="<?=$clientes['Cli_Nombre']?>">
        <br><br>
        <label for="">Direccion</label><br>
        <input type="text" name="Cli_Direccion" id="Cli_Direccion" class="form-control" value="<?=$clientes['Cli_Direccion']?>">
        <br><br>
        <label for="">Ciudad</label><br>
        <input type="text" name="Cli_Ciudad" id="Cli_Ciudad" class="form-control" value="<?=$clientes['Cli_Ciudad']?>">
         <br><br>
         <label for="">Email</label><br>
        <input type="text" name="Cli_Email" id="Cli_Email" class="form-control" value="<?=$clientes['Cli_Email']?>">
         <br><br>
         <label for="">Celular</label><br>
        <input type="text" name="Cli_Celular" id="Cli_Celular" class="form-control" value="<?=$clientes['Cli_Celular']?>">
         <br><br>
         <input type="submit" value="Modificar" class="btn btn-warning">  <a href="../../Administrador/7_Clientes_Administrador.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></a>
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
           
              <div class="selected">
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