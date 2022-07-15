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

$mes = $_POST["mes"];
$año = $_POST["año"];
if (trim($mes)=="")
{
  $mes = $_GET["mes"];
}
/*if (trim($año)=="")
{
  $año = $_GET["año"];
}*/
$dias = cal_days_in_month(CAL_MONTH_GREGORIAN_SHORT, $mes, $año);
echo "El mes : $mes del $año tiene $dias dias";

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
            <h6><img src="img/report.png" width="35px"></img> INFORMES DEL SISTEMA - CUADRO RESUMEN MENSUAL (PEDIDOS TELEFONICOS)</h6>
          </div>
          <div class="card-body">
            <hr>
            <div class="text-center">
            <form name="fecha" action="cuadro_resumen_pedidos.php" method="POST">
            <div class="form-check-inline col-4">
                    <label class="form-check-label">Mes</label>
                    <select class="custom-select mr-sm-2" name="mes" id="mes">
                      <option>seleccione...</option>
                      <option value= "01" <?if ($mes == "01") { ?>selected<? }?> ><?php $mes; ?> Enero</option>
                      <option value="02" <?if ($mes == "02") { ?>selected<? }?>><?php $mes; ?> Febrero</option>
                      <option value="03" <?if ($mes == "03") { ?>selected<? }?>><?php $mes; ?> Marzo</option>
                      <option value="04" <?if ($mes == "04") { ?>selected<? }?>><?php $mes; ?> Abril</option>
                      <option value="05" <?if ($mes == "05") { ?>selected<? }?>><?php $mes; ?> Mayo</option>
                      <option value="06" <?if ($mes == "06") { ?>selected<? }?>><?php $mes; ?> Junio</option>
                      <option value="07" <?if ($mes == "07") { ?>selected<? }?>><?php $mes; ?> Julio</option>
                      <option value="08" <?if ($mes == "08") { ?>selected<? }?>><?php $mes; ?> Agosto</option>
                      <option value="09" <?if ($mes == "09") { ?>selected<? }?>><?php $mes; ?> Septiembre</option>
                      <option value="10" <?if ($mes == "10") { ?>selected<? }?>><?php $mes; ?> Octubre</option>
                      <option value="11" <?if ($mes == "11") { ?>selected<? }?>><?php $mes; ?> Noviembre</option>
                      <option value="12" <?if ($mes == "12") { ?>selected<? }?>><?php $mes; ?> Diciembre</option>
                    </select> 
                  </div>
                  <div class="form-check-inline col-4">
                    <label class="form-check-label">Año</label>
                    <select class="custom-select mr-sm-2" name="año" id="año">
                      <?php
                      $consu = "SELECT EXTRACT(year FROM fecha_hora_crea) as año FROM pedido_historico group by año;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $año_ = $row["año"];
                      ?>
                        <option value=<? echo $año_; if ($año_==$año){?>selected<?}?>> <? echo $año_; ?></option>
                      <?
                      }
                      ?>
                    </select> 
                  </div>
                <button type="submit" class="btn btn-primary mb-2" name="">Mostrar cuadro</button>
              </div>
            </form>
            </div>
            
             <!-- INSERTAR GRAFICO DE COLUMNA PARA LA BUSQUEDA DE RANGO DE FECHAS -->
            
              <?php
                $con = new mysqli("localhost", "root", "Eweb02", "demo");
                $Query1="SELECT c.nombre as nombre ,sum(a.cantidad_2) as cantidad2, sum(a.cantidad_5) as cantidad5, SUM(a.cantidad_5_catalitico) as cantidad5c, SUM(a.cantidad_11) as cantidad11, SUM(a.cantidad_11_catalitico) as cantidad11c, SUM(a.cantidad_15) as cantidad15, SUM(a.cantidad_15_catalitico) as cantidad15c, SUM(a.cantidad_45) as cantidad45, SUM(a.cantidad_45_catalitico) as cantidad45c, SUM(a.cantidad_h15_aluminio) as cantidadh15a, SUM(a.cantidad_h15_fierro) as cantidadh15f from pedido_detalle_historico a, pedido_historico b, chofer c where b.id_pedido = a.id_pedido and c.id_chofer = b.id_chofer and fecha_hora_crea between '$año-$mes-01 00:00:01' and '$año-$mes-$dias 23:59:59' group by c.nombre";
                    
                echo "Query dimensional: $Query1.<br>";
                $res2 = $con->query($Query1);
              ?>
              <script type="text/javascript">
      google.charts.load('current', {packages:['corechart']});
      google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Chofer');
          data.addColumn('number', '2 kilos');
          data.addColumn('number', '5 kilos');
          data.addColumn('number', '5 kilos catalitico');
          data.addColumn('number', '11 kilos');
          data.addColumn('number', '11 kilos catalitico');
          data.addColumn('number', '15 kilos');
          data.addColumn('number', '15 kilos catalitico');
          data.addColumn('number', '45 kilos');
          data.addColumn('number', '45 kilos catalitico');
          data.addColumn('number', 'H15 kilos aluminio');
          data.addColumn('number', 'H15 kilos fierro');
          data.addRows([
            <?php
              while ($fila2 = $res2->fetch_assoc())
              {
                echo "['".$fila2["nombre"]."', ".$fila2["cantidad2"].", ".$fila2["cantidad5"].", ".$fila2["cantidad5c"].", ".$fila2["cantidad11"].", ".$fila2["cantidad11c"].", ".$fila2["cantidad15"].", ".$fila2["cantidad15c"].", ".$fila2["cantidad45"].", ".$fila2["cantidad45c"].", ".$fila2["cantidadh15a"].", ".$fila2["cantidadh15f"]."],";
              }
              //['Work',     11]
              ?>    
          ]);

         var options = {
           title: 'GRAFICO DE BARRA QUE LISTA PEDIDOS POR MES Y CHOFER',
           legend: 'none',
            responsive: true,
           height: 650,
           bar: {groupWidth: '100%'},
           vAxis: { gridlines: { count: 10 }, textStyle: {color: 'black'} },
           titleTextStyle: {color: '#004bd6'},
           colors: ['#0e61e4'],
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
    
    <div id="number_format_chart" class="w-75 h-75 pb-5"></div>

    <table class="table table-hover mt-1 col-12 justify-content-center" id="tabla">
                 <thead class="thead-light justify-content-center">
                    <strong>CUADRO RESUMEN MENSUAL DE PEDIDOS TELEFONICOS - <?php echo $mes."/".$año; ?></strong>
                   <tr>
                     <th scope="col">Chofer</th>
                     <th scope="col" >2 kilos</th>
                     <th scope="col" >5 Kilos</th>
                     <th scope="col" >5 Kilos C</th>
                     <th scope="col" >11 Kilos</th>
                     <th scope="col" >11 Kilos C</th>
                     <th scope="col" >15 Kilos</th>
                     <th scope="col" >15 Kilos C</th>
                     <th scope="col" >45 Kilos</th>
                     <th scope="col" >45 Kilos C</th>
                     <th scope="col" >h15 Kilos Aluminio</th>
                     <th scope="col" >H15 Kilos Fierro</th>
                     <th scope="col">Total Unidades</th>
                     <th scope="col">(CLP) Entregados</th>
                   </tr>
                 </thead>
                 <tbody class="justify-content-center">
                   <?
                   
                    $result = mysqli_query($link, $Query1);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $nombre = $row["nombre"];
                      $cantidad2 = $row["cantidad2"];
                      $cantidad5 = $row["cantidad5"];
                      $cantidad5c = $row["cantidad5c"];
                      $cantidad11 = $row["cantidad11"];
                      $cantidad11c = $row["cantidad11c"];
                      $cantidad15 = $row["cantidad15"];
                      $cantidad15c = $row["cantidad15c"];
                      $cantidad45 = $row["cantidad45"];
                      $cantidad45c = $row["cantidad45c"];
                      $cantidad15a = $row["cantidadh15a"];
                      $cantidad15f = $row["cantidadh15f"];


                      $kilos2 = ($cantidad2 * 2);
                      $kilos5 = ($cantidad5 * 5);
                      $kilos5c = ($cantidad5c * 5);
                      $kilos11 = ($cantidad11 * 11);
                      $kilos11c = ($cantidad11c * 11);
                      $kilos15 = ($cantidad15 * 15);
                      $kilos15c = ($cantidad15c * 15);
                      $kilos45 = ($cantidad45 * 45);
                      $kilos45c = ($cantidad45c * 45);
                      $kilosh15a = ($cantidad15a * 15);
                      $kilosh15f = ($cantidad15f * 15);
                      $totalChofer += $cantidad2 + $cantidad5 + $cantidad5c + $cantidad11 +  $cantidad11c + $cantidad15 + $cantidad15c + $cantidad45 + $cantidad45c + $cantidad15a + $cantidad15f;
                      $totalKilosChofer +=  $kilos2 + $kilos5 + $kilos5c + $kilos11 + $kilos11c+ $kilos15 + $kilos15c+ $kilos45+ $kilos45c+ $kilosh15a+ $kilosh15f; 
                      
                      //calculando total de kilos por categoria
                      $total2k += $kilos2;
                      $total5k += $kilos5;
                      $total5kc += $kilos5c;
                      $total11k += $kilos11;
                      $total11kc += $kilos11c;
                      $total15k += $kilos15;
                      $total15kc += $kilos15c;
                      $total45k += $kilos45;
                      $total45kc += $kilos45c;
                      $totalh15ka += $kilosh15a;
                      $totalh15kf += $kilosh15f;

                      //calculando total de unidades por categoria
                      $total2 += $cantidad2;
                      $total5 += $cantidad5;
                      $total5c += $cantidad5c;
                      $total11 += $cantidad11;
                      $total11c += $cantidad11c;
                      $total15 += $cantidad15;
                      $total15c += $cantidad15c;
                      $total45 += $cantidad45;
                      $total45c += $cantidad45c;
                      $totalh15a += $cantidad15a;
                      $totalh15f += $cantidad15f;

                      //total de unidades de todos los choferes
                      $totalunidades += $totalChofer;
                      $totalesKilos += $totalKilosChofer;

                    ?>
                       <td><?php echo $nombre; ?></td>
                       <td><?php echo number_format($cantidad2)." Un"; ?></td>
                       <td><?php echo number_format($cantidad5)." Un"; ?></td>
                       <td><?php echo number_format($cantidad5c)." Un"; ?></td>
                       <td><?php echo number_format($cantidad11)." Un"; ?></td>
                       <td><?php echo number_format($cantidad11c)." Un"; ?></td>
                       <td><?php echo number_format($cantidad15)." Un"; ?></td>
                       <td><?php echo number_format($cantidad15c)." Un"; ?></td>
                       <td><?php echo number_format($cantidad45)." Un"; ?></td>
                       <td><?php echo number_format($cantidad45c)." Un"; ?></td>
                       <td><?php echo number_format($cantidadh15a)." Un"; ?></td>
                       <td><?php echo number_format($cantidad15f)." Un"; ?></td>
                       <td><?php echo number_format($totalChofer)." Un"; ?></td>
                    </tr>
                       <?php $totalChofer = 0;}  ?>
                     </tr>
                     <tr class="text-uppercase">
                     <td>Totales</td>
                     <td><?php echo number_format($total2)." Un"; ?></td>
                     <td><?php echo number_format($total5)." Un"; ?></td>
                     <td><?php echo number_format($total5c)." Un"; ?></td>
                     <td><?php echo number_format($total11)." Un"; ?></td>
                     <td><?php echo number_format($total11c)." Un"; ?></td>
                     <td><?php echo number_format($total15)." Un"; ?></td>
                     <td><?php echo number_format($total15c)." Un"; ?></td>
                     <td><?php echo number_format($total45)." Un"; ?></td>
                     <td><?php echo number_format($total45c)." Un"; ?></td>
                     <td><?php echo number_format($totalh15a)." Un"; ?></td>
                     <td><?php echo number_format($totalh15f)." Un"; ?></td>
                     <td><?php echo number_format($totalunidades)." Un"; ?></td>
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

<!-- Query para mostrar total de pedidos por distribuidor
    SELECT b.nombre as distribuidor, COUNT(a.id_pedido) as total_pedidos from pedido_historico a, lista_precios b WHERE a.id_lista_precios = b.id_lista_precios GROUP by distribuidor
-->