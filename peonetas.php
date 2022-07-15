<!doctype html>
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

  $por_defecto = $_GET["por_defecto"];


  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $nombre = $_POST["nombre"];
    $activo = $_POST["activo"];
    $comision2 = $_POST["comision2"];
    $comision5 = $_POST["comision5"];
    $comision11 = $_POST["comision11"];
    $comision15 = $_POST["comision15"];
    $comision45 = $_POST["comision45"];
    $comisionh15 = $_POST["comision15"];
    if ($activo==""){$activo=0;}
    if ($comision2 == "") {$comision2=0;}
    if ($comision5 == "") {$comision5=0;}
    if ($comision11 == "") {$comision11=0;}
    if ($comision15 == "") {$comision15=0;}
    if ($comision45 == "") {$comision45=0;}
    if ($comisionh15 == "") {$comisionh15=0;}
    

    if (trim($id) == "") 
    {
      $query =  mysqli_query($link, "SELECT * FROM peoneta WHERE nombre = '$nombre';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated!=1)
      {
        $query = "INSERT INTO peoneta (activo, nombre, comision_2, comision_5,comision_11, comision_15, comision_45, comision_h15) VALUES ($activo,'$nombre',$comision2, $comision5, $comision11, $comision15, $comision45,
        $comisionh15);";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      } 
    } else {
      $query =  mysqli_query($link, "SELECT * FROM peoneta WHERE id_peoneta!=$id AND 
      activo = $activo and nombre = '$nombre' and comision_2 = $comision2 and comision_5 = $comision5 and comision_11 = $comision11 and comision_15 = $comision15 and comision_45 = $comision45 and comision_h15 = $comisionh15;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated!=1)
      {
        $query = "UPDATE peoneta SET activo = $activo, nombre = '$nombre', comision_2 = $comision2, comision_5 = $comision5, comision_11 = $comision11, comision_15 = $comision15, comision_45 = $comision45, comision_h15 = $comisionh15 WHERE id_peoneta=$id;";
        $result = mysqli_query($link, $query);
        $updated = 1;
      }
    }
  
    // Limpia Variables
    $id = "";
    $nombre = "";
    $activo ="";
    $comision2="";
    $comision5="";
    $comision11="";
    $comision15="";
    $comision45="";
    $comisionh15="";
  }
  // ************************************************************************

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM peoneta WHERE id_peoneta =$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************
  $query = "SELECT id_peoneta,nombre,comision_2,comision_5,comision_11,comision_15,comision_45,comision_h15 FROM peoneta WHERE id_peoneta='$id'";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id_ = $row["id_peoneta"];
    $nombre_ = $row["nombre"];
    $comision2_ = $row["comision_2"];
    $comision5_ = $row["comision_5"];
    $comision11_ = $row["comision_11"];
    $comision15_ = $row["comision_15"];
    $comision45_ = $row["comision_45"];
    $comisionh45_ = $row["comision_h15"];
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
        <div class="card mt-3 justify-content-center">
          <div class="card-header">
            <h6><i class="fa-solid fa-file-invoice-dollar text-center"></i> Crear Peoneta y adicion de comisiones</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="peonetas.php" class="was-validated"> 
              <input type="hidden" name="id" value="<?php echo $id; ?>">
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
              <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample"
              <? if ($edita == 1) { ?>
                style="display:none" <? } ?>>
                Crea nuevo registro
              </button>
              <div class="collapse <? if ($edita == 1) { ?>show<? } ?>" id="collapseExample">
                <div class="card card-body">
                  <div class="form-group">
                    <label for="nombre">Nombre Peoneta</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="texto_nombre" name="nombre" value="<?php echo $nombre_ ?>" maxlength="50" required>
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="checkbox" name="activo" value="1" <?if ($activo==1){?>checked<?}?>>
                      </div>
                    </div>
                    <span> Aparece en el sistema</span>
                  </div> 
                  </div>
                  <div class="form-group">
                    <label for="monto">Comision cilindro 2:</label>
                    <input type="number" class="form-control" id="comision2" aria-describedby="texto_nombre" name="comision2" value="<?php echo $comision2_ ?>" min="0" step="1">
                  </div>
                  <div class="form-group">
                    <label for="monto">Comision cilindro 5:</label>
                    <input type="number" class="form-control" id="comision5" aria-describedby="texto_nombre" name="comision5" value="<?php echo $comision5_ ?>" maxlength="8">
                  </div>
                  <div class="form-group">
                    <label for="monto">Comision cilindro 11:</label>
                    <input type="number" class="form-control" id="comision11" aria-describedby="texto_nombre" name="comision11" value="<?php echo $comision11_ ?>" maxlength="8" min="0" step="1">
                  </div>
                  <div class="form-group">
                    <label for="monto">Comision cilindro 15:</label>
                    <input type="number" class="form-control" id="comision15" aria-describedby="texto_nombre" name="comision15" value="<?php echo $comision15_ ?>" maxlength="8" min="0" step="1">
                  </div>
                  <div class="form-group">
                    <label for="monto">Comision cilindro 45:</label>
                    <input type="number" class="form-control" id="comision45" aria-describedby="texto_nombre" name="comision45" value="<?php echo $comision45_ ?>" min="0" step="1" maxlength="8">
                  </div>
                  <div class="form-group">
                    <label for="monto">Comision cilindro H15:</label>
                    <input type="number" class="form-control" id="comisionh15" aria-describedby="texto_nombre" name="comisionh15" value="<?php echo $comisionh15_ ?>" min="0" step="1" maxlength="8">
                  </div>
                  
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            <table class="table table-hover mt-1 col-md-8">
              <thead class="thead-light">
                <tr>
                <th scope="col">#</th>
                  <th scope="col">ID Peoneta</th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Editar</span>
                    <span class="d-block d-md-none">Edit</span>
                  </th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Eliminar</span>
                    <span class="d-block d-md-none">Del</span>
                  </th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Comision 2</th>
                  <th scope="col">Comision 5</th>
                  <th scope="col">Comision 11</th>
                  <th scope="col">Comision 15</th>
                  <th scope="col">Comision 45</th>
                  <th scope="col">Comision H15</th>
                </tr>
              </thead>
              <tbody>
                <?
                $numero_linea = 0;
                $query = "SELECT * FROM peoneta ORDER BY id_peoneta";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_peoneta"];
                  $activo_= $row["activo"];
                  $nombre_ = $row["nombre"];
                  $comision2_ = $row["comision_2"];
                  $comision5_ = $row["comision_5"];
                  $comision11_ = $row["comision_11"];
                  $comision15_ = $row["comision_15"];
                  $comision45_ = $row["comision_45"];
                  $comisionh15_ = $row["comision_45"];
                  $numero_linea += 1;
                ?>
                  <tr>
                  <th scope="row"><?php echo $numero_linea ?></th>
                    <th scope="row"><?php echo $id_ ?></th>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='peonetas.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block">Edit <i class="far fa-edit" style="color:white;"></i></span></button>
                    </td>
                    <td class="text-center">
                      <!-- Button modal REGISTRO -->
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal<?php echo $id_ ?>"><span class="d-block d-md-none">
                          <i class="far fa-trash-alt" style="color:white;"></i></span><span class="d-none d-md-block">
                          Del <i class="far fa-trash-alt" style="color:white;"></i></span>
                      </button>
                      <!-- Modal -->
                      <div class="modal fade" id="Modal<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Elimina Registro!</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button> 
                            </div>
                            <div class="modal-body" id="modal-body">
                              Esta seguro que desea eliminar <strong><?php echo $nombre_ ?></strong> del listado?
                              <small id="texto_nombre" class="form-text text-muted mt-2">Al eliminar un registro se pierde tambien la informaci&oacute;n asociada a su hist&oacute;rico</small>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='peonetas.php?id=<? echo $id_ ?>&elimina=<?php echo 1 ?>';">Eliminar <i class="far fa-trash-alt" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                  </td>
                    <td><?php echo $nombre_?></td>
                    <td><?php echo $comision2_?></td>
                    <td><?php echo $comision5_?></td>
                    <td><?php echo $comision11_?></td>
                    <td><?php echo $comision15_?></td>
                    <td><?php echo $comision45_?></td>
                    <td><?php echo $comisionh15_?></td>
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