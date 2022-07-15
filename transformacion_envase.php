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
 
  <!-- links para insertar funciones del datatable -->
  <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
  <script src="https://kit.fontawesome.com/6a84b49c1b.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <?php
  include("library/abre_coneccion.php");
  $link = Conectarse();
  ?>
</head>
<body>
<?php
$fechayhora = date("Y-m-d H:i:s");
//echo "fecha y hora:".$fechayhora."<br>";

  
  // SEGURIDAD
 

      //datos para el grafico
      
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
    $id = $_POST["id"];
    $fechayhora = $_POST["fechayhora"];
    $cantidad = $_POST["cantidad"];
    $tipoEnvaseOrigen_ = $_POST["envase_origen"];
    $tipoEnvaseDestino_ = $_POST["envase_destino"];
    $id_chofer = $_POST["id_chofer"];
    if ($id_chofer=="transformacion no asignada a chofer") {$id_chofer=0;}
    $comentarios_ = $_POST["comentarios"];

    if (trim($id) == "")
    {
      $query =  mysqli_query($link, "SELECT fecha_hora FROM transformacion_envases where fecha_hora = $fechayhora;");
      //echo "selecciona regstros no repetidos por la fecha y hora ".$query."<br>";
      $rows = mysqli_num_rows($query);
      if ($rows == 1)
      {
        $repeated = 1;
      }

      if ($repeated != 1)
      {
        $query = "INSERT INTO transformacion_envases (fecha_hora,cantidad,tipo_envase_origen,tipo_envase_destino,id_chofer,comentario_transformacion) VALUES ('$fechayhora',$cantidad,'$tipoEnvaseOrigen_','$tipoEnvaseDestino_',$id_chofer,'$comentarios_')";
        //echo "insercion desde el formulario: ".$query."<br>";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    }
     
    else 
    {
      $query = mysqli_query($link, "SELECT id_transformacion_envases FROM transformacion_envases WHERE id_transformacion_envases!=$id;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated != 1)
      {
        
        $query = "UPDATE transformacion_envases SET cantidad=$cantidad, tipo_envase_origen='$tipoEnvaseOrigen_', tipo_envase_destino = '$tipoEnvaseDestino_', comentario_transformacion = '$comentarios_',id_chofer=$id_chofer WHERE id_transformacion_envases='$id'";
        $result = mysqli_query($link, $query); 
        $updated = 1;
      }
    }
    // Limpia Variables
    $id_descuento="";
    $fecha ="";
    $hora ="";
    $monto ="";
    $motivo ="";
    $activo ="";
    $tipo = "";
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

  $query = "SELECT id_transformacion_envases,fecha_hora,cantidad,tipo_envase_origen,tipo_envase_destino,id_chofer,comentario_transformacion FROM transformacion_envases WHERE id_transformacion_envases='$id'";
  //echo "selecciona registro segun id a editar ".$query."<br>";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_transformacion_envases"];
    $fechayhora = $row["fecha_hora"]; 
    $cantidad = $row["cantidad"];
    $tipoEnvaseOrigen_ = $row["tipo_envase_origen"];
    $tipoEnvaseDestino_ = $row["tipo_envase_destino"];
    $id_chofer = $row["id_chofer"];
    $comentarios_ = $row["comentario_transformacion"];
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
            <h6><i class="fa-solid fa-right-left"></i> TRANSFORMACION DE ENVASES</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="transformacion_envase.php" class="was-validated">
              <input type="hidden" name="fechayhora" value="<?php echo $fechayhora = date("Y-m-d H:i:s");?>">
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
              <div class="collapse <? if ($edita == 1) { ?>show<? }
               ?>" id="collapseExample">
                <div class="card card-body">
                <div class="form-row">
                  <div class="form-group col-2">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad" name="cantidad" value="<?php echo $cantidad;?>" step="1" min="1" max="32267">
                  </div>
                  <div class="form-group col-5">
                    <label>Envase origen</label>
                    <select class="custom-select mr-sm-2" name="envase_origen" id="envase_origen">
                      <option>seleccione...</option>
                      <option value="Envase 2 kilos" <?if ($tipoEnvaseOrigen_ == "Envase 2 kilos") { ?>selected<? }?> ><?php $tipoEnvaseOrigen_; ?> Envase 2 kilos</option>
                      <option value="Envase 5 kilos" <?if ($tipoEnvaseOrigen_ == "Envase 5 kilos") { ?>selected<? }?>><?php $tipoEnvaseOrigen_; ?> Envase 5 kilos</option>
                      <option value="Envase 11 kilos" <?if ($tipoEnvaseOrigen_ == "Envase 11 kilos") { ?>selected<? }?>><?php $tipoEnvaseOrigen_; ?> Envase 11 kilos</option>
                      <option value="Envase 15 kilos" <?if ($tipoEnvaseOrigen_ == "Envase 15 kilos") { ?>selected<? }?>><?php $tipoEnvaseOrigen_; ?> Envase 15 kilos</option>
                      <option value="Envase 45 kilos" <?if ($tipoEnvaseOrigen_ == "Envase 45 kilos") { ?>selected<? }?>><?php $tipoEnvaseOrigen_; ?> Envase 45 kilos</option>
                      <option value="Envase H15 kilos Aluminio" <?if ($tipoEnvaseOrigen_ == "Envase H15 kilos Aluminio") { ?>selected<? }?>><?php $tipoEnvaseOrigen_; ?> Envase H15 kilos Aluminio</option>
                      <option value="Envase H15 kilos Fierro" <?if ($tipoEnvaseOrigen_ == "Envase H15 kilos Fierro") { ?>selected<? }?>><?php $tipoEnvaseOrigen_; ?> Envase H15 kilos Fierro</option>
                    </select> 
                  </div>
                  
                  <div class="form-group col-5">
                    <label>Envase destino</label>
                    <select class="custom-select mr-sm-2" name="envase_destino" id="envase_destino">
                    <option>seleccione...</option>
                      <option value="Envase 2 kilos" <?if ($tipoEnvaseDestino_ == "Envase 2 kilos") { ?>selected<? }?> ><?php $tipoEnvaseDestino_; ?> Envase 2 kilos</option>
                      <option value="Envase 5 kilos" <?if ($tipoEnvaseDestino_ == "Envase 5 kilos") { ?>selected<? }?>><?php $tipoEnvaseDestino_; ?> Envase 5 kilos</option>
                      <option value="Envase 11 kilos" <?if ($tipoEnvaseDestino_ == "Envase 11 kilos") { ?>selected<? }?>><?php $tipoEnvaseDestino_; ?> Envase 11 kilos</option>
                      <option value="Envase 15 kilos" <?if ($tipoEnvaseDestino_ == "Envase 15 kilos") { ?>selected<? }?>><?php $tipoEnvaseDestino_; ?> Envase 15 kilos</option>
                      <option value="Envase 45 kilos" <?if ($tipoEnvaseDestino_ == "Envase 45 kilos") { ?>selected<? }?>><?php $tipoEnvaseDestino_; ?> Envase 45 kilos</option>
                      <option value="Envase H15 kilos Aluminio" <?if ($tipoEnvaseDestino_ == "Envase H15 kilos Aluminio") { ?>selected<? }?>><?php $tipoEnvaseDestino_; ?> Envase H15 kilos Aluminio</option>
                      <option value="Envase H15 kilos Fierro" <?if ($tipoEnvaseDestino_ == "Envase H15 kilos Fierro") { ?>selected<? }?>><?php $tipoEnvaseDestino_; ?> Envase H15 kilos Fierro</option>
                    </select> 
                  </div>
                
                  <div class="form-group col-8 align-items-center">
                    <label>Chofer</label>
                    <select class="custom-select mr-sm-2" name="id_chofer" id="chofer">
                      <option>transformacion no asignada a chofer</option>
                      <?
                      $consu = "SELECT id_chofer, nombre FROM chofer where id_localidad is null and id_canal_venta is null and activo=1 and comisiones_mayorista =0 and cosidera_mayorista_meta =0 and pin_movil is null and autoriza_movil=0 and orden
                      is null and metas_kilos=0 and pago_comision_desde_meta = 0 and pago_comision_desde=1 and comision_peoneta is null and comision_peoneta_45 is null and comision_2 is null and comision_5 is null and comision_11 is null and comision_15 is null and comision_45 is null and comision_h15 is null and comision_peoneta_meta is null and comision_peoneta_45_meta is null and comision_2_meta is null and comision_5_meta is null and comision_11_meta is null and comision_15_meta is null and comision_45_meta is null and comision_h15_meta is null and saldo_historico_rendiciones= 0 and saldo_comisiones_chofer is null and pago_comision_desde_2 is null and comision_2_meta_2 is null and comision_5_meta_2 is null and comision_11_meta_2 is null and comision_15_meta_2 is null and comision_45_meta_2 is null and comision_h15_meta_2 is null and pago_comision_desde_3 is null and comision_2_meta_3 is null and comision_5_meta_3 is null and comision_11_meta_3 is null and comision_15_meta_3 is null and comision_45_meta_3 is null and comision_h15_meta_3 is null and comision_2_mayorista is null and comision_5_mayorista is null and comision_11_mayorista is null and comision_15_mayorista is null and comision_45_mayorista is null and comision_h15_mayorista is null;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_chofer_ = $row["id_chofer"];
                        $nombre_ = $row['nombre'];
                      ?>
                        <option value=<? echo $id_chofer_; ?> <?if ($id_chofer_==$id_chofer){?>selected<?}?>
                        > <? echo $nombre_; ?></option>
                      <?
                      }
                      ?>
                    </select> 
                  </div>

                  <div class="form-group col-12">
                    <label>Comentarios</label>
                    <textarea class="form-control" id="comentarios" name="comentarios" maxlength="255" minlength="0" rows="3" style="resize: both;"><?php echo $comentarios_;?></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary col-12">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
          </div>
            <table class="table table-hover mt-1 col-12 justify-content-center" id="tabla">
                 <thead class="thead-light justify-content-center">
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">
                       <span class="d-none d-md-block">Editar</span>
                       <span class="d-block d-md-none">Edit</span>
                     </th>
                     <th scope="col">Fecha/Hora</th>
                     <th scope="col">Usuario</th>
                     <th scope="col">Cantidad</th>
                     <th scope="col">Origen</th>
                     <th scope="col">Destino</th>
                     <th scope="col">Chofer</th>
                     <th scope="col">Comentarios</th>
                   </tr>
                 </thead>
                 <tbody class="justify-content-center">
                   <?
                    $numero_linea = 0;
                    $query = "SELECT * FROM transformacion_envases where fecha_hora is not null order by fecha_hora desc;";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id_ = $row["id_transformacion_envases"];
                      $id2_ = $row["id_chofer"];
                      $fechayhora_ = $row["fecha_hora"];
                      $cantidad_ = $row["cantidad"];
                      $tipo_envase_origen_ = $row["tipo_envase_origen"];
                      $tipo_envase_destino_ = $row["tipo_envase_destino"];
                      $comentarios_ = $row["comentario_transformacion"];
                      $numero_linea += 1;
                      
                      //query para selecionar el nombre del chofer

                      $numero_linea1 = 0;
                      $query1 = "SELECT nombre from chofer where id_chofer = $id2_";
                      $result1 = mysqli_query($link, $query1);
                      if ($row1 = mysqli_fetch_assoc($result1)) {
                        $nombre_chofer = $row1["nombre"];
                      $numero_linea1 +=1;
                      }
                    ?>
                       <th scope="row"><?php echo $numero_linea ?></th>
                       
                       <td class="text-center">
                      <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='transformacion_envase.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block"><i class="far fa-edit" style="color:white;"></i></span></button>
                    </td>
                       
                       <td><?php echo $fechayhora_; ?></td>
                       <td><?php echo $hora_; ?></td>
                       <td><?php echo $cantidad_; ?></td>
                       <td><?php echo $tipo_envase_origen_; ?></td>
                       <td><?php echo $tipo_envase_destino_; ?></td>
                       <td><?php if ($id2_==0) {echo "No Seleccionado";} else{ echo $nombre_chofer;}  ?></td>
                       <td><?php echo $comentarios_; ?></td>
                     </tr>
                   <?
                    }
                    ?>
                 </tbody>
               </table>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

                    //consulta sql para mostrar graficos
                    
                <?php
                $con = new mysqli("localhost", "root","Eweb02","demo");
                $sql = "Select c.nombre as nombre, SUM(t.cantidad) as cantidad from transformacion_envases t, chofer c where t.id_chofer = c.id_chofer GROUP by c.nombre";
                $res = $con->query($sql); 
                ?>

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Chofer', 'Cantidad de envases transformados'],
          <?php
          while ($fila = $res->fetch_assoc())
          {
              echo "['".$fila["nombre"]."', ".$fila["cantidad"]."],";
          }
          //['Work',     11]
          ?>
        ]);

        var options = {
          title: 'Grafico cantidad de envases transformados a cargos del chofer',
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    
          </div>
          <div id="piechart" style="width: 900px; height: 500px;"></div>
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