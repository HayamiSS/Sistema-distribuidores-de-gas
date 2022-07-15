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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>
<?php

$fechalimite = date("Y-m-d");

$fecha1 = $_POST["fecha1"];
if (trim($fecha1)=="")
{
  $fecha1 = $_GET["fecha1"];
}

if (trim($fecha1) == "")
{
  $fecha1 = date("Y-m-d");
}

$fecha2 = $_POST["fecha2"];
if (trim($fecha2)=="")
{
  $fecha2 = $_GET["fecha2"];
}

if (trim($fecha2) == "")
{
  $fecha2 = date("Y-m-d");
}

  include("library/abre_coneccion.php");
  // SEGURIDAD
  $link = Conectarse();
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
      <div class="col-lg-9 col-xl-10 pb-5 mb-2">

        <!-- BARRA NAVEGACION -->
        <!-- FIN BARRA NAVEGACION -->

        <!-- CONFIGURACION -->
        <div class="card mt-3">
          <div class="card-header">
            <h6><img src="img/report.png" width="35px"></img> INFORMES DEL SISTEMA - PEDIDOS POR MOVIL</h6>
          </div>
          <div class="card-body">
            <hr>
            <div class="text-center">
            <form name="fecha" action="grafico_movil.php" method="POST">
              <div class="form-group row">
              <label class="form-check-label">Fecha inicio</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control" id="fecha1" name="fecha1" value="<?php echo $fecha1;?>" max="<?php echo $fechalimite; ?>">
                </div>
                <label class="form-check-label">Fecha Fin</label>
                <div class="col-sm-3">
                  <input type="date" class="form-control" id="fecha2" name="fecha2" value="<?php echo $fecha2;?>" max="<?php echo $fechalimite; ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="">Filtrar</button>
              </div>
            </form>
            </div>
            
            <!-- INSERTAR GRAFICO DE COLUMNA PARA LA BUSQUEDA DE RANGO DE FECHAS -->
              

              <?php
                $con = new mysqli("localhost", "root", "Eweb02", "demo");
                $query2="SELECT c.nombre as nombre ,SUM(a.cantidad_2 + a.cantidad_5 + a.cantidad_5_catalitico + a.cantidad_11 + a.cantidad_11_catalitico + a.cantidad_15 + a.cantidad_15_catalitico + a.cantidad_45 + a.cantidad_45_catalitico + a.cantidad_h15_aluminio + a.cantidad_h15_fierro) as total_vendidos from pedido_detalle_historico a, pedido_historico b, movil c WHERE c.id_movil = b.id_chofer and estado = 3 and b.id_pedido = a.id_pedido ";
                  if (trim($fecha1)!="--")
                  {
                    $query2=$query2." AND b.fecha_hora_crea>='$fecha1 00:00:01' ";
                  }
                  if (trim($fecha2)!="--")
                  {
                    $query2=$query2." AND b.fecha_hora_crea<='$fecha2 23:59:59' ";
                  }
                  $query2=$query2."GROUP by c.nombre order by c.nombre asc";
                //echo "Query dimensional: $query2.<br>";
                $res2 = $con->query($query2);
              ?>
    <script type="text/javascript">
      google.charts.load('current', {packages:['corechart']});
      google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Movil');
          data.addColumn('number', 'Cilindros entregados');
          data.addRows([
            <?php
              while ($fila2 = $res2->fetch_assoc())
              {
                echo "['".$fila2["nombre"]."', ".$fila2["total_vendidos"]."],";
              }
              //['Work',     11]
              ?>    
          ]);

         var options = {
           title: 'GRAFICO DE BARRA QUE INDICA EL TOTAL DE CILINDROS ENTREGADOS POR MOVIL',
           width: 750,
           height: 500,
           legend: 'none',
           bar: {groupWidth: '70%'},
           vAxis: { gridlines: { count: 5 }, textStyle: {color: 'black'} },
           titleTextStyle: {color: '#004bd6'},
           colors: ['#0e61e4'],
           is3D: true,
           hAxis: { textStyle: {color: '#00159c', fontFamily: 'arial'},
           style:   { fontFamily: 'century gothic' }
                  }
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
         chart.draw(data, options);

         document.getElementById('format-select').onchange = function() {
           options['vAxis']['format'] = this.value;
           chart.draw(data, options);
         };
      };
    </script>
    <div id="number_format_chart" class="justify-content-center align-content-center"></div>
    <table class="table table-hover mt-1 col-12 justify-content-center" id="tabla">
                 <thead class="thead-light justify-content-center">
                    <strong>CUADRO RESUMEN CON TOTAL DE CILINDROS ENTREGADOS MAS CILINDROS DE PEDIDOS ANULADOS</strong>
                   <tr>
                     <th scope="col">Movil</th>
                     <th scope="col">Entregados</th>
                     <th scope="col">Anulados</th>
                     <th scope="col">Total</th>
                   </tr>
                 </thead>
                 <tbody class="justify-content-center">
                   <?
                   
                    $result = mysqli_query($link, $query2);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $nombre = $row["nombre"];
                      $entregados = $row["total_vendidos"];
                      
                      //while para mostrar cantidades de cilindros anulados

                      $queryAnulados = "SELECT c.nombre as nombre ,SUM(a.cantidad_2 +a.cantidad_5 + a.cantidad_5_catalitico + a.cantidad_11 + a.cantidad_11_catalitico + a.cantidad_15 + a.cantidad_15_catalitico + a.cantidad_45 + a.cantidad_45_catalitico + a.cantidad_h15_aluminio + a.cantidad_h15_fierro) as anulados from pedido_detalle_historico a, pedido_historico b, movil c WHERE c.id_movil = b.id_movil and estado = 5 and b.id_pedido = a.id_pedido  and nombre = '$nombre' ";
                      if (trim($fecha1)!="--")
                      {
                        $queryAnulados=$queryAnulados." AND b.fecha_hora_crea>='$fecha1 00:00:01' ";
                      }
                      if (trim($fecha2)!="--")
                      {
                        $queryAnulados=$queryAnulados." AND b.fecha_hora_crea<='$fecha2 23:59:59' ";
                      }
                      $queryAnulados=$queryAnulados."GROUP by c.nombre order by c.nombre asc";
                      //echo "pedidos Anulados - ".$queryAnulados;
                    $resultAnulados = mysqli_query($link, $queryAnulados);
                    if ($rowAnulados = mysqli_fetch_assoc($resultAnulados))
                    {
                      $anulados = $rowAnulados["anulados"];
                    }
                    $total = $entregados + $anulados;
                    $porcentaje = (($anulados * 100) / $total);
                    $totalEntregados = $entregados + $totalEntregados;
                    $totalAnulados = $anulados + $totalAnulados;
                    $totalPorcentaje = $porcentaje + $totalPorcentaje;
                    $totalTotales = $total + $totalTotales;
                    ?>
                       <td><?php echo $nombre; ?></td>
                       <td><?php echo $entregados; ?></td>
                       <td><?php echo $anulados." (". round($porcentaje)."%)"; ?></td>
                       <td><?php echo $total; ?></td>
                    </tr>
                       <?php }  ?>
                     </tr>
                     <tr class="bg-info" style="color: white; font-family: Arial, Helvetica, sans-serif">
                     <td>Totales</td>
                     <td><?php echo $totalEntregados; ?></td>
                     <td><?php echo $totalAnulados." (".round($totalPorcentaje)."%)"; ?></td>
                     <td><?php echo $totalTotales; ?></td>
                     </tr>
                 </tbody>
               </table>
      </div>    
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