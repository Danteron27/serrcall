<?php
//COMPROBAR DATOS EN POST 
require_once('../conn/conexion.php');
$miPDO=new PDO ($hostPDO,$usuarioDB,$contraseyaDB);
$hostPDO="mysql:host=$hostDB;dbname=$nombreDB;";
$miConsulta=$miPDO->PREPARE('SELECT * FROM proveedores;');
$miConsulta->execute();
$consul=isset($_REQUEST['consul'])? $_REQUEST['consul']:null;
$conss=$miPDO->PREPARE("SELECT * FROM proveedores where Pro_ID='$consul';");
$conss->execute();
?>

<form action="" method="POST">
        <input type="text" name="consul" id="consul" class="form-control formu" placeholder="Cédula*">
        <button type="submit" class="btn btn-dark consul2 abuebo col btn2" name="Consulta">Consulta<img src="../img/lupa.png" width="20px"></button>
</form>
</div>
<?php 
if(isset($_POST['Consulta'])){ //*1*//


   if($conss->rowCount()==0){//*2*//
  ?>
    <p>No hay registros existentes con el número: <em><?php echo $consul;?></em> </p>
    <?php foreach ($miConsulta as $valor):?>
            <tr>   
                    <td class="gris"><?= $valor['Pro_Nombre'];?></td>
                    <td ><?= $valor['Pro_Nit'];?></td>
                    <td class="gris"><?= $valor['Pro_Email'];?></td>
                    <td><?= $valor['Pro_Celular'];?></td>
                    <td class="gris"><?= $valor['Pro_Direccion'];?></td>
                    <td> <a href="../conn/Modificar/Proveedores_Modificar.php?Pro_ID=<?=$valor['Pro_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                        <td class="gris"> <a href="../conn/Eliminar/Delete_Proveedor.php?Pro_ID=<?=$valor['Pro_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                    </tr>
                   <?php endforeach;

   } else {//*2*//
    ?>
     <?php foreach ($conss as $valor):?>
            <tr>   
                    <td class="gris"><?= $valor['Pro_Nombre'];?></td>
                    <td ><?= $valor['Pro_Nit'];?></td>
                    <td class="gris"><?= $valor['Pro_Email'];?></td>
                    <td><?= $valor['Pro_Celular'];?></td>
                    <td class="gris"><?= $valor['Pro_Direccion'];?></td>
                    <td> <a href="../conn/Modificar/Proveedores_Modificar.php?Pro_ID=<?=$valor['Pro_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                        <td class="gris"> <a href="../conn/Eliminar/Delete_Proveedor.php?Pro_ID=<?=$valor['Pro_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                    </tr>
                   <?php endforeach;
}
}else{//*1*//
      foreach ($miConsulta as $valor):?>
            <tr>   
                    <td class="gris"><?= $valor['Pro_Nombre'];?></td>
                    <td ><?= $valor['Pro_Nit'];?></td>
                    <td class="gris"><?= $valor['Pro_Email'];?></td>
                    <td><?= $valor['Pro_Celular'];?></td>
                    <td class="gris"><?= $valor['Pro_Direccion'];?></td>
                    <td> <a href="../conn/Modificar/Proveedores_Modificar.php?Pro_ID=<?=$valor['Pro_ID'];?>"><button type="button" class="btn btn-warning" ><img src="../img/editar.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button></a></td>
                        <td class="gris"> <a href="../conn/Eliminar/Delete_Proveedor.php?Pro_ID=<?=$valor['Pro_ID'];?>" button type="button" class="btn btn-danger"><img src="../img/basura.png" width="25px"  margin-top="5px"  margin-bottom="5px"></button> </td>
                    </tr>
                   <?php endforeach;
    }
 ?>


 