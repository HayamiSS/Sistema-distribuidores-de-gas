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
  <?php
  include("library/abre_coneccion.php");
  $link = Conectarse();
  ?>
</head>
<body>
<?php
 
  // SEGURIDAD
 

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
  if ($graba == 1) 
  {
    // Variables POST
    $recorded = 1;
    $nombre = $_POST["nombre"];
    $tipo_producto = $_POST["tipo_producto"];

    $insert = "INSERT INTO clientes (nombre_cliente, tipo_producto) values ('$nombre','$tipo_producto');";
    $resultado = mysqli_query($link, $insert);
    echo $insert."<br>";
    
    // Limpia Variables
    $nombre = "";
    $tipo_producto = "";
                                         
  }
  // ************************************************************************

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM clientes WHERE id_cliente=$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
    echo $query."<br>";
  }
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************

  $query = "SELECT id_cliente, nombre_cliente, tipo_producto FROM clientes WHERE id_cliente='$id'";
  //echo "selecciona registro segun id a editar ".$query."<br>";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_cliente"];
    $nombre_cliente = $row["nombre_cliente"]; 
    $tipo_producto = $row["tipo_producto"];
    echo $query."<br>";
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
            <h6> ASIGNACION CLIENTES</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="cliente_nuevo.php" class="was-validated">
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
              <div class="collapse pt-4 <? if ($edita == 1) { ?>show<? }
               ?>" id="collapseExample">
                <div class="card card-body">
                <div class="form-row justify-content-center">
                  <div class="form-group col-4 pr-3">
                    <label for="cantidad">Nombre Cliente</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre_cliente;?>" maxlength="100">
                  </div>
                  <div class="form-group col-4 pl-3">
                    <label>Tipo de producto</label>
                    <select class="custom-select mr-sm-2" name="tipo_producto" id="etipo_producto">
                      <option>seleccione...</option>
                      <option value="ERPGAS" <?if ($tipo_producto == "ERPGAS") { ?>selected<? }?> ><?php $tipo_producto; ?> ERPGAS</option>
                      <option value="SYSGA" <?if ($tipo_producto == "SYSGA") { ?>selected<? }?>><?php $tipo_producto; ?> SYSGA</option>
                      <option value="SYSPOS" <?if ($tipo_producto == "SYSPOS") { ?>selected<? }?>><?php $tipo_producto; ?> SYSPOS</option>
                      <option value="ERPWEB" <?if ($tipo_producto == "ERPWEB") { ?>selected<? }?>><?php $tipo_producto; ?> ERPWEB</option>
                      <option value="BUSCARGO" <?if ($tipo_producto == "BUSCARGO") { ?>selected<? }?>><?php $tipo_producto; ?> BUSCARGO</option>
                    </select> 
                  </div>
                  <button type="submit" class="btn btn-primary col-8">Grabar</button>
                </div>
              </div>
            </form>
          </div>
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
                  <th scope="col">Producto</th>
                </tr>
              </thead>
              <tbody>
                <?
                $numero_linea = 0;
                $query = "SELECT * FROM clientes ORDER BY id_cliente DESC";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_cliente"];
                  $nombre_ = $row["nombre_cliente"];
                  $tipo_producto_ = $row["tipo_producto"];
                  $numero_linea += 1;
                ?>
                  <tr>
                  <th scope="row"><?php echo $numero_linea ?></th>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='cliente_nuevo.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block">Edit <i class="far fa-edit" style="color:white;"></i></span></button>
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
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='cliente_nuevo.php?id=<? echo $id_ ?>&elimina=<?php echo 1 ?>';">Eliminar <i class="far fa-trash-alt" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                  </td>
                    <td><?php echo $nombre_;?></td>
                    <td><?php echo $tipo_producto_;?></td>
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