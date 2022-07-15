<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontello.css">
  <link rel="stylesheet" href="css/estilos.css">
  <title>SysPos - de Gesti&oacute;n para Puntos de Venta</title>
  <link rel="icon" href="img/favicon.svg" type="image/svg" />
  <script src="https://kit.fontawesome.com/6a84b49c1b.js" crossorigin="anonymous"></script>

</head>
<body>
<?php
$fecha1 = $_POST["fecha1"];
if (trim($fecha1)=="")
{
  $fecha1 = $_GET["fecha1"];
}

if (trim($fecha1) == "")
{
  $fecha1 = date("Y-m-d");
}
//echo "fecha1:".$fecha1;

  
  /*$fecha = date("Y-m-d");
  $hora = date("H:i:s"); */
  include("library/abre_coneccion.php");
  // SEGURIDAD
  $link = Conectarse();

  $id = $_POST["id"];
  if (trim($id) == "") {
    $id = $_GET["id"];
  }
  $graba = $_POST["graba"];
  if (trim($graba) == "") {
    $graba = $_GET["graba"];
  }
  $edita = $_POST["edita"];
  if (trim($edita) == "") {
    $edita = $_GET["edita"];
  }
  $elimina = $_POST["elimina"];
  if (trim($elimina) == "") {
    $elimina = $_GET["elimina"];
  }
  
  $desactivar = $_POST["desactivar"];
  if (trim($desactivar) == "") {
    $desactivar= $_GET["desactivar"];
  }

  $id_movil = $_POST["id_movil"];
  if (trim($id_movil) == "") {
    $id_movil= $_GET["id_movil"]; 
  }
//echo "id_movil:".$id_movil;

// traer ultimo odometro ingresado...mayor
if ($id_movil!="") 
{
  $queryMax = "SELECT MAX(odometro) AS odometro_mayor FROM registro_petroleo WHERE id_movil = $id_movil";
  //echo $queryMax;
  $resuMax = mysqli_query($link, $queryMax);
  if ($row = mysqli_fetch_assoc($resuMax))
  {
  $odometromax_ = $row["odometro_mayor"];
  }
  //echo "<br> odometro mayor: ".$odometromax_;
}
  // ************************************************************************
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

    //  desactivar / activar   
  // ************************************************************************
  if ($desactivar == 1) {

    $query = "SELECT activo FROM registro_petroleo WHERE id_registro_petroleo=$id";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) 
    {
      $valor_ = $row["activo"];
    }

    if ($valor_ == 1) {$valor_=0;} else {$valor_=1;}
   
    $query = "UPDATE registro_petroleo SET activo = $valor_ WHERE id_registro_petroleo=$id";
    $result = mysqli_query($link, $query);
    $updated = 1;

    $id = "";
  }


  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $id_movil = $_POST["id_movil"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $cantidad = $_POST["cantidad"];
    $odometro = $_POST["odometro"];
    $activo = $_POST["activo"];
    if ($activo == "") {
      $activo = 0;
    }
    
    //$fecha1 = $_POST["fecha1"];
    
    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT id_registro_petroleo FROM registro_petroleo;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "INSERT INTO registro_petroleo (id_movil,fecha,hora,cantidad,odometro,activo) VALUES ($id_movil,'$fecha', '$hora',$cantidad, $odometro,$activo)";
        //echo $query;
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    }
     
    else 
    {
      $query = mysqli_query($link, "SELECT id_registro_petroleo FROM registro_petroleo WHERE id_registro_petroleo!=$id;");
      //echo $query;
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated != 1)
      {
        
        $query = "UPDATE registro_petroleo SET id_movil=$id_movil,cantidad=$cantidad,odometro=$odometro,activo=$activo WHERE id_registro_petroleo='$id'";
        //echo $query;
        $result = mysqli_query($link, $query); 
        $updated = 1;
      }
    }
    // Limpia Variables
    $id_movil="";
    $fecha ="";
    $hora ="";
    $cantidad ="";
    $odometro ="";
    $activo ="";
  }
  // ************************************************************************

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  /*if ($elimina == 1) {
    $query = "DELETE FROM vendedor WHERE id_vendedor=$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }*/
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************

  $query = "SELECT id_movil,fecha,hora,cantidad,odometro,activo FROM registro_petroleo WHERE id_registro_petroleo='$id'";
  //echo $query;
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id_movil = $row["id_movil"];
    $fecha = $row["fecha"];
    $hora = $row["hora"]; 
    $cantidad = $row["cantidad"];
    $odometromax_ = $row["odometro"];
    $activo = $row["activo"];
  }

  // ************************************************************************
  ?>
  <div class="container-fluid">
    <!-- ENCABEZADO -->
    <!-- ENCABEZADO -->

    <!-- div para espaciado que se oculta en lg -->
    <div class="row">
      <div class="col bg-success d-lg-none" style="height: 50px;">&nbsp;</div>
    </div>
    <!-- div para espaciado que se oculta en lg -->

    <div class="row">
      <!-- MENU -->
      <!-- MENU -->

      <!-- CONTENIDO -->
      <div class="col-lg-9 col-xl-10">

        <!-- BARRA NAVEGACION -->
        <!-- FIN BARRA NAVEGACION -->

        <!-- CONFIGURACION -->
        <div class="card mt-3">
          <div class="card-header">
            <h6><i class="fa-solid fa-gas-pump"></i> CARGA MOVILES</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="carga_moviles.php" class="was-validated">
              <input type="hidden" name="fecha" value="<?php echo $fecha=date("Y-m-d"); ?>">
              <input type="hidden" name="fecha1" value="<?php echo $fecha1;?>">
              <input type="hidden" name="hora" value="<?php echo $hora = date("H:i:s");?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="activo" value="1">
              <input type="hidden" name="graba" value="<?php echo 1; ?>">
              <? if ($edita == 1) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Modo Edici&oacute;n!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <? } ?>
              <? if ($updated == 1) { ?>
                
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Registro Actualizado!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <? } ?>
              <? if ($recorded == 1) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Registro Grabado!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <? } ?>
              <? if ($delete == 1) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Registro Eliminado!</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <? } ?>
              <? if ($repeated == 1) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Registro Repetido</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              <? } ?>
              <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" <? if ($edita == 1) { ?>style="display:none" <? } ?>>
                Crea nuevo registro
              </button>
              <hr>
              <div class="collapse <? if ($edita == 1 || $id_movil!="") { ?>show<? }
               ?>" id="collapseExample">
                <div class="card card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-3">
                      <label for="nombre">Movil:</label>
                    <br>
                    <select class="custom-select mr-sm-2" name="id_movil" id="movil"
                    onchange="javascript:window.location.href='carga_moviles.php?id=<? echo $id_; ?>&edita=<?php echo $edita ?>&id_movil='+document.getElementById('movil').value;">
                    
                      <option>seleccione...</option>
                      <?
                      $consu = "SELECT id_movil, nombre FROM movil;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_movil_ = $row["id_movil"];
                        $nombre_ = $row['nombre'];
                      ?>
                        <option value=<? echo $id_movil_; ?> <?if ($id_movil_==$id_movil){?>selected<?}?>> <? echo $nombre_; ?></option>
                      <?
                      }
                      ?>
                    </select> 
                      </div>
                      <div class="col-3">
                      <label for="precioxlitro">Odometro:</label>
                        <input type="number" class="form-control" step="1" id="precioxlitro" aria-describedby="texto_nombre" name="odometro" value="<?php echo $odometromax_;?>"
                        max="2147483647" min="<?php echo $odometromax_; ?>" step="1">
                      </div>
                      <div class="col-3">
                      <label for="cantidad">Cantidad: </label>
                        <input type="number" class="form-control" step="1" id="cantidad" aria-describedby="texto_nombre" name="cantidad" value="<?php echo $cantidad;?>" maxlength="5" min="1" max="32767">
                      </div>
                      
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            <div class="text-right">
            <form name="fecha" action="carga_moviles.php" method="POST">
              <div class="form-group row">
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="fechaxeditar" name="fecha1" value="<?php echo $fecha1;?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="">Filtrar</button>
              </div>
            </form>
            </div>
            
            <table class="table table-hover mt-1 col-md-8">
                 <thead class="thead-light">
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">
                       <span class="d-none d-md-block">Editar</span>
                       <span class="d-block d-md-none">Edit</span>
                     </th>
                     <th scope="col">Estado</th>
                     <th scope="col">Fecha</th>
                     <th scope="col">Hora</th>
                     <th scope="col">Movil</th>
                     <th scope="col">Odometro</th>
                     <th scope="col">Cantidad</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?
                    $numero_linea = 0;
                    $query = "SELECT * FROM registro_petroleo where fecha = '$fecha1' and id_movil is not null order by activo desc, id_movil;";
                    //echo $query;
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id_ = $row["id_registro_petroleo"];
                      $id2_ = $row["id_movil"];
                      if ($id2_=="") { $id2_="No aplica";}
                      $activo_ = $row["activo"];
                      $fecha_ = $row["fecha"];
                      $hora_ = $row["hora"];
                      $odometro_ = $row["odometro"];
                      $cantidad_ = $row["cantidad"];
                      $numero_linea += 1;
                      
                      //query para selecionar el nombre del

                      $numero_linea1 = 0;
                      $query1 = "SELECT nombre from movil where id_movil = $id2_";
                      $result1 = mysqli_query($link, $query1);
                      if ($row1 = mysqli_fetch_assoc($result1)) {
                        $nombre_usuario = $row1["nombre"];
                      $numero_linea1 +=1;
                      }
                      


                    ?>
                    <?if($activo_ == 1){?> <?}else{?><tr class="table-danger"> <?}?>
                       <th scope="row"><?php echo $numero_linea ?></th>
                       <td>
                         <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='carga_moviles.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>&fecha1=<?php echo $fecha1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block"> <i class="far fa-edit" style="color:white;"></i></span></button>
                       </td>
                       <? if ($activo_ == 0) { ?>

                         <td>
                           <!-- Button modal REGISTRO -->
                           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal1<?php echo $id_ ?>"><span class="d-block">
                               Des<i class="far fa-times-circle" style="color:white;"></i></span>
                           </button>
                           <!-- Modal desactivar -->
                           <div class="modal fade" id="Modal1<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                   <h5 class="modal-title" id="ModalLabel">Activar Movil</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Activar a <strong><?php echo $nombre_usuario ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-success" onclick="javascript:window.location.href='carga_moviles.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?> &fecha1=<?php echo $fecha1; ?>';">Activar <i class="far fa-check-circle" style="color:white;"></i></button>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- Fin Modal -->
                         </td>

                       <? } else if ($activo_ == 1) { ?>

                        <td>
                           <!--xt-center Button modal REGISTRO -->
                           <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal2<?php echo $id_ ?>"><span class="d-block">
                               Act <i class="far fa-check-circle" style="color:white;"></i></span>
                           </button> 
                           <!-- Modal activar -->
                           <div class="modal fade" id="Modal2<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                   <h5 class="modal-title" id="ModalLabel">Desactivar movil</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Desactivar a <strong><?php echo $nombre_usuario ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='carga_moviles.php?id=<? echo $id_ ?>&desactivar=<?php echo 1?>';">Desactivar <i class="far fa-times-circle" style="color:white;"></i></button>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- Fin Modal -->
                         </td>
                       <? } ?>
                       <td><?php echo $fecha_ ?></td>
                       <td><?php echo $hora_ ?></td>
                       <td><?php echo $nombre_usuario; ?></td>
                       <td><?php echo number_format($odometro_)." kms." ?></td>
                       <td><?php echo number_format($cantidad_)." lts." ?></td>
                     </tr>
                   <?
                    }
                    ?>
                 </tbody>
                 
               </table>
           
          </div>
        </div>
        <!-- FIN CONFIGURACION -->
      </div>
      <!-- CONTENIDO -->
    </div>
  </div>
  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <? include("library/cierra_coneccion.php"); ?>

</body>
</html>