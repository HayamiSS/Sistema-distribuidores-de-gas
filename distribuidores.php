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
    $activo = $_POST["activo"];
    $id_lista_precios = $_POST["opcion_venta"];
    $comision_vale_2 = $_POST["comision2"];
    $comision_vale_5 = $_POST["comision5"];
    $comision_vale_11 = $_POST["comision11"];
    $comision_vale_15 = $_POST["comision15"];
    $comision_vale_45 = $_POST["comision45"];
    $comision_vale_H15 = $_POST["comisionH15"];

    if ($id_lista_precios == "seleccione...") {
      $id_lista_precios = 0;
    }

    if ($activo == "") {
      $activo = 0;
    }

    if ($comision_vale_2 == "") {
      $comision_vale_2 = 0;
    }
    if ($comision_vale_5 == "") {
      $comision_vale_5 = 0;
    }

    if ($comision_vale_11 == "") {
      $comision_vale_11 = 0;
    }

    if ($comision_vale_15 == "") {
      $comision_vale_15 = 0;
    }

    if ($comision_vale_45 == "") {
      $comision_vale_45 = 0;
    }
    if ($comision_vale_H15 == "") {
      $comision_vale_H15   = 0;
    }

    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT nombre FROM distribuidor WHERE nombre = '$nombre';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "INSERT INTO distribuidor (id_lista_precios,nombre,activo,comision_vale_2,comision_vale_5,comision_vale_11,comision_vale_15,comision_vale_45,comision_vale_h15) VALUES ('$id_lista_precios','$nombre',$activo,$comision_vale_2,$comision_vale_5,$comision_vale_11,$comision_vale_15,$comision_vale_45,$comision_vale_H15)";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    } else {
      $query = mysqli_query($link, "SELECT nombre FROM distribuidor WHERE id_distribuidor!=$id AND nombre = '$nombre';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "UPDATE distribuidor SET nombre = '$nombre',activo='$activo',id_lista_precios='$id_lista_precios',comision_vale_2='$comision_vale_2',comision_vale_5='$comision_vale_5',comision_vale_11='$comision_vale_11',comision_vale_15='$comision_vale_15',comision_vale_45='$comision_vale_45',comision_vale_h15='$comision_vale_H15'WHERE id_distribuidor=$id";
        $result = mysqli_query($link, $query);
        $updated = 1;
      }
    }


    // Limpia Variables
    $id = "";
    $nombre = "";
    $activo = "";
    $id_lista_precios = "";
    $comision_vale_2 = "";
    $comision_vale_5 = "";
    $comision_vale_11 = "";
    $comision_vale_15 = "";
    $comision_vale_45 = "";
    $comision_vale_H15 = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM distribuidor WHERE id_distribuidor=$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************

  $query = "SELECT id_distribuidor,id_lista_precios,nombre,activo,comision_vale_2,comision_vale_5,comision_vale_11,comision_vale_15,comision_vale_45,comision_vale_h15 FROM distribuidor WHERE id_distribuidor='$id'";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_distribuidor"];
    $nombre = $row["nombre"];
    $activo = $row["activo"];
    $id_lista_precios = $row["id_lista_precios"];
    $comision_vale_2 = $row["comision_vale_2"];
    $comision_vale_5 = $row["comision_vale_5"];
    $comision_vale_11 = $row["comision_vale_11"];
    $comision_vale_15 = $row["comision_vale_15"];
    $comision_vale_45 = $row["comision_vale_45"];
    $comision_vale_H15 = $row["comision_vale_h15"];
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
            <h6><i class="fa-solid fa-truck"></i> Distribuidores
            </h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="distribuidores.php" class="was-validated">
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

                    <label for="nombre">Lista de precios :</label>
                    <br>
                    <select class="custom-select mr-sm-2 w-25" id="inlineFormCustomSelect" name="opcion_venta">
                      <option>seleccione...</option>
                      <?
                      $consu = "SELECT id_lista_precios,nombre FROM lista_precios;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_lista_precios_ = $row['id_lista_precios'];
                        $nombre_ = $row['nombre'];
                      ?>
                        <option <? if ($id_lista_precios == $id_lista_precios_) { ?>selected<? } ?> value=<? echo $id_lista_precios_; ?>> <? echo $nombre_; ?></option>;
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


                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" aria-describedby="texto_nombre" name="nombre" value="<?php echo $nombre ?>" maxlength="50" required>
                    <small id="texto_nombre" class="form-text text-muted">El nombre debe hacer referencia a la Comuna/ciudad a donde se realizan despachos de pedidos telef&oacute;nicos</small>


                    <div class="container">
                      <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <label for="nombre">Comisi&oacute;n Vale 2:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision2" aria-describedby="texto_nombre" name="comision2" value="<?php echo $comision_vale_2 ?>" maxlength="50">

                        <label for="nombre">Comisi&oacute;n Vale 5:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision5" aria-describedby="texto_nombre" name="comision5" value="<?php echo $comision_vale_5 ?>" maxlength="50">

                        <label for="nombre">Comisi&oacute;n Vale 11:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision11" aria-describedby="texto_nombre" name="comision11" value="<?php echo $comision_vale_11 ?>" maxlength="50">
                        </div>
                        <div class="col-md-6 col-sm-12">
                        <label for="nombre">Comisi&oacute;n Vale 15:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision15" aria-describedby="texto_nombre" name="comision15" value="<?php echo $comision_vale_15 ?>" maxlength="50">

                        <label for="nombre">Comisi&oacute;n Vale 45:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comision45" aria-describedby="texto_nombre" name="comision45" value="<?php echo $comision_vale_45 ?>" maxlength="50">

                        <label for="nombre">Comisi&oacute;n Vale H15:</label>
                        $ <input type="number" class="form-control w-50" step="1" id="comisionH12" aria-describedby="texto_nombre" name="comisionH15" value="<?php echo $comision_vale_H15 ?>" maxlength="50">
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
                  <th scope="col">Canal de Ventas</th>
                  <th scope="col">Comisi&oacute;n
                    Vale 2kg.</th>
                  <th scope="col">Comisi&oacute;n
                    Vale 5kg.</th>
                  <th scope="col">Comisi&oacute;n
                    Vale 11kg.</th>
                  <th scope="col">Comisi&oacute;n
                    Vale 15kg.</th>
                  <th scope="col">Comisi&oacute;n
                    Vale 45kg.</th>
                  <th scope="col">Comisi&oacute;n
                    Vale H15kg.</th>

              </thead>
              <tbody>
                <?

                $numero_linea = 0;
                $query = "SELECT id_distribuidor,activo,id_lista_precios,nombre,comision_vale_2,comision_vale_5,comision_vale_11,comision_vale_15,comision_vale_45,comision_vale_h15 FROM distribuidor ORDER BY nombre ";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_distribuidor"];
                  $nombre_ = $row["nombre"];
                  $activo_ = $row["activo"];
                  $id_lista_precios_ = $row["id_lista_precios"];
                  $comision_vale_2_ = $row["comision_vale_2"];
                  $comision_vale_5_ = $row["comision_vale_5"];
                  $comision_vale_11_ = $row["comision_vale_11"];
                  $comision_vale_15_ = $row["comision_vale_15"];
                  $comision_vale_45_ = $row["comision_vale_45"];
                  $comision_vale_H15_ = $row["comision_vale_h15"];


                  $numero_linea += 1;

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
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='distribuidores.php?id=<? echo $id_ ?>&elimina=<?php echo 1 ?>';">Eliminar <i class="far fa-trash-alt" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                    </td>
                    <td><?php echo $nombre_ ?></td>
                    <td><?php if ($activo_ == 0) {
                          echo "No";
                        } else if ($activo_ == 1) {
                          echo "Si";
                        } ?></td>
                    <td><?php
                        $query2 = "SELECT nombre FROM lista_precios where $id_lista_precios_ = id_lista_precios ";
                        $result2 = mysqli_query($link, $query2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $nombre_venta = $row2["nombre"];

                        echo $nombre_venta;

                        ?></td>
                    <td><?php echo $comision_vale_2_ ?></td>
                    <td><?php echo $comision_vale_5_ ?></td>
                    <td><?php echo $comision_vale_11_ ?></td>
                    <td><?php echo $comision_vale_15_ ?></td>
                    <td><?php echo $comision_vale_45_ ?></td>
                    <td><?php echo $comision_vale_H15_ ?></td>
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