<?php
//RECOJE LAS VARIABLES
$Prd_ID=isset($_REQUEST['Prd_ID'])? $_REQUEST['Prd_ID']:null;
$Prd_Nombre=isset($_REQUEST['Prd_Nombre'])? $_REQUEST['Prd_Nombre']:null;
$Prd_Precio=isset($_REQUEST['Prd_Precio'])? $_REQUEST['Prd_Precio']:null;
$Prd_Descripcion=isset($_REQUEST['Prd_Descripcion'])? $_REQUEST['Prd_Descripcion']:null;
$Prd_Serial=isset($_REQUEST['Prd_Serial'])? $_REQUEST['Prd_Serial']:null;
$Prd_Categoria=isset($_REQUEST['Prd_Categoria'])? $_REQUEST['Prd_Categoria']:null;
$Prd_Modelo=isset($_REQUEST['Prd_Modelo'])? $_REQUEST['Prd_Modelo']:null;
$Prd_Marca=isset($_REQUEST['Prd_Marca'])? $_REQUEST['Prd_Marca']:null;


// Conexion con la BD
require_once('../conexion.php');
$miPDO = new PDO($hostPDO,$usuarioDB,$contraseyaDB);
// $hostPDO="mysql:host=$hostDB;dbname=$NombreDB;";
if($_SERVER['REQUEST_METHOD']=='POST'){
    //CNS Update o Actualizar
    $miUpdate = $miPDO->prepare("UPDATE productos SET Stock_ID='$Prd_Nombre',Prd_Precio='$Prd_Precio',Prd_Descripcion='$Prd_Descripcion',Prd_Serial='$Prd_Serial',Prd_Categoria='$Prd_Categoria',Prd_Modelo='$Prd_Modelo',Prd_Marca='$Prd_Marca' WHERE Prd_ID='$Prd_ID';");
    //ejecutar update 
    $miUpdate->execute();
    //redireccionar a leer
    header('Location: ../../Administrador/2_Productos_Administrador.php');

}else{
    //preparar select
    $miCNS=$miPDO->prepare("SELECT stock.Prd_Nombre, Prd_Precio, Prd_Descripcion, Prd_Serial, Prd_Categoria, Prd_Modelo, Prd_Marca, productos.Prd_ID, productos.Encargado FROM stock INNER JOIN productos ON stock.Prd_ID=productos.Stock_ID where productos.Prd_ID='$Prd_ID';");
    //ejecutar CNS
    $miCNS->execute();
    
}

//obtener resultado 
$productos=$miCNS->fetch();
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
<link rel="icon" href="../../img/productos.png">
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
      <label for="">Nombre del producto</label>
            <select id="" name="Prd_Nombre"  class="form-control">
            <?php
            //conexion a la DB
                require_once ('../conexion.php');
                $miPDO =new PDO ($hostPDO,$usuarioDB, $contraseyaDB);
                $CNS= $miPDO->prepare('SELECT * FROM stock;');
                $CNS->execute();
                while ($row=$CNS->fetch(PDO::FETCH_ASSOC))
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
        <input type="text" name="Prd_Precio" id="" class="form-control" value="<?=$productos['Prd_Precio']?>">
        <br>
        <label for="">Descripcion</label><br>
        <input type="text" name="Prd_Descripcion" id="" class="form-control" value="<?=$productos['Prd_Descripcion']?>">
        <br>
        <label for="">Serial</label><br>
        <input type="text" name="Prd_Serial" id="" class="form-control" value="<?=$productos['Prd_Serial']?>">
         <br>
         <label for="">Categoria del producto</label><br>
        <select name="Prd_Categoria" id="" class="form-control">
          <option value="Electodomesticos Grandes">Electodomesticos Grandes</option>
          <option value="Electodomesticos Medianos">Electodomesticos Medianos</option>
          <option value="Electrodomesticos Pequeños">Electrodomesticos Pequeños</option>
        </select>
        <br>
         <label for="">Modelo</label><br>
        <input type="text" name="Prd_Modelo" id="" class="form-control" value="<?=$productos['Prd_Modelo']?>">
         <br>
         <label for="">Marca</label><br>
        <input type="text" name="Prd_Marca" id="" class="form-control" value="<?=$productos['Prd_Marca']?>">
         <br>
         <label for="">Marca</label><br>
        <input type="text" name="Prd_Marca" id="" class="form-control" value="<?=$productos['Encargado']?>" disabled> 
        <br>
        <input type="submit" value="Modificar" class="btn btn-warning">  <a href="../../Administrador/2_Productos_Administrador.php"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button></a>
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