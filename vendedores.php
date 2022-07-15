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

  // ************************************************************************
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $id_usuario = $_POST["id_usuario"];
    $activo = $_POST["activo"];
    $comision_2 = $_POST["comision_2"];
    $comision_5 = $_POST["comision_5"];
    $comision_11 = $_POST["comision_11"];
    $comision_15 = $_POST["comision_15"];
    $comision_45 = $_POST["comision_45"];
    $comision_H15 = $_POST["comision_h15"];

    if ($activo == "") {
      $activo = 0;
    }

    if ($comision_2 == "") {
      $comision_2 = 0;
    }
    if ($comision_5 == "") {
      $comision_5 = 0;
    }

    if ($comision_11 == "") {
      $comision_11 = 0;
    }

    if ($comision_15 == "") {
      $comision_15 = 0;
    }

    if ($comision_45 == "") {
      $comision_45 = 0;
    }
    if ($comision_H15 == "") {
      $comision_H15   = 0;
    }

    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT nombre FROM usuarios;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "INSERT INTO vendedor (id_usuario,activo,comision_2,comision_5,comision_11,comision_15,comision_45,comision_h15) VALUES ($id_usuario, $activo,$comision_2,$comision_5,$comision_11,$comision_15,$comision_45,$comision_H15)";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    } else {
      $query = mysqli_query($link, "SELECT id_usuario FROM vendedor WHERE id_vendedor!=$id;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "UPDATE vendedor SET id_usuario='$id_usuario', activo='$activo',comision_2='$comision_2',comision_5='$comision_5',comision_11='$comision_11',comision_15='$comision_15',comision_45='$comision_45',comision_h15='$comision_H15'WHERE id_vendedor=$id";
        $result = mysqli_query($link, $query);
        $updated = 1;
      }
    }


    // Limpia Variables
    $id = "";
    $nombre = "";
    $activo = "";
    $comision_2 = "";
    $comision_5 = "";
    $comision_11 = "";
    $comision_15 = "";
    $comision_45 = "";
    $comision_H15 = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM vendedor WHERE id_vendedor=$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************

  $query = "SELECT id_vendedor, id_usuario, activo,comision_2,comision_5,comision_11,comision_15,comision_45,comision_h15 FROM vendedor WHERE id_vendedor='$id'";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_vendedor"];
    $id_usuario = $row["id_usuario"];
    $activo = $row["activo"];
    $comision_2 = $row["comision_2"];
    $comision_5 = $row["comision_5"];
    $comision_11 = $row["comision_11"];
    $comision_15 = $row["comision_15"];
    $comision_45 = $row["comision_45"];
    $comision_H15 = $row["comision_h15"];
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
            <h6><i class="fa-solid fa-head-side-mask"></i> Crear vendedor
            </h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="vendedores.php" class="was-validated">
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

                    <label for="nombre">Usuario:</label>
                    <br>
                    <select class="custom-select mr-sm-2 w-50" id="inlineFormCustomSelect" name="id_usuario">
                      <option>seleccione...</option>
                      <?
                      $consu = "SELECT id_usuario, nombre FROM usuarios;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_ = $row["id_usuario"];
                        $nombre_ = $row['nombre'];
                      ?>
                        <option value=<? echo $id_; ?> <?if ($id_==$id_usuario){?>selected<?}?>> <? echo $nombre_; ?></option>
                      <?
                      }
                      ?>
                    </select>
                    <div class="form-check mt-3">
                      <input class="form-check-input" type="checkbox" name="activo" id="activo" value="1" id="defaultCheck1" <? if ($activo == "1") { ?>checked<? } ?>>
                      <label class="form-check-label" for="defaultCheck1">
                        Activo (Aparece en el Sistema)
                      </label>
                    </div>
                    <hr>
                    <h3 class="primary">Asignacion de comisiones para el vendedor</h3>
                    <hr>
                      <div class="container-fluid">
                        <hr>
                      <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <label for="nombre">Comisión cilindro 2:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision2" aria-describedby="texto_nombre" name="comision_2" value="<?php echo $comision_2 ?>" maxlength="50">

                        <label for="nombre">Comisión cilindro 5:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision5" aria-describedby="texto_nombre" name="comision_5" value="<?php echo $comision_5 ?>" maxlength="50">

                        <label for="nombre">Comisión cilindro 11:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision11" aria-describedby="texto_nombre" name="comision_11" value="<?php echo $comision_11 ?>" maxlength="50">
                        </div>
                        <div class="col-md-6 col-sm-12">
                        <label for="nombre">Comisión cilindro 15:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision15" aria-describedby="texto_nombre" name="comision_15" value="<?php echo $comision_15 ?>" maxlength="50">

                        <label for="nombre">Comisión cilindro 45:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision45" aria-describedby="texto_nombre" name="comision_45" value="<?php echo $comision_45 ?>" maxlength="50">

                        <label for="nombre">Comisión cilindro H15:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comisionH12" aria-describedby="texto_nombre" name="comision_h15" value="<?php echo $comision_H15 ?>" maxlength="50">
                        </div>
                      </div>
                    </div>

                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            <table class="table table-hover mt-1">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Editar</span>
                    <span class="d-block d-md-none">Edit</span>
                  </th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Eliminar</span>
                    <span class="d-block d-md-none">Del</span>
                  </th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Activo</th>
                  <th scope="col">Comisi&oacute;n 2kg.</th>
                  <th scope="col">Comisi&oacute;n 5kg.</th>
                  <th scope="col">Comisi&oacute;n 11kg.</th>
                  <th scope="col">Comisi&oacute;n 15kg.</th>
                  <th scope="col">Comisi&oacute;n 45kg.</th>
                  <th scope="col">Comisi&oacute;n H15kg.</th>
              </thead>
              <tbody>
                <?
                $numero_linea = 0;
                $query = "SELECT id_vendedor, id_usuario, activo, comision_2, comision_5, comision_11, comision_15, comision_45, comision_h15 FROM vendedor ORDER BY id_vendedor";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_vendedor"];
                  $id2_ = $row["id_usuario"];
                  $activo_ = $row["activo"];
                  $comision_2_ = $row["comision_2"];
                  $comision_5_ = $row["comision_5"];
                  $comision_11_ = $row["comision_11"];
                  $comision_15_ = $row["comision_15"];
                  $comision_45_ = $row["comision_45"];
                  $comision_H15_ = $row["comision_h15"];

                  $numero_linea += 1;

                  $numero_linea1 = 0;
                $query1 = "SELECT nombre from usuarios where id_usuario = $id2_";
                $result1 = mysqli_query($link, $query1);
                if ($row1 = mysqli_fetch_assoc($result1)) {
                  $nombre_usuario = $row1["nombre"];
                  $numero_linea1 +=1;
                }
                ?>


                  <tr>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='vendedores.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block"><i class="far fa-edit" style="color:white;"></i></span></button>
                    </td>
                    <td class="text-center">
                      <!-- Button modal REGISTRO -->
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal<?php echo $id_ ?>"><span class="d-block">
                          <i class="far fa-trash-alt" style="color:white;"></i></span>
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
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='vendedores.php?id=<? echo $id_ ?>&elimina=<?php echo 1 ?>';">Eliminar <i class="far fa-trash-alt" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                    </td>
                    
                    <td><?php echo $nombre_usuario ?></td>
                    <td><?php if ($activo_ == 0) {
                          echo "No";
                        } else if ($activo_ == 1) {
                          echo "Si";
                        } ?></td>
                    <td><?php echo $comision_2_ ?></td>
                    <td><?php echo $comision_5_ ?></td>
                    <td><?php echo $comision_11_ ?></td>
                    <td><?php echo $comision_15_ ?></td>
                    <td><?php echo $comision_45_ ?></td>
                    <td><?php echo $comision_H15_ ?></td>
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