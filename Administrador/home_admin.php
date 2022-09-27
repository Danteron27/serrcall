<?php
session_start();
if(!isset($_SESSION['admin_login'])){
  header("Location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=|, initial-scale=1.0">
    <title>Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
<link rel="icon" href="../img/caracol.png">
    <link href="../css/Administrador/1_Principal_Administrador.css" rel="stylesheet" type="text/css" media="screen" />
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
  </style>

<body>
<center>   
        <div class="centro_contenido">
            <img src="../img/fondo_principal.png" width="200px">
            <h2 class="centro_texto">¡Bienvenido!</h2>
            <h2 class="centro_texto">Gestor de datos Serrcall</h2>
        </div>
    </center>
<div class="boton_cerrar">
        <form action="../cerrar_sesion.php">
        <button type="submit" class="cerrar_sesion btn btn-dark"><img src="../img/cerrar_sesion.png" width="30px"><p>Cerrar sesion</p></button>
    </div>
    </form>
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