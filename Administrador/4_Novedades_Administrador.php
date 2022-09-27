<?php
session_start();
if (!isset($_SESSION['admin_login'])) {
  header("Location:../index.php");
}
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO = new PDO($hostPDO, $usuarioDB, $contraseyaDB);
$hostPDO = "mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta = $miPDO->PREPARE('SELECT * FROM novedades;');
$miConsulta->execute();
$consul = isset($_REQUEST['consul']) ? $_REQUEST['consul'] : null;
if ($consul == Null) {
  $consul = "N/A";
}

$conss = $miPDO->PREPARE("SELECT * FROM clientes where Cli_Cedula='$consul';");
$conss->execute();
$cliente = $conss->fetch();

$fecha_inicio = isset($_REQUEST['fecha_inicio']) ? $_REQUEST['fecha_inicio'] : null;
$fecha_fin = isset($_REQUEST['fecha_fin']) ? $_REQUEST['fecha_fin'] : null;


$filtro = $miPDO->PREPARE("SELECT * FROM novedades WHERE Nov_Fecha BETWEEN '$fecha_inicio' and '$fecha_fin';");
$filtro->execute();
if (isset($_POST['Agregar'])) {
  //RECOGER LAS VARIABLES

  $Prd_ID = isset($_REQUEST['Prd_ID']) ? $_REQUEST['Prd_ID'] : null;
  $Cli_ID = isset($_REQUEST['Cli_ID']) ? $_REQUEST['Cli_ID'] : null;
  $Nov_Descripcion = isset($_REQUEST['Nov_Descripcion']) ? $_REQUEST['Nov_Descripcion'] : null;
  $Nov_Tipo = isset($_REQUEST['Nov_Tipo']) ? $_REQUEST['Nov_Tipo'] : null;
  $Nov_Fecha = isset($_REQUEST['Nov_Fecha']) ? $_REQUEST['Nov_Fecha'] : null;
  $miInsert = $miPDO->prepare("INSERT INTO novedades (Nov_Descripcion, Nov_Tipo, Nov_Fecha, Prd_ID, Cli_ID) VALUES ('$Nov_Descripcion','$Nov_Tipo','$Nov_Fecha', '$Prd_ID', '$Cli_ID')");
  //EJECUTAR 
  $miInsert->execute();


  //Redireccionar a leer

  header('Location: 4_Novedades_Administrador.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=|, initial-scale=1.0">
  <title>Novedades</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet">
  <link rel="icon" href="../img/notes.png">
  <link href="../css/Administrador/Estilo_Administrador.css" rel="stylesheet" type="text/css" media="screen" />
  <link href="https://trial.chatcompose.com/static/trial/all/global/export/css/main.5b1bd1fd.css" rel="stylesheet">    <script async type="text/javascript" src="https://trial.chatcompose.com/static/trial/all/global/export/js/main.a7059cb5.js?user=trial_Jhonatan1&lang=ES" user="trial_Jhonatan1" lang="ES"></script>  
</head>
<style>
  * {
    font-family: 'Quicksand', sans-serif;
  }

  h4 {
    font-size: 20px;
    margin-top: 17px;
  }

  a {
    text-decoration: none;
  }

  p {
    margin-top: 10px;
  }

  .agr {
    margin-left: 465px;
    margin-top:30px;
    margin-bottom:30px;
  }

  .text-center {
    background-color: rgb(255, 255, 255);
    border: 1px solid rgb(0, 0, 0, 0.3);
    height: 40px;
    width: 150px;
  }

  .descrip {
    border: 1px solid rgb(0, 0, 0, 0.3);
    width: 200px;
  }

  .productos {
    margin-left: 200px;
  }

  .negro {
    background-color: #006DB2;
    ;
    color: white;
  }

  

  .flex-container {
    display: flex;
    flex-direction: row;
    width: 100%;
  }

  .flex-container>.espacio {
    width: 200px;
    text-align: center;
  }

  .fechas {
    width: 170px;
    height: 28px;
    background-color: #212529;
    color: white;
    text-align: center;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    margin-top:-30px;
  }

  .formu {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    width: 170px;
  }
  .separador{
border-top: 1px solid #cccbc2;
    height:1px;
    width: 106.8%;
    margin-top: 20px;
    margin-left:-16px;
  }
  .salto{
    margin-top:20px;
  }
  .margen{
    margin-left: 38px;
  }
  .btn2{
    margin-left:69%;
    margin-top:-70px;
  }
  .df{
    display: none;
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
      <p>Consultar para agregar</p>
                    <div class="flex-container">
                    <div class="espacio">
                      <form action="" method="POST">
                      <button type="submit" class="btn btn-dark" name="Consulta">Consulta <img src="../img/lupa.png" width="20px"></button>
                      </div>
                      <div class="espacio">
                      <input type="text" name="consul" id="consul" class="form-control" placeholder="Documento*">
                      </form>
                    </div>
                    </div>
                   <div class="separador"></div>
                    <div class="salto">
                    <p>Filtrar</p>
                    </div>                                                              
                                                                                                  <form action="" method="POST">
                                                                                                  <button type="submit" class="btn btn-dark margen btn2" name="Filtrar">Filtrar <img src="../img/filtrar.png" width="20px"></button>
                                                                                               <br><br>
                                                                                                  <div class="flex-container">
                                                                                                  <div class="espacio margen">
                                                                                                  <div class="fechas"> Fecha inicio</div>
                                                                                                  <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control formu">
                                                                                                </div>
                                                                                                &nbsp;
                                                                                                &nbsp;
                                                                                                <div class="espacio">
                                                                                                  <div class="fechas"> Fecha fin </div>
                                                                                                  <input type="date" name="fecha_fin" id="fecha_fin" class="form-control formu">
                                                                                                </div>    
                                                                                                </div>  
                                                                                                 </form>
                                                                                                 <div class="separador"></div>
                                                                                                <p>Imprimir</p>
                                                                                                <form action="reporte_novedades.php">
                                                                                                  <button type="submit" class="btn btn-dark margen" name="imprimir" style="width:'25px'">
                                                                                                    Imprimir reporte <img src="../img/agregar.png" width="20px">
                                                                                                  </button>
                                                                                                </form> 
                                                                                                <br>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
</div>








  <!-- Button trigger modal -->
  <button type="button" class="btn btn-dark df" data-bs-toggle="modal" data-bs-target="#modalregistro" id="send"></button>
  <!-- Modal -->
  <div class="modal fade" id="modalregistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalregistroLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalregistroLabel">Agregar novedad con el nÃºmero: <em><?php echo $consul; ?></em></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <center>
            <form method="POST">
              <label for="">Cliente</label>
              <input type="text" name="Cli_ID" id="Cli_ID" class="form-control" value="<?= $cliente['Cli_ID'] ?>"><?= $cliente['Cli_Nombre'] ?>
              </select>
              <br><br>
              <label for="">Producto</label>
              <select id="Prd_ID" type="selected" name="Prd_ID" class="form-control">
                <option value="" selected="selected">--Seleccione el producto--</option>
                <?php
                //conexion a la DB
                require_once('../conn/conexion.php');
                $miPDO = new PDO($hostPDO, $usuarioDB, $contraseyaDB);
                $Consulta = $miPDO->prepare('SELECT * FROM stock;');
                $Consulta->execute();
                while ($row = $Consulta->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);

                ?>
                  <option value="<?php echo $Prd_ID; ?>"><?php echo $Prd_Nombre; ?></option>
                <?php
                }
                ?>
              </select>
              <br><br>
              <label for="">Tipo de novedad</label><br>
              <select name="Nov_Tipo" id="" class="form-control">
                <option value="">--Seleccionar tipo de novedad--</option>
                <option value="Garantia">Garantia</option>
                <option value="DevoluciÃ³n">DevoluciÃ³n</option>
              </select>
              <br><br>
              <label for="">DescripciÃ³n de novedad</label><br>
              <input type="text" name="Nov_Descripcion" id="" class="form-control">
              <br><br>
              <label for="">Fecha de novedad</label><br>
              <input type="date" name="Nov_Fecha" id="" class="form-control">
              <br><br>
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
  </div>
  </div>


  
  <?php
  if (isset($_POST['Consulta'])) {
    if ($conss->rowCount() == 0) {
  ?>
      <div class="agr">
        <p>No hay clientes existentes con el documento: <em><?php echo $consul; ?></em> </p>
      </div>
    <?php
    } else {
    ?> <script>
        document.getElementById('send').click();
      </script>
  <?php
    }
  }
  ?>

  <?php
  if (isset($_POST['Filtrar'])) {
    switch ($filtro->rowCount()) {
      case 0:
  ?>
        <div class="agr">
          <p>No se encuentran registros entre las fechas: <em><?php echo $fecha_inicio; ?> y <?php echo $fecha_fin; ?></em> </p>
        </div>
        <center>

          <table cellspacing="0" class="productos">
            <thead>
              <tr>
                <th class="negro text-center">Producto</th>
                <th class="negro text-center">Cliente</th>
                <th class="negro descrip text-center">Tipo de novedad</th>
                <th class="negro descrip text-center">DescripciÃ³n novedad</th>
                <th class="negro text-center">Fecha de novedad</th>
                <th class="negro text-center">Modificar</th>
                <th class="negro text-center">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php if ($miConsulta->rowCount() == 0) {
                ?>
              <tr>
                <td colspan="8" rowdiv="3" class="borde1 gris"><img src="../img/portapapeles.png" width="300px" class="jake" margin->
                  <h1 class="error">Â¡ERROR 404!</h1>
                  <h2>No se han encontrado registros <br> :(</h2>
                </td>
              </tr><?php
                  } ?>
            <?php foreach ($miConsulta as $valor) : ?>
              <tr>
                <td class="gris"><?= $valor['Prd_ID']; ?></td>
                <td><?= $valor['Cli_ID']; ?></td>
                <td class="gris"><?= $valor['Nov_Tipo']; ?></td>
                <td><?= $valor['Nov_Descripcion']; ?></td>
                <td class="gris"><?= $valor['Nov_Fecha']; ?></td>
                <td> <a href="../conn/Modificar/Novedades_Modificar.php?Nov_ID=<?= $valor['Nov_ID']; ?>"><button type="button" class="btn btn-warning"><img src="../img/editar.png" width="25px" margin-top="5px" margin-bottom="5px"></button></a></td>
                <td class="gris"> <a href="../conn/Eliminar/Delete_Novedades.php?Nov_ID=<?= $valor['Nov_ID']; ?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px" margin-top="5px" margin-bottom="5px"></button> </td>
              </tr>
            <?php endforeach ?>

            </tbody>
            <tfoot>
              <tr>
                <th colspan="9" class="negro text-center">Serrcall</th>

              </tr>
            </tfoot>
          </table>
        <?php
        break;
      case ($filtro->rowCount() >= 1):
        ?>



          <div class="agr">
            <p>Filtrando datos entre las fechas: <em><?php echo $fecha_inicio; ?> y <?php echo $fecha_fin; ?></em> </p>
          </div>
          <center>

            <table cellspacing="0" class="productos">
              <thead>
                <tr>
                  <th class="negro text-center">Producto</th>
                  <th class="negro text-center">Cliente</th>
                  <th class="negro descrip text-center">Tipo de novedad</th>
                  <th class="negro descrip text-center">DescripciÃ³n novedad</th>
                  <th class="negro text-center">Fecha de novedad</th>
                  <th class="negro text-center">Modificar</th>
                  <th class="negro text-center">Eliminar</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($filtro as $valor) : ?>
                  <tr>
                    <td class="gris"><?= $valor['Prd_ID']; ?></td>
                    <td><?= $valor['Cli_ID']; ?></td>
                    <td class="gris"><?= $valor['Nov_Tipo']; ?></td>
                    <td><?= $valor['Nov_Descripcion']; ?></td>
                    <td class="gris"><?= $valor['Nov_Fecha']; ?></td>
                    <td> <a href="../conn/Modificar/Novedades_Modificar.php?Nov_ID=<?= $valor['Nov_ID']; ?>"><button type="button" class="btn btn-warning"><img src="../img/editar.png" width="25px" margin-top="5px" margin-bottom="5px"></button></a></td>
                    <td class="gris"> <a href="../conn/Eliminar/Delete_Novedades.php?Nov_ID=<?= $valor['Nov_ID']; ?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px" margin-top="5px" margin-bottom="5px"></button> </td>
                  </tr>
                <?php endforeach ?>

              </tbody>
              <tfoot>
                <tr>
                  <th colspan="9" class="negro text-center">Serrcall</th>

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
                <th class="negro text-center">Producto</th>
                <th class="negro text-center">Cliente</th>
                <th class="negro descrip text-center">Tipo de novedad</th>
                <th class="negro descrip text-center">DescripciÃ³n novedad</th>
                <th class="negro text-center">Fecha de novedad</th>
                <th class="negro text-center">Modificar</th>
                <th class="negro text-center">Eliminar</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <?php if ($miConsulta->rowCount() == 0) {
                ?>
              <tr>
                <td colspan="8" rowdiv="3" class="borde1 gris"><img src="../img/portapapeles.png" width="300px" class="jake" margin->
                  <h1 class="error">Â¡ERROR 404!</h1>
                  <h2>No se han encontrado registros <br> :(</h2>
                </td>
              </tr><?php
                  } ?>
            <?php foreach ($miConsulta as $valor) : ?>
              <tr>
                <td class="gris"><?= $valor['Prd_ID']; ?></td>
                <td><?= $valor['Cli_ID']; ?></td>
                <td class="gris"><?= $valor['Nov_Tipo']; ?></td>
                <td><?= $valor['Nov_Descripcion']; ?></td>
                <td class="gris"><?= $valor['Nov_Fecha']; ?></td>
                <td> <a href="../conn/Modificar/Novedades_Modificar.php?Nov_ID=<?= $valor['Nov_ID']; ?>"><button type="button" class="btn btn-warning"><img src="../img/editar.png" width="25px" margin-top="5px" margin-bottom="5px"></button></a></td>
                <td class="gris"> <a href="../conn/Eliminar/Delete_Novedades.php?Nov_ID=<?= $valor['Nov_ID']; ?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px" margin-top="5px" margin-bottom="5px"></button> </td>
              </tr>
            <?php endforeach ?>

            </tbody>
            <tfoot>
              <tr>
                <th colspan="9" class="negro text-center">Serrcall</th>

              </tr>
            </tfoot>
          </table>
          
        <?php
      }
        ?>

</html>
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

      <div class="selected">
        <img src="../img/bombilla.png" width="85px">
      </div>
      <h4 class="titulo">Novedades</h4>


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
    .hogar {
      width: 100px;
      height: 45px;
      border-radius: 20px;
      border: 2px solid black;
      transition: 0.3s;
      background-color: rgb(143, 143, 143);
      margin-top: 50%;
    }

    .hogar:hover {
      background-color: rgb(201, 198, 198);
    }
  </style>
  <form action="home_admin.php">
    <button type="submit" class="hogar"><img src="../img/hogar.png" width="30px"></button>
  </form>

</div>



</body>
<footer>
  <div class="footer">
    <div class="contenido">
      <p>SERRCALL</p>
      <P>Telefono: (1) 2984829</P>
      <p>Dirección: Cl. 22g #100-04, Bogotá¡</p>
      <p><img src="../img/snail_footer.png" width="23px"></p>
    </div>
  </div>
</footer>

</html>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>