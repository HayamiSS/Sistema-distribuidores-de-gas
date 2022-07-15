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

  $edita =1;

  // ************************************************************************
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $id = $_POST["id"];
    $envase2 = $_POST["envase2"];
    $envase5 = $_POST["envase5"];
    $envase11 = $_POST["envase11"];
    $envase15 = $_POST["envase15"];
    $envase45 = $_POST["envase45"];
    $envaseH15a = $_POST["envaseH15a"];
    $envaseH15f = $_POST["envaseH15f"];

    /*if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT * FROM precio_envases;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      /*}
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
      if ($repeated != 1) {*/
        $query = "UPDATE precio_envases SET valor_envase_2=$envase2,valor_envase_5=$envase5,valor_envase_11=$envase11,valor_envase_15=$envase15,valor_envase_45=$envase45,valor_envase_h15_aluminio=$envaseH15a,valor_envase_h15_fierro = $envaseH15f";
        $result = mysqli_query($link, $query);
        $updated = 1;
      }
    //}


    /*// Limpia Variables
    $id = "";
    $nombre = "";
    $activo = "";
    $comision_2 = "";
    $comision_5 = "";
    $comision_11 = "";
    $comision_15 = "";
    $comision_45 = "";
    $comision_H15 = "";
  }*/
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

  $query = "SELECT valor_envase_2,valor_envase_2,valor_envase_5,valor_envase_11,valor_envase_15,valor_envase_45,valor_envase_h15_aluminio,valor_envase_h15_fierro from precio_envases ";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_precio_envases"];
    $envase2 = $row["valor_envase_2"];
    $envase5 = $row["valor_envase_5"];
    $envase11 = $row["valor_envase_11"];
    $envase15 = $row["valor_envase_15"];
    $envase45 = $row["valor_envase_45"];
    $envaseH15a = $row["valor_envase_h15_aluminio"];
    $envaseH15f = $row["valor_envase_h15_fierro"];
  }
  // ************************************************************************
  ?>
  <div class="container">
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
        <div class="card m-5">
          <div class="card-header">
            <h6><i class="fa-solid fa-money-check-dollar-pen"></i> CAMBIO DE LISTADO DE PRECIOS</h6>
          </div>
          <div class="card-body p-0">
            <form name="datos" method="POST" action="cambioPrecios.php" class="was-validated">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="graba" value="<?php echo 1; ?>">
              <? if ($edita == 1) { ?>
                
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
                Actualizar precios
              </button>
              <div class="collapse <? if ($edita == 1) { ?>show<? } ?>" id="collapseExample">
                <div class="card card-body">
                  <div class="form-group">
                    <div class="form-check">
                    <hr>
                      <div class="container-fluid">
                        <hr>
                      <div class="row">
                      <div class="col-md-6 col-sm-12">
                        <h6>Listado de Precios</h6>
                        <hr>
                      <select class="custom-select" multiple size="10" style="scrollbar-3dlight-color: green;">
                        <option selected></option>
                        <option value="1">One one one eon eon eon eon eon oen </option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                        </select>
                        </div>
                        <div class="col-md-3 col-sm-12 align-items-center">
                          <h6>Sube/Baja</h6>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                              Sube
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                            <label class="form-check-label" for="defaultCheck2">
                              Baja
                            </label>
                          </div>
                        </div>

                        <div class="col-md-3 col-sm-12">
                          <h6>Pesos por Kilo</h6>
                          <div class="form-group">
                            <label for="exampleInputEmail1">Pesos por kilo</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                            <small id="emailHelp" class="form-text text-muted">(.decimal)</small>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-12">
                          <p>Seleccione la o las listas de precio a modificar, el tipo de movimiento a efectuar y la cantidad de pesos por kilo.</p>
                          <br>
                          <p><b>Seleccion multiple: </b>para seleccionar varios canales de venta a la vez debe mantener presionada la tecla [Ctrl] y pincharlas con el botón izquierdo del mouse. </p>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Actualizar lista de precios</button>
                        </div>
                      </div>
                    </div>
              </div>
            </form>
            <hr>
            
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