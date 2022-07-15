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
      <div class="col-lg-9 col-xl-10">

        <!-- BARRA NAVEGACION -->
        <!-- FIN BARRA NAVEGACION -->

        <!-- CONFIGURACION -->
        <div class="card mt-3">
          <div class="card-header">
            <h6><img src="img/report.png" width="35px"></img> INFORMES DEL SISTEMA - PEDIDOS POR COMUNA/LOCALIDAD</h6>
          </div>
          <div class="card-body">
            <hr>
            <div class="text-center">
            <form name="fecha" action="informe_comunal.php" method="POST">
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
                $con = new mysqli("localhost", "root","Eweb02","demo");
                $query2="SELECT d.nombre as comuna, count(a.id_pedido) as total_pedidos FROM pedido_historico a, cliente b, sector c, localidad d WHERE a.id_cliente=b.id_cliente AND a.estado=3 and b.id_sector = c.id_sector and b.id_localidad = d.id_localidad ";
                  if (trim($fecha1)!="--")
                  {
                    $query2=$query2." AND a.fecha_hora_crea>='$fecha1 00:00:01' ";
                  }
                  if (trim($fecha2)!="--")
                  {
                    $query2=$query2." AND a.fecha_hora_crea<='$fecha2 23:59:59' ";
                  }
                  $query2=$query2."group by comuna order by comuna";
                //$consultaSQL2 = "SELECT s.nombre, (COUNT(p.id_pedido)) as cantidad_pedidos from pedido_historico p, cliente c, sector s where estado = 3 and estado is not null AND s.id_sector = c.id_sector AND p.fecha_hora_crea BETWEEN '$fecha1' and '$fecha2' GROUP BY c.id_sector ORDER BY `s`.`nombre` ASC;";
                //echo "Query dimensional: $query2.<br>";
                $res2 = $con->query($query2);
              ?>
    <script type="text/javascript">
      google.charts.load('current', {packages:['corechart']});
      google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Comuna');
          data.addColumn('number', 'Total pedidos');
          data.addRows([
            <?php
              while ($fila2 = $res2->fetch_assoc())
              {
                echo "['".$fila2["comuna"]."', ".$fila2["total_pedidos"]."],";
              }
              //['Work',     11]
              ?>    
          ]);

         var options = {
           title: 'Detalle de cantidades de pedidos divididos por comuna',
           height: 500,
           legend: 'none',
           bar: {groupWidth: '70%'},
           vAxis: { gridlines: { count: 5 }, textStyle: {color: 'black'} },
           titleTextStyle: {color: ' #f18112'},
           colors: ['#f18112'],
           is3D: true,
           hAxis: { textStyle: {color: '#0b147a', fontFamily: 'arial'},
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