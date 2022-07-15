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
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $nombre = $_POST["nombre"];

    $query =  mysqli_query($link, "SELECT nombre FROM localidad WHERE nombre = '$nombre';");
    $rows    = mysqli_num_rows($query);

    if ($rows == 1) {

      $repeated = 1;

    } else {  

      if (trim($id) == "") {
        $query = "INSERT INTO localidad (nombre) VALUES ('$nombre')";
        $result = mysqli_query($link, $query);

        $recorded = 1;
      } else {
        $query = "UPDATE localidad SET nombre='$nombre' WHERE id_localidad=$id";
        $result = mysqli_query($link, $query);

        $updated = 1;
      }
    }
    // Limpia Variables
    $id = "";
    $nombre = "";
  }
  // ************************************************************************

 //  ACTUALIZA REGISTRO  
  // ************************************************************************
  if ($por_defecto == 1) {
    $query = "UPDATE localidad SET por_defecto=0 ";
    $result = mysqli_query($link, $query);
    $query = "UPDATE localidad SET por_defecto=1 WHERE id_localidad=$id";
    $result = mysqli_query($link, $query);
    $updated = 1;
    $id = "";
  }
  // 

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM localidad WHERE id_localidad=$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************
  $query = "SELECT id_localidad,nombre FROM localidad WHERE id_localidad='$id'";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_localidad"];
    $nombre = $row["nombre"];
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
            <h6><i class="fas fa-map-marked-alt"></i> Localidad</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="localidad.php">
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
              <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" <? if ($edita == 1) { ?>style="display:none" <? } ?>>
                Crea nuevo registro
              </button>
              <div class="collapse <? if ($edita == 1) { ?>show<? } ?>" id="collapseExample">
                <div class="card card-body">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="texto_nombre" name="nombre" value="<?php echo $nombre ?>" maxlength="50" required>
                    <small id="texto_nombre" class="form-text text-muted">El nombre debe hacer referencia a la Comuna/localidad a donde se realizan despachos de pedidos telef&oacute;nicos</small>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            <table class="table table-hover mt-1">
              <thead class="thead-light">
                <tr>
                  <th scope="col">#</th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Editar</span>
                    <span class="d-block d-md-none">Edit</span>
                  </th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Eliminar</span>
                    <span class="d-block d-md-none">Del</span>
                  </th>
                  <th scope="col">Nombre</th>
                  <th scope="col" class="text-center ">
                    <span class="d-none d-md-block">Localidad por Defecto</span>
                    <span class="d-block d-md-none">Por Defecto</span>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?
                $numero_linea = 0;
                $query = "SELECT id_localidad,nombre,por_defecto FROM localidad ORDER BY nombre ";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_localidad"];
                  $nombre_ = $row["nombre"];
                  $por_defecto_ = $row["por_defecto"];

                  $numero_linea += 1;
                ?>
                  <tr>
                    <th scope="row"><?php echo $numero_linea ?></th>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='localidad.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block">Edit <i class="far fa-edit" style="color:white;"></i></span></button>
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
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='localidad.php?id=<? echo $id_ ?>&elimina=<?php echo 1 ?>';">Eliminar <i class="far fa-trash-alt" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                  </td>
                    <td><?php echo $nombre_ ?></td>
                    <td class=" text-center ">
                      <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input text-bg-danger" id="defecto<?php echo $numero_linea?>" onclick="javascript:window.location.href='localidad.php?id=<? echo $id_ ?>&por_defecto=1';" <? if ($por_defecto_ == 1) { ?>checked<? } ?>>
                        <label class="custom-control-label" for="defecto<?php echo $numero_linea ?>"></label>
                      </div>
                    </td>
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