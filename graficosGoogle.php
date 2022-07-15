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
  <?php
  include("library/abre_coneccion.php");
  $link = Conectarse();

    $con = new mysqli("localhost", "root","Eweb02","demo");
    $sql = "Select c.nombre as nombre, SUM(t.cantidad) as cantidad from transformacion_envases t, chofer c where t.id_chofer = c.id_chofer GROUP by c.nombre ";
    $res = $con->query($sql);
  ?>
  <!-- links para insertar funciones del datatable -->
  <link href="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
  <script src="https://unpkg.com/vanilla-datatables@latest/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
  <script src="https://kit.fontawesome.com/6a84b49c1b.js" crossorigin="anonymous"></script>
 
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

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
          title: 'Grafico transformacion de envases por chofer',
          is3D: true
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
<?php
        $sql3="select fecha, cantidad, odometro  FROM registro_petroleo where id_movil = 1";
        $res3 = $con->query($sql3);
      ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script>
              google.charts.load('current', {'packages':['line']});
              google.charts.setOnLoadCallback(drawChart3);

    function drawChart3() {

      var data3 = new google.visualization.DataTable();
      data3.addColumn('string', 'Dia');
      //data.addColumn('string','Chofer');
      data3.addColumn('number', 'combustible cargado');
      data3.addColumn('number', 'Odometro');

      data3.addRows([
        <?php
          while ($fila3 = $res3->fetch_assoc())
          {
              echo "['".$fila3["fecha"]."',
                      ".$fila3["cantidad"].",
                      ".$fila3["odometro"]."],";
          }
          ?>
        //[1,  37.8, 80.8, 41.8],
        
      ]);

      var options3 = {
        chart: {
          title: 'Grafico comparador carga de combustible y odometro',
          subtitle: 'Nicolas',
          is3D: true
        },
        width: 900,
        height: 500
      };

      var chart3 = new google.charts.Line(document.getElementById('linechart_material'));

      chart3.draw(data3, google.charts.Line.convertOptions(options3));
    }
      </script>
    <?php
        $sql4="SELECT r.fecha, c.nombre, r.cantidad, r.odometro from registro_petroleo r, chofer c where r.id_movil = c.id_chofer ";
        $res4 = $con->query($sql4);
      ?>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Fecha', 'Chofer', 'Cantidad de combustible cargado (lts)', 'Odometro'],
          <?php
          while ($fila4 = $res4->fetch_assoc())
          {
              echo "['".$fila4["fecha"]."',
                      '".$fila4["nombre"]."',
                      ".$fila4["cantidad"].",
                      ".$fila4["odometro"]."],";
          }
          ?>
        ]);

        var options = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
          seriesType: 'bars',
          series: {10: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>

</head>
<body>
<div id="piechart" style="width: 900px; height: 500px;"></div>
<div id="linechart_material" style="width: 900px; height: 600px;"></div>
<div id="chart_div" style="width: 900px; height: 500px;"></div>

<script src="js/jquery-3.2.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <? include("library/cierra_coneccion.php"); ?>
</body>
</html>