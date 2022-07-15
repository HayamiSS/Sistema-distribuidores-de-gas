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
    $monto = $_POST["monto"];
    $monto_fijo =$_POST["monto_fijo"];
    if ($monto==""){$monto=0;}
    if ($monto_fijo==""){$monto_fijo=0;}
    

    if (trim($id) == "") 
    {
      $query =  mysqli_query($link, "SELECT * FROM pago WHERE nombre = '$nombre';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated!=1)
      {
        $query = "INSERT INTO pago (nombre, monto, monto_fijo) VALUES ('$nombre','$monto','$monto_fijo');";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      } 
    } else {
      $query =  mysqli_query($link, "SELECT * FROM pago WHERE id_pago!=$id AND nombre = '$nombre' and monto_fijo = '$monto_fijo';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated!=1)
      {
        $query = "UPDATE pago SET nombre = '$nombre', monto = '$monto', monto_fijo='$monto_fijo' WHERE id_pago=$id";
        $result = mysqli_query($link, $query);
        $updated = 1;
      }
    }
    // Limpia Variables
    $id = "";
    $nombre = "";
    $monto ="";
  }
  // ************************************************************************

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM pago WHERE id_pago =$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************
    $query = "SELECT id_pago, nombre, monto, monto_fijo FROM pago WHERE id_pago='$id'";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) {
    $id_ = $row["id_pago"];
    $nombre_ = $row["nombre"];
    $monto_ = $row["monto"];
    $monto_fijo = $row["monto_fijo"];
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
            <h6><i class="fa-solid fa-file-invoice-dollar"></i> Crear pagos de rendicion</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="rendicion_pagos.php" class="was-validated">
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
                    <input type="text" class="form-control" id="nombre" aria-describedby="texto_nombre" name="nombre" value="<?php echo $nombre_ ?>" maxlength="50" required>
                    <small id="texto_nombre" class="form-text text-muted">El nombre debe hacer referencia a la Comuna/localidad a donde se realizan despachos de pedidos telef&oacute;nicos</small>
                  </div>
                  <div class="form-group">
                    <label for="monto">Monto</label>
                    <input type="text" class="form-control" id="monto" aria-describedby="texto_nombre" name="monto" value="<?php echo $monto_ ?>" maxlength="8">
                    <small id="texto_nombre" class="form-text text-muted">El nombre debe hacer referencia a la Comuna/localidad a donde se realizan despachos de pedidos telef&oacute;nicos</small>
                  </div>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <input type="checkbox" name="monto_fijo" value="1" <?if ($monto_fijo==1){?>checked<?}?>>
                      </div>
                    </div>
                    <span> Establece el monto ingresado como un monto fijo</span>
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
                  <th scope="col">ID pago</th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Editar</span>
                    <span class="d-block d-md-none">Edit</span>
                  </th>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Eliminar</span>
                    <span class="d-block d-md-none">Del</span>
                  </th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Monto</th>
                </tr>
              </thead>
              <tbody>
                <?
                $numero_linea = 0;
                $query = "SELECT * FROM pago ORDER BY id_pago";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_pago"];
                  $nombre_ = $row["nombre"];
                  $monto_ = $row["monto"];
                  $numero_linea += 1;
                ?>
                  <tr>
                  <th scope="row"><?php echo $numero_linea ?></th>
                    <th scope="row"><?php echo $id_ ?></th>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='rendicion_pagos.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block">Edit <i class="far fa-edit" style="color:white;"></i></span></button>
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
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='rendicion_pagos.php?id=<? echo $id_ ?>&elimina=<?php echo 1 ?>';">Eliminar <i class="far fa-trash-alt" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                  </td>
                    <td><?php echo $nombre_?></td>
                    <td><?php echo $monto_?></td>
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