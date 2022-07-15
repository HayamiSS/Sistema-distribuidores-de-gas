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

  // ************************************************************************
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $cantidad = $_POST["cantidad"];
    $precioxlitro = $_POST["precioxlitro"];
    $tipodocumento = $_POST["tipodocumento"];
    $numerodocumento = $_POST["numerodocumento"];
    $total = ($cantidad * $precioxlitro);
    
    //$fecha1 = $_POST["fecha1"];
    
    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT id_registro_petroleo FROM registro_petroleo;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "INSERT INTO registro_petroleo (fecha, hora, cantidad, precio_litro, tipo_documento, numero_documento) VALUES ('$fecha', '$hora',$cantidad, $precioxlitro, $tipodocumento, $numerodocumento)";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    } else {
      $query = mysqli_query($link, "SELECT id_registro_petroleo FROM registro_petroleo WHERE id_registro_petroleo!=$id;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        
        $query = "UPDATE registro_petroleo SET cantidad=$cantidad,precio_litro=$precioxlitro,tipo_documento='$tipodocumento',numero_documento=$numerodocumento WHERE id_registro_petroleo='$id'";
        $result = mysqli_query($link, $query); 
        $updated = 1;
      }
    }


    // Limpia Variables
    $fecha ="";
    $hora ="";
    $cantidad ="";
    $precioxlitro ="";
    $tipodocumento ="";
    $numerodocumento ="";
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

  $query = "SELECT id_registro_petroleo,fecha,hora,cantidad,precio_litro,tipo_documento,numero_documento FROM registro_petroleo WHERE id_registro_petroleo='$id'";
  //echo $query;
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_registro_petroleo"];
    $fecha = $row["fecha"];
    $hora = $row["hora"];
    $cantidad = $row["cantidad"];
    $precioxlitro = $row["precio_litro"];
    $tipodocumento = $row["tipo_documento"];
    $numerodocumento = $row["numero_documento"];
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
            <h6><i class="fa-solid fa-gas-pump"></i> CONTROL DE PETROLEO</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="compra_petroleo.php" class="was-validated">
              <input type="hidden" name="fecha" value="<?php echo $fecha=date("Y-m-d"); ?>">
              <input type="hidden" name="fecha1" value="<?php echo $fecha1;?>">
              <input type="hidden" name="hora" value="<?php echo $hora = date("H:i:s");?>">
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
              <hr>
              <div class="collapse <? if ($edita == 1) { ?>show<? } ?>" id="collapseExample">
                <div class="card card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-3">
                      <label for="nombre">Tipo documento:</label>
                    <br>
                    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="tipodocumento">
                      <option>seleccione...</option>
                        <option <?if($tipodocumento == "1"){?>selected<?} ?> value="1"  >Guia de despacho</option>

                        <option <?if($tipodocumento == "2"){?>selected<?}?> value="2"  >Factura
                        </option>
                    </select> 
                      </div>
                      <div class="col-3">
                      <label for="cantidad">Cantidad: </label>
                        <input type="number" class="form-control" step="1" id="cantidad" aria-describedby="texto_nombre" name="cantidad" value="<?php echo $cantidad;?>" maxlength="5" min="1" max="32767">
                      </div>
                      <div class="col-3">
                      <label for="precioxlitro">Precio por litro:</label>
                        <input type="number" class="form-control" step="1" id="precioxlitro" aria-describedby="texto_nombre" name="precioxlitro" value="<?php echo $precioxlitro; ?>"
                        maxlength="5" min="1" max="32767">
                      </div>
                      <div class="col-3">
                      <label for="nombre">Numero documento:</label>
                        <input type="number" class="form-control" step="1" id="numerodocumento" aria-describedby="texto_nombre" name="numerodocumento" value="<?php echo $numerodocumento; ?>" maxlength="5" min="1">
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            <div class="text-right">
            <form name="fecha" action="compra_petroleo.php" method="POST">
              <div class="form-group row">
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="fechaxeditar" name="fecha1" value="<?php echo $fecha1;?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="">Filtrar</button>
              </div>
            </form>
            </div>
            <table class="table table-hover mt-1">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center">
                    <span class="d-none d-md-block">Editar</span>
                    <span class="d-block d-md-none">Edit</span>
                  </th>
                  <th scope="col">Fecha</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Precio x litro</th>
                  <th scope="col">Total</th>
                  <th scope="col">Tipo documento</th>
                  <th scope="col">Numero documento</th>
              </thead>
              <tbody>
                <?
                $query = "SELECT id_registro_petroleo,fecha,hora,cantidad,precio_litro, tipo_documento,numero_documento FROM registro_petroleo where fecha = '$fecha1' and tipo_documento is not null order by fecha desc;"; 
                //echo $query;
                $numero_linea = 0;
                $result = mysqli_query($link, $query);
                /*if ($row = mysqli_fetch_assoc($result) ==0)
                {
                  ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>NO! existen registros con la fecha seleccionada</strong>
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                  <?php  
                }*/
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_registro_petroleo"];
                  $fecha_ = $row["fecha"];
                  $hora_ = $row["hora"];
                  $cantidad_ = $row["cantidad"];
                  $precioxlitro_ = $row["precio_litro"];
                  $tipodocumento_ = $row["tipo_documento"];
                  $numerodocumento_ = $row["numero_documento"];
                  $total_ = ($precioxlitro_ * $cantidad_);
                  $numero_linea += 1;
                ?>
                  <tr>
                    <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='compra_petroleo.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>&fecha1=<?php echo $fecha1; ?>';"><span class="d-block"><i class="far fa-edit" style="color:white;"></i></span></button>
                    </td>
                    <td><?php echo $fecha_; ?></td>
                    <td><?php echo $hora_; ?></td>
                    <td><?php echo "$ ".number_format($cantidad_)." litros"; ?></td>
                    <td><?php echo "$ ".number_format($precioxlitro_); ?></td>
                    <td><?php echo "$ ".number_format($total_); ?></td>
                    <td><?php if ($tipodocumento_ == 1) {
                          echo "Guia de despacho";
                        } else if ($tipodocumento_ == 2) {
                          echo "Factura";
                        } ?></td>
                    <td><?php echo $numerodocumento_; ?></td>
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