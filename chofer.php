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
  $desactivar = $_POST["desactivar"];
  if (trim($desactivar) == "") {
    $desactivar= $_GET["desactivar"];
  }
  $lista_inactivos = $_POST["lista_inactivos"];
  if (trim($lista_inactivos) == "") {
    $lista_inactivos= $_GET["lista_inactivos"];
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
    $id_canal_venta = $_POST["id_canal_venta"];
    $pago_comision_desde_meta = $_POST["pago_comision_desde_meta"];

    if ($id_canal_venta == "seleccione...") {
      $id_canal_venta = 0;
    }

    if ($pago_comision_desde_meta  == "") {
      $pago_comision_desde_meta  = "0";
    }

    $comision_2 = $_POST["comision_2"];
    $comision_2_meta = $_POST["comision_2_meta"];
    $comision_2_meta_2 = $_POST["comision_2_meta_2"];
    $comision_2_meta_3 = $_POST["comision_2_meta_3"];
    $comision_2_mayorista = $_POST["comision_2_mayorista"];

    if ($comision_2  == "") {
      $comision_2  = "0";
    }
    if ($comision_2_meta  == "") {
      $comision_2_meta  = "0";
    }
    if ($comision_2_meta_2  == "") {
      $comision_2_meta_2  = "0";
    }
    if ($comision_2_meta_3  == "") {
      $comision_2_meta_3  = "0";
    }
    if ($comision_2_mayorista  == "") {
      $comision_2_mayorista  = "0";
    }

    $comision_5 = $_POST["comision_5"];
    $comision_5_meta = $_POST["comision_5_meta"];
    $comision_5_meta_2 = $_POST["comision_5_meta_2"];
    $comision_5_meta_3 = $_POST["comision_5_meta_3"];
    $comision_5_mayorista = $_POST["comision_5_mayorista"];

    if ($comision_5  == "") {
      $comision_5  = "0";
    }
    if ($comision_5_meta  == "") {
      $comision_5_meta  = "0";
    }
    if ($comision_5_meta_2  == "") {
      $comision_5_meta_2  = "0";
    }
    if ($comision_5_meta_3  == "") {
      $comision_5_meta_3  = "0";
    }
    if ($comision_5_mayorista  == "") {
      $comision_5_mayorista  = "0";
    }


    $comision_11 = $_POST["comision_11"];
    $comision_11_meta = $_POST["comision_11_meta"];
    $comision_11_meta_2 = $_POST["comision_11_meta_2"];
    $comision_11_meta_3 = $_POST["comision_11_meta_3"];
    $comision_11_mayorista = $_POST["comision_11_mayorista"];

    if ($comision_11  == "") {
      $comision_11  = "0";
    }
    if ($comision_11_meta  == "") {
      $comision_11_meta  = "0";
    }
    if ($comision_11_meta_2  == "") {
      $comision_11_meta_2  = "0";
    }
    if ($comision_11_meta_3  == "") {
      $comision_11_meta_3  = "0";
    }
    if ($comision_11_mayorista  == "") {
      $comision_11_mayorista  = "0";
    }


    $comision_15 = $_POST["comision_15"];
    $comision_15_meta = $_POST["comision_15_meta"];
    $comision_15_meta_2 = $_POST["comision_15_meta_2"];
    $comision_15_meta_3 = $_POST["comision_15_meta_3"];
    $comision_15_mayorista = $_POST["comision_15_mayorista"];

    if ($comision_15  == "") {
      $comision_15  = "0";
    }
    if ($comision_15_meta  == "") {
      $comision_15_meta  = "0";
    }
    if ($comision_15_meta_2  == "") {
      $comision_15_meta_2  = "0";
    }
    if ($comision_15_meta_3  == "") {
      $comision_15_meta_3  = "0";
    }
    if ($comision_15_mayorista  == "") {
      $comision_15_mayorista  = "0";
    }


    $comision_45 = $_POST["comision_45"];
    $comision_45_meta = $_POST["comision_45_meta"];
    $comision_45_meta_2 = $_POST["comision_45_meta_2"];
    $comision_45_meta_3 = $_POST["comision_45_meta_3"];
    $comision_45_mayorista = $_POST["comision_45_mayorista"];

    if ($comision_45  == "") {
      $comision_45  = "0";
    }
    if ($comision_45_meta  == "") {
      $comision_45_meta  = "0";
    }
    if ($comision_45_meta_2  == "") {
      $comision_45_meta_2  = "0";
    }
    if ($comision_45_meta_3  == "") {
      $comision_45_meta_3  = "0";
    }
    if ($comision_45_mayorista  == "") {
      $comision_45_mayorista  = "0";
    }


    $comision_h15 = $_POST["comision_h15"];
    $comision_h15_meta = $_POST["comision_h15_meta"];
    $comision_h15_meta_2 = $_POST["comision_h15_meta_2"];
    $comision_h15_meta_3 = $_POST["comision_h15_meta_3"];
    $comision_h15_mayorista = $_POST["comision_h15_mayorista"];

    if ($comision_h15  == "") {
      $comision_h15  = "0";
    }
    if ($comision_h15_meta  == "") {
      $comision_h15_meta  = "0";
    }
    if ($comision_h15_meta_2  == "") {
      $comision_h15_meta_2  = "0";
    }
    if ($comision_h15_meta_3  == "") {
      $comision_h15_meta_3  = "0";
    }
    if ($comision_h15_mayorista  == "") {
      $comision_h15_mayorista  = "0";
    }

    $metas_kilos = $_POST["metas_kilos"];

    if ($metas_kilos  == "") {
      $metas_kilos  = "0";
    }

    $pago_comision_desde = $_POST["pago_comision_desde"];
    $pago_comision_desde_2 = $_POST["pago_comision_desde_2"];
    $pago_comision_desde_3 = $_POST["pago_comision_desde_3"];

    if ($pago_comision_desde  == "") {
      $pago_comision_desde = "0";
    }
    if ($pago_comision_desde_2  == "") {
      $pago_comision_desde_2  = "0";
    }
    if ($pago_comision_desde_3  == "") {
      $pago_comision_desde_3  = "0";
    }

    $comisiones_mayorista = $_POST["comisiones_mayorista"];
    $cosidera_mayorista_meta = $_POST["cosidera_mayorista_meta"];

    if ($comisiones_mayorista  == "") {
      $comisiones_mayorista  = "0";
    }
    if ($cosidera_mayorista_meta  == "") {
      $cosidera_mayorista_meta  = "0";
    }
 // Variables POST


    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT nombre FROM chofer WHERE nombre = '$nombre';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
         // insertar
        $query = "INSERT INTO chofer (id_canal_venta ,metas_kilos, nombre , pago_comision_desde , pago_comision_desde_meta , comision_2 , comision_5 ,  comision_11 , comision_15 , comision_45 , comision_h15 , comision_2_meta , comision_5_meta , comision_11_meta , comision_15_meta ,  comision_45_meta , comision_h15_meta , pago_comision_desde_2 , comision_2_meta_2 , comision_5_meta_2 , comision_11_meta_2 ,  comision_15_meta_2 , comision_45_meta_2 , comision_h15_meta_2 , pago_comision_desde_3 , comision_2_meta_3 , comision_5_meta_3 , comision_11_meta_3 , comision_15_meta_3 , comision_45_meta_3 , comision_h15_meta_3 , comision_2_mayorista , comision_5_mayorista , comision_11_mayorista , comision_15_mayorista , comision_45_mayorista , comision_h15_mayorista , comisiones_mayorista , cosidera_mayorista_meta) VALUES ('$id_canal_venta' ,'$metas_kilos', '$nombre' , $pago_comision_desde , $pago_comision_desde_meta, $comision_2 , $comision_5 , $comision_11 , $comision_15 , $comision_45 , $comision_h15 , $comision_2_meta , $comision_5_meta , $comision_11_meta , $comision_15_meta , $comision_45_meta , $comision_h15_meta , $pago_comision_desde_2 , $comision_2_meta_2 , $comision_5_meta_2 , $comision_11_meta_2 , $comision_15_meta_2 , $comision_45_meta_2 , $comision_h15_meta_2 , $pago_comision_desde_3 , $comision_2_meta_3 , $comision_5_meta_3 , $comision_11_meta_3 , $comision_15_meta_3 , $comision_45_meta_3 , $comision_h15_meta_3 , $comision_2_mayorista , $comision_5_mayorista , $comision_11_mayorista , $comision_15_mayorista , $comision_45_mayorista , $comision_h15_mayorista , $comisiones_mayorista , $cosidera_mayorista_meta )";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    } else {
      $query = mysqli_query($link, "SELECT nombre FROM chofer WHERE id_chofer!=$id AND nombre = '$nombre';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
          // editar
        $query = "UPDATE chofer SET nombre = '$nombre',metas_kilos = '$metas_kilos', id_canal_venta = '$id_canal_venta', pago_comision_desde = '$pago_comision_desde',pago_comision_desde_meta = '$pago_comision_desde_meta',comision_2 = '$comision_2',comision_5 = '$comision_5',comision_11 = '$comision_11',comision_15 = '$comision_15',comision_45 = '$comision_45',comision_h15 = '$comision_h15',comision_2_meta = '$comision_2_meta',comision_5_meta = '$comision_5_meta',comision_11_meta = '$comision_11_meta',comision_15_meta = '$comision_15_meta',comision_45_meta = '$comision_45_meta',comision_h15_meta = '$comision_h15_meta',pago_comision_desde_2 = '$pago_comision_desde_2',comision_2_meta_2 = '$comision_2_meta_2',comision_5_meta_2 = '$comision_5_meta_2',comision_11_meta_2 = '$comision_11_meta_2',comision_15_meta_2 = '$comision_15_meta_2',comision_45_meta_2 = '$comision_45_meta_2',comision_h15_meta_2 = '$comision_h15_meta_2',pago_comision_desde_3 = '$pago_comision_desde_3',comision_2_meta_3 = '$comision_2_meta_3',comision_5_meta_3 = '$comision_5_meta_3',comision_11_meta_3 = '$comision_11_meta_3',comision_15_meta_3 = '$comision_15_meta_3',comision_45_meta_3 = '$comision_45_meta_3',comision_h15_meta_3 = '$comision_h15_meta_3',comision_2_mayorista = '$comision_2_mayorista',comision_5_mayorista = '$comision_5_mayorista',comision_11_mayorista = '$comision_11_mayorista',comision_15_mayorista = '$comision_15_mayorista',comision_45_mayorista = '$comision_45_mayorista',comision_h15_mayorista = '$comision_h15_mayorista',comisiones_mayorista = '$comisiones_mayorista',cosidera_mayorista_meta = '$cosidera_mayorista_meta'WHERE id_chofer=$id";
        $result = mysqli_query($link, $query);
        $updated = 1;


      }

     
    }
    // Limpia Variables

    $id= "";
    $nombre = "";
    $id_canal_venta = "";
    $pago_comision_desde_meta = "";

    $comision_2 = "";
    $comision_2_meta = "";
    $comision_2_meta_2 = "";
    $comision_2_meta_3 = "";
    $comision_2_mayorista = "";

    $comision_5 = "";
    $comision_5_meta = "";
    $comision_5_meta_2 = "";
    $comision_5_meta_3 = "";
    $comision_5_mayorista = "";

    $comision_11 = "";
    $comision_11_meta = "";
    $comision_11_meta_2 = "";
    $comision_11_meta_3 = "";
    $comision_11_mayorista = "";

    $comision_15 = "";
    $comision_15_meta = "";
    $comision_15_meta_2 ="";
    $comision_15_meta_3 = "";
    $comision_15_mayorista = "";

    $comision_45 = "";
    $comision_45_meta = "";
    $comision_45_meta_2 = "";
    $comision_45_meta_3 = "";
    $comision_45_mayorista = "";

    $comision_h15 = "";
    $comision_h15_meta = "";
    $comision_h15_meta_2 = "";
    $comision_h15_meta_3 = "";
    $comision_h15_mayorista = "";

    $metas_kilos = "";

    $pago_comision_desde = "";
    $pago_comision_desde_2 = "";
    $pago_comision_desde_3 = "";

    $comisiones_mayorista = "";
    $cosidera_mayorista_meta = "";

     // Limpia Variables
  }
  // ************************************************************************
  //  desactivar / activar conductor  
  // ************************************************************************
  if ($desactivar == 1) {

    $query = "SELECT activo FROM `chofer` WHERE id_chofer=$id";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) 
    {
      $valor_ = $row["activo"];
    }

    if ($valor_ == 1) {$valor_=0;} else {$valor_=1;}
   
    $query = "UPDATE chofer SET activo = $valor_ WHERE id_chofer=$id";
    $result = mysqli_query($link, $query);
    $updated = 1;

    $id = "";
  }

  // 

  // ************************************************************************
  //  ELIMINA REGISTRO  
  // ************************************************************************
  if ($elimina == 1) {
    $query = "DELETE FROM chofer WHERE id_chofer=$id";
    $result = mysqli_query($link, $query);
    $delete = 1;
    $id = "";
  }
  // ************************************************************************
  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************

  $query = "SELECT id_chofer,id_canal_venta , nombre , pago_comision_desde , pago_comision_desde_meta ,metas_kilos, comision_2 , comision_5 ,  comision_11 , comision_15 , comision_45 , comision_h15 , comision_2_meta , comision_5_meta , comision_11_meta , comision_15_meta ,  comision_45_meta , comision_h15_meta , pago_comision_desde_2 , comision_2_meta_2 , comision_5_meta_2 , comision_11_meta_2 ,  comision_15_meta_2 , comision_45_meta_2 , comision_h15_meta_2 , pago_comision_desde_3 , comision_2_meta_3 , comision_5_meta_3 , comision_11_meta_3 , comision_15_meta_3 , comision_45_meta_3 , comision_h15_meta_3 , comision_2_mayorista , comision_5_mayorista , comision_11_mayorista , comision_15_mayorista , comision_45_mayorista , comision_h15_mayorista , comisiones_mayorista , cosidera_mayorista_meta FROM chofer WHERE id_chofer='$id'";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id= $row["id_chofer"];
    $nombre = $row["nombre"];
    $id_canal_venta = $row["id_canal_venta"];
    $pago_comision_desde_meta = $row["pago_comision_desde_meta"];
    $metas_kilos = $row["metas_kilos"];

    $comision_2 = $row["comision_2"];
    $comision_2_meta = $row["comision_2_meta"];
    $comision_2_meta_2 = $row["comision_2_meta_2"];
    $comision_2_meta_3 = $row["comision_2_meta_3"];
    $comision_2_mayorista = $row["comision_2_mayorista"];

    $comision_5 = $row["comision_5"];
    $comision_5_meta = $row["comision_5_meta"];
    $comision_5_meta_2 = $row["comision_5_meta_2"];
    $comision_5_meta_3 = $row["comision_5_meta_3"];
    $comision_5_mayorista = $row["comision_5_mayorista"];

    $comision_11 = $row["comision_11"];
    $comision_11_meta = $row["comision_11_meta"];
    $comision_11_meta_2 = $row["comision_11_meta_2"];
    $comision_11_meta_3 = $row["comision_11_meta_3"];
    $comision_11_mayorista = $row["comision_11_mayorista"];

    $comision_15 = $row["comision_15"];
    $comision_15_meta = $row["comision_15_meta"];
    $comision_15_meta_2 = $row["comision_15_meta_2"];
    $comision_15_meta_3 = $row["comision_15_meta_3"];
    $comision_15_mayorista = $row["comision_15_mayorista"];

    $comision_45 = $row["comision_45"];
    $comision_45_meta = $row["comision_45_meta"];
    $comision_45_meta_2 = $row["comision_45_meta_2"];
    $comision_45_meta_3 = $row["comision_45_meta_3"];
    $comision_45_mayorista = $row["comision_45_mayorista"];

    $comision_h15 = $row["comision_h15"];
    $comision_h15_meta = $row["comision_h15_meta"];
    $comision_h15_meta_2 = $row["comision_h15_meta_2"];
    $comision_h15_meta_3 = $row["comision_h15_meta_3"];
    $comision_h15_mayorista = $row["comision_h15_mayorista"];

    $metas_kilos = $row["metas_kilos"];

    $pago_comision_desde = $row["pago_comision_desde"];
    $pago_comision_desde_2 = $row["pago_comision_desde_2"];
    $pago_comision_desde_3 = $row["pago_comision_desde_3"];

    $comisiones_mayorista = $row["comisiones_mayorista"];
    $cosidera_mayorista_meta = $row["cosidera_mayorista_meta"];
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
            <h6><i class="fa-solid fa-truck"></i> Crear Chofer
            </h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="chofer.php" class="was-validated">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="graba" value="<?php echo 1; ?>">
              <input type="hidden" name="lista_inactivos" value="<?php echo $lista_inactivos; ?>">
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
                    <small id="texto_nombre" class="form-text text-muted">El nombre debe hacer referencia a la Comuna/ciudad a donde se realizan despachos de pedidos telef&oacute;nicos</small>

                    <label for="nombre">Lista de precios :</label>
                    <br>
                    <select class="custom-select mr-sm-2 w-25" id="inlineFormCustomSelect" name="id_canal_venta">
                      <option>seleccione...</option>
                      <?
                      $consu = "SELECT id_lista_precios,nombre FROM lista_precios;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_lista_precios_ = $row['id_lista_precios'];
                        $nombre_ = $row['nombre'];
                      ?>
                        <option <? if ($id_canal_venta == $id_lista_precios_) { ?>selected<? } ?> value=<? echo $id_lista_precios_; ?>> <? echo $nombre_; ?></option>;
                      <?
                      }
                      ?>
                    </select>

                    <hr width="100%" size="1">

                    <div class="form-check mt-3 mb-3 ">
                      <input class="form-check-input" type="checkbox" name="pago_comision_desde_meta" id="pago_comision_desde_meta" value="1" id="defaultCheck1" <? if ($pago_comision_desde_meta  == "1") { ?>checked<? } ?>>
                      <p><small> Pago de comisiones desde la <strong>Meta</strong> en adelante, esto quiere decir que las ventas realizadas antes de cumplir la <strong>Meta</strong> no ser&aacute;n pagadas.</small></p>
                    </div>

                    <!------------------------------------------ ENCABEZADO COMISIONES ----------------------------------------->
                    <table class="table table-hover mt-1 table-sm mt-3 mb-3 ">
                      <tr>
                        <td scope="col" class="text-center">
                        </td>
                        <td scope="col" class="text-center">
                          <small>COMISION</small>
                        </td>
                        <td scope="col" class="text-center">
                          <small>META</small>
                        </td>
                        <td scope="col" class="text-center">
                          <small>META 2</small>
                        </td>
                        <td scope="col" class="text-center">
                          <small>META 3</small>
                        </td>
                        <td scope="col" class="text-center">
                          <small>MAYORISTA(*)</small>
                        </td>
                      <tr>
                        <!------------------------------------------ ENCABEZADO COMISIONES -------------------------------------->
                        <!------------------------------------------ COMISION 2 ------------------------------------------>
                      <tr>
                        <td scope="col" class="text-center"> <small>Cilindro 2:</small>
                        </td>
                        <td scope="col" class="text-center table-primary">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_2" value="<?php echo $comision_2 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_2_meta" value="<?php echo $comision_2_meta ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_2_meta_2" value="<?php echo $comision_2_meta_2 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_2_meta_3" value="<?php echo $comision_2_meta_3 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-danger">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_2_mayorista" value="<?php echo $comision_2_mayorista ?>" maxlength="50">
                          </div>
                        </td>
                      <tr>
                        <!------------------------------------------ COMISION 2 ------------------------------------------>
                        <!------------------------------------------ COMISION 5 ------------------------------------------>
                      <tr>
                        <td scope="col" class="text-center"> <small> Cilindro 5:</small>
                        </td>

                        <td scope="col" class="text-center table-primary">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_5" value="<?php echo $comision_5 ?>" maxlength="50">
                          </div>

                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_5_meta" value="<?php echo $comision_5_meta ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_5_meta_2" value="<?php echo $comision_5_meta_2 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_5_meta_3" value="<?php echo $comision_5_meta_3 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-danger">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_5_mayorista" value="<?php echo $comision_5_mayorista ?>" maxlength="50">
                          </div>
                        </td>
                      <tr>
                        <!------------------------------------------ COMISION 5 ------------------------------------------>
                        <!------------------------------------------ COMISION 11 ------------------------------------------>
                      <tr>
                        <td scope="col" class="text-center"> <small> Cilindro 11:</small>
                        </td>

                        <td scope="col" class="text-center table-primary">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_11" value="<?php echo  $comision_11 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_11_meta" value="<?php echo $comision_11_meta ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_11_meta_2" value="<?php echo $comision_11_meta_2 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_11_meta_3" value="<?php echo $comision_11_meta_3 ?>" maxlength="50">
                        </td>

                        <td scope="col" class="text-center table-danger">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_11_mayorista" value="<?php echo $comision_11_mayorista ?>" maxlength="50">
                        </td>
                      <tr>
                        <!------------------------------------------ COMISION 11 ------------------------------------------->
                        <!------------------------------------------ COMISION 15 ------------------------------------------>
                      <tr>
                        <td scope="col" class="text-center"> <small> Cilindro 15:</small>
                        </td>

                        <td scope="col" class="text-center table-primary">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_15" value="<?php echo $comision_15 ?>" maxlength="50">
                          </div>

                        </td>

                        <td scope="col" class="text-center table-warning ">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_15_meta" value="<?php echo $comision_15_meta ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_15_meta_2" value="<?php echo $comision_15_meta_2 ?>" maxlength="50">
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_15_meta_3" value="<?php echo $comision_15_meta_3 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-danger">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_15_mayorista" value="<?php echo $comision_15_mayorista ?>" maxlength="50">
                        </td>
                      <tr>
                        <!------------------------------------------ COMISION 15 ------------------------------------------>
                        <!------------------------------------------ COMISION 45 ------------------------------------------>
                      <tr>
                        <td scope="col" class="text-center"> <small> Cilindro 45:</small>
                        </td>

                        <td scope="col" class="text-center table-primary">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_45" value="<?php echo $comision_45 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_45_meta" value="<?php echo $comision_45_meta ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_45_meta_2" value="<?php echo $comision_45_meta_2 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_45_meta_3" value="<?php echo $comision_45_meta_3 ?>" maxlength="50">
                          </div>
                        </td>

                        <td scope="col" class="text-center table-danger">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_45_mayorista" value="<?php echo $comision_45_mayorista ?>" maxlength="50">
                          </div>
                        </td>
                      <tr>
                        <!------------------------------------------ COMISION 45 ------------------------------------------>
                        <!------------------------------------------ COMISION H15 ------------------------------------------>
                      <tr>
                        <td scope="col" class="text-center"> <small> Cilindro H15:</small>
                        </td>

                        <td scope="col" class="text-center table-primary">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_h15" value="<?php echo $comision_h15 ?>" maxlength="50">
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_h15_meta" value="<?php echo $comision_h15_meta ?>" maxlength="50">
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_h15_meta_2" value="<?php echo $comision_h15_meta_2 ?>" maxlength="50">
                        </td>

                        <td scope="col" class="text-center table-warning">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_h15_meta_3" value="<?php echo $comision_h15_meta_3 ?>" maxlength="50">
                        </td>

                        <td scope="col" class="text-center table-danger">
                          <div class="input-group input-group-sm ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">$</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="comision_h15_mayorista" value="<?php echo $comision_h15_mayorista ?>" maxlength="50">
                        </td>
                      <tr>
                        <!------------------------------------------ COMISION H15 ------------------------------------------>
                    </table>
                    <hr>
                    <!------------------------------------------ ENCABEZADO COMISIONES ----------------------------------------->
                    <!------------------------------------------ METAS ------------------------------------------>
                    <table class="table table-hover mt-1 table-sm mt-3 mb-3 table-info">
                      <tr>
                        <td>
                          <p><small>METAS POR:</small></p>
                        </td>
                        <td>
                          <input type="radio" name="metas_kilos" value="0"
                          <? if ($metas_kilos  == "0") { ?>checked=""<? }echo $metas_kilos; ?>>
                          <small>UNIDADES</small>
                          &nbsp;&nbsp;
                          <input type="radio" name="metas_kilos" value="1"
                          <? if ($metas_kilos  == "1") {?>checked=""<? } ?>>
                          <small>KILOS</small>

                          <samp> <small>(Solo para metas)</small></samp>
                        </td>
                      </tr>
                      <tr class="table-secondary">
                        <td>
                          <small>Pago de Comisiones seg&uacute;n <b>META</small></b>
                        </td>
                        <td>

                          <div class="input-group input-group-sm w-25">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">desde</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="pago_comision_desde" value="<?php echo $pago_comision_desde ?>" maxlength="50">
                        </td>
                      </tr>
                      <tr class="table-secondary">
                        <td>
                          <small>Pago de Comisiones seg&uacute;n <b>META 2</b></small>
                        </td>
                        <td>
                          <div class="input-group input-group-sm w-25 ">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">desde</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="pago_comision_desde_2" value="<?php echo $pago_comision_desde_2 ?>" maxlength="50">
                        </td>
                      </tr>
                      <tr class="table-secondary">
                        <td>
                          <small>Pago de Comisiones seg&uacute;n <b>META 3</b></small>
                        </td>
                        <td>
                          <div class="input-group input-group-sm w-25">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="inputGroup-sizing-sm">desde</span>
                            </div>
                            <input type="number" class="form-control w-25" min="0" step="1" aria-label="Small" id="comision_2" aria-describedby="inputGroup-sizing-sm" name="pago_comision_desde_3" value="<?php echo $pago_comision_desde_3 ?>" maxlength="50">
                        </td>
                      </tr>
                      <tr>
                        <td colspan="2" align="center">
                          <small>(Cero o Vacio no toma este parametro para c&aacute;lculo de comisiones)</small>
                        </td>
                      </tr>
                    </table>

                    <!------------------------------------------ METAS ------------------------------------------>

                    <hr>
                    <p> <small>La Comisi&oacute;n a ingresar por formarto de cilindro debe ser del total de la unidad, eso quiere decir que si el pago se realiza por kilos y no unidades, se debe multiplicar el total de kilos de ese formato por el valor de la comisi&oacute;n por kilo y eso ingresarlo como comisi&oacute;n (Ej: formato: 11kg y comisi&oacute;n por kilo 50 pesos, total comisi&oacute;n 11x5=550)</small> </p>
                    <i> <small>(*) Establece el valor de la comisi&oacute;n cuando el chofer es el que despacha los cilindros al cliente mayorista y recibe una comisi&oacute;n por ello.</small> </i>
                    <br>
                    <br>
                    <input type="checkbox" name="comisiones_mayorista" value="1" <? if ( $comisiones_mayorista  == "1") { ?>checked<? } ?>>
                    <small>Fija las mismas comisiones de despacho a <b>Clientes Mayoristas</b> como de venta a <b>Cliente Final</b></small>
                    <br>
                    <input type="checkbox" name="cosidera_mayorista_meta" value="1" <? if ($cosidera_mayorista_meta  == "1") { ?>checked<? } ?>>
                    <small>Considera los despachos realizados a <b>Clientes Mayoristas</b> para ser sumado a las ventas de <b>Cliente Final</b> como total en las <b>METAS</b>.</small>
                  </div>

                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>

            <? if ($lista_inactivos  == "0") { ?>
              <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="Check" onclick="javascript:window.location.href='chofer.php?lista_inactivos=1';" <? if ($lista_inactivos == 1) { ?>checked<? } ?>>
                        <label class="custom-control-label" for="Check">Lista Choferes Desactivados</label>
                      </div>  
            <? }else{ ?>
              <div class="custom-control custom-switch">
                        <input type="checkbox" class="custom-control-input" id="Check" onclick="javascript:window.location.href='chofer.php?lista_inactivos=0';" <? if ($lista_inactivos == 1) { ?>checked<? } ?>>
                        <label class="custom-control-label" for="Check">Lista Choferes Desactivados</label>
                      </div>
              <? } ?>    

          

            <table class="table table-hover mt-1">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Edit
                  </th>
                  <th scope="col"> Estado
                  </th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Lista Precios</th>
                  <th scope="col">Comisi&oacute;n 2</th>
                  <th scope="col">Comisi&oacute;n 5</th>
                  <th scope="col">Comisi&oacute;n 11</th>
                  <th scope="col">Comisi&oacute;n 15</th>
                  <th scope="col">Comisi&oacute;n 45 </th>
                  <th scope="col">Comisi&oacute;n H15</th>

              </thead>
              <tbody>
                <?

                if($lista_inactivos == 1){

                $query = "SELECT `id_chofer`, `id_canal_venta`, `activo`, `nombre`, `pago_comision_desde`, `comision_2`, `comision_5`, `comision_11`, `comision_15`, `comision_45`, `comision_h15`, `comision_2_meta`, `comision_5_meta`, `comision_11_meta`, `comision_15_meta`, `comision_45_meta`, `comision_h15_meta`, `pago_comision_desde_2`, `comision_2_meta_2`, `comision_5_meta_2`, `comision_11_meta_2`, `comision_15_meta_2`, `comision_45_meta_2`, `comision_h15_meta_2`, `pago_comision_desde_3`, `comision_2_meta_3`, `comision_5_meta_3`, `comision_11_meta_3`, `comision_15_meta_3`, `comision_45_meta_3`, `comision_h15_meta_3`, `comision_2_mayorista`, `comision_5_mayorista`, `comision_11_mayorista`, `comision_15_mayorista`, `comision_45_mayorista`, `comision_h15_mayorista` FROM `chofer` ORDER BY 'nombre'";
                $result = mysqli_query($link, $query);

              }else{

                $query = "SELECT `id_chofer`, `id_canal_venta`, `activo`, `nombre`, `pago_comision_desde`, `comision_2`, `comision_5`, `comision_11`, `comision_15`, `comision_45`, `comision_h15`, `comision_2_meta`, `comision_5_meta`, `comision_11_meta`, `comision_15_meta`, `comision_45_meta`, `comision_h15_meta`, `pago_comision_desde_2`, `comision_2_meta_2`, `comision_5_meta_2`, `comision_11_meta_2`, `comision_15_meta_2`, `comision_45_meta_2`, `comision_h15_meta_2`, `pago_comision_desde_3`, `comision_2_meta_3`, `comision_5_meta_3`, `comision_11_meta_3`, `comision_15_meta_3`, `comision_45_meta_3`, `comision_h15_meta_3`, `comision_2_mayorista`, `comision_5_mayorista`, `comision_11_mayorista`, `comision_15_mayorista`, `comision_45_mayorista`, `comision_h15_mayorista` FROM `chofer` where activo = 1  ORDER BY 'nombre'";
                $result = mysqli_query($link, $query);

              }
                while ($row = mysqli_fetch_assoc($result)) {
                  $id_ = $row["id_chofer"];
                  $nombre_ = $row["nombre"];
                  $activo_ = $row["activo"];
                  $id_canal_venta_ = $row["id_canal_venta"];


                  $pago_comision_desde_ = $row["pago_comision_desde"];
                  $pago_comision_desde_2_ = $row["pago_comision_desde_2"];
                  $pago_comision_desde_3_ = $row["pago_comision_desde_3"];

                  $comision_2_ = $row["comision_2"];
                  $comision_2_meta_ = $row["comision_2_meta"];
                  $comision_2_meta_2_ = $row["comision_2_meta_2"];
                  $comision_2_meta_3_ = $row["comision_2_meta_3"];
                  $comision_2_mayorista_ = $row["comision_2_mayorista"];

                  $comision_5_ = $row["comision_5"];
                  $comision_5_meta_ = $row["comision_5_meta"];
                  $comision_5_meta_2_ = $row["comision_5_meta_2"];
                  $comision_5_meta_3_ = $row["comision_5_meta_3"];
                  $comision_5_mayorista_ = $row["comision_5_mayorista"];

                  $comision_11_ = $row["comision_11"];
                  $comision_11_meta_ = $row["comision_11_meta"];
                  $comision_11_meta_2_ = $row["comision_11_meta_2"];
                  $comision_11_meta_3_ = $row["comision_11_meta_3"];
                  $comision_11_mayorista_ = $row["comision_11_mayorista"];

                  $comision_15_ = $row["comision_15"];
                  $comision_15_meta_ = $row["comision_15_meta"];
                  $comision_15_meta_2_ = $row["comision_15_meta_2"];
                  $comision_15_meta_3_ = $row["comision_15_meta_3"];
                  $comision_15_mayorista_ = $row["comision_15_mayorista"];

                  $comision_45_ = $row["comision_45"];
                  $comision_45_meta_ = $row["comision_45_meta"];
                  $comision_45_meta_2_ = $row["comision_45_meta_2"];
                  $comision_45_meta_3_ = $row["comision_45_meta_3"];
                  $comision_45_mayorista_ = $row["comision_45_mayorista"];

                  $comision_h15_ = $row["comision_h15"];
                  $comision_h15_meta_ = $row["comision_h15_meta"];
                  $comision_h15_meta_2_ = $row["comision_h15_meta_2"];
                  $comision_h15_meta_3_ = $row["comision_h15_meta_3"];
                  $comision_h15_mayorista_ = $row["comision_h15_mayorista"];

                

                ?>
                   <?if($activo_ == 1){?><tr class="table-primary"> <?}else{?><tr class="table-danger"> <?}?>

                    <td class="text-center ">
                      <button type="button" <?if($activo_ == 0){?> disabled <?}?>class="btn btn-sm btn-primary" onclick="javascript:window.location.href='chofer.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>&lista_inactivos=<?php echo $lista_inactivos ?>';"><span class="d-block"><i class="far fa-edit" style="color:white;"></i></span></button>
                    </td>
                    <? if ($activo_ == 0)  {?>

                    <td class="text-center ">
                      <!-- Button modal REGISTRO -->
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal<?php echo $id_ ?>"><span class="d-block">
                      Des <i class="far fa-times-circle" style="color:white;"></i></span>
                      </button>
                      <!-- Modal desactivar -->
                      <div class="modal fade" id="Modal<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Desactivar Chofer</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" id="modal-body">
                              Esta seguro que desea activar a <strong><?php echo $nombre_ ?></strong>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-success" onclick="javascript:window.location.href='chofer.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>&lista_inactivos=<?php echo $lista_inactivos ?>';">Activar <i class="far fa-check-circle" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                    </td>

                    <? }else if ($activo_ == 1) {?>

                      <td class="text-center ">
                      <!-- Button modal REGISTRO -->
                      <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal<?php echo $id_ ?>"><span class="d-block">
                      Act <i class="far fa-check-circle" style="color:white;"></i></span>
                      </button>
                      <!-- Modal activar -->
                      <div class="modal fade" id="Modal<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="ModalLabel">Activar Chofer</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body" id="modal-body">
                              Esta seguro que desea desactivar a <strong><?php echo $nombre_ ?></strong> 
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='chofer.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>&lista_inactivos=<?php echo $lista_inactivos ?>';">Desactivar <i class="far fa-times-circle" style="color:white;"></i></button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Fin Modal -->
                    </td>
                    <? }?>

                    <td><?php echo $nombre_ ?></td>
                    <td><?php

                        $query2 = "SELECT nombre as n FROM lista_precios where id_lista_precios = $id_canal_venta_ ";
                        $result2 = mysqli_query($link, $query2);
                        $row2 = mysqli_fetch_assoc($result2);
                        $nombre_venta = $row2["n"];

                        echo $nombre_venta;

                        ?></td>
                    <td><?php echo "$" . number_format($comision_2_)  ?></td>
                    <td><?php echo "$" . number_format($comision_5_)?></td>
                    <td><?php echo "$" . number_format($comision_11_) ?></td>
                    <td><?php echo "$" . number_format($comision_15_) ?></td>
                    <td><?php echo "$" . number_format($comision_45_) ?></td>
                    <td><?php echo "$" . number_format($comision_h15_) ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="table-secondary"><?php echo "META DESDE $pago_comision_desde_ Un " ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_2_meta_)?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_5_meta_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_11_meta_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_15_meta_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_45_meta_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_h15_meta_) ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="table-secondary"><?php echo "META DESDE $pago_comision_desde_2_ Un " ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_2_meta_2_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_5_meta_2_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_11_meta_2_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_15_meta_2_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_45_meta_2_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_h15_meta_2_) ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="table-secondary"><?php echo "META DESDE $pago_comision_desde_3_ Un " ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_2_meta_3_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_5_meta_3_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_11_meta_3_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_15_meta_3_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_45_meta_3_) ?></td>
                    <td class="table-warning"><?php echo "$" . number_format($comision_h15_meta_3_) ?></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="table-danger"><?php echo "COMISION MAYORISTA" ?></td>
                    <td class="table-danger"><?php echo "$" . number_format($comision_2_mayorista_) ?></td>
                    <td class="table-danger"><?php echo "$" . number_format($comision_5_mayorista_) ?></td>
                    <td class="table-danger"><?php echo "$" . number_format($comision_11_mayorista_) ?></td>
                    <td class="table-danger"><?php echo "$" . number_format($comision_15_mayorista_) ?></td>
                    <td class="table-danger"><?php echo "$" . number_format($comision_45_mayorista_) ?></td>
                    <td class="table-danger"><?php echo "$" . number_format($comision_h15_mayorista_) ?></td>
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