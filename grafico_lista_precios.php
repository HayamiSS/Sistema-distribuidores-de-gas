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
            <h6><img src="img/report.png" width="35px"></img> INFORMES DEL SISTEMA - PEDIDOS LISTA DE PRECIOS</h6>
          </div>
          <div class="card-body">
            <hr>
            <div class="text-center">
            <form name="fecha" action="grafico_lista_precios.php" method="POST">
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
            
           <?php
           function total_pedidos_canal_venta_historico($id_lista_precios, $fecha1, $fecha2, $link)
           {
               $query2 = "SELECT count(id_pedido) as total_pedidos FROM pedido_historico WHERE estado=3 AND id_lista_precios='$id_lista_precios' ";
               if (trim($fecha1) != "--") {
                   $query2 = $query2 . " AND fecha_hora_crea>='$fecha1 00:00:01' ";
               }
               if (trim($fecha2) != "--") {
                   $query2 = $query2 . " AND fecha_hora_crea<='$fecha2 23:59:59' ";
               }
               $result2 = mysqli_query($link, $query2);
               if ($row2 = mysqli_fetch_assoc($result2)) {
                   $total_pedidos_entregados = $row2["total_pedidos"];
               }
               return $total_pedidos_entregados;
           }
     
           function total_kilos_canal_venta_historico($id_lista_precios, $fecha1, $fecha2, $link)
     {
         $query = "SELECT b.cantidad_2,b.cantidad_5,b.cantidad_11,b.cantidad_15,b.cantidad_45,b.cantidad_h15_aluminio,b.cantidad_h15_fierro FROM pedido_historico a, pedido_detalle_historico b WHERE a.id_pedido=b.id_pedido AND a.estado=3 AND a.id_lista_precios='$id_lista_precios' ";
         if (trim($fecha1) != "--") {
             $query = $query . " AND a.fecha_hora_crea>='$fecha1 00:00:01' ";
         }
         if (trim($fecha2) != "--") {
             $query = $query . " AND a.fecha_hora_crea<='$fecha2 23:59:59' ";
         }
         $result = mysqli_query($link, $query);
         $suma_kilos = 0;
         while ($row = mysqli_fetch_assoc($result)) {
             $cantidad_2            = $row["cantidad_2"];
             $cantidad_5            = $row["cantidad_5"];
             $cantidad_11           = $row["cantidad_11"];
             $cantidad_15           = $row["cantidad_15"];
             $cantidad_45           = $row["cantidad_45"];
             $cantidad_h15_aluminio = $row["cantidad_h15_aluminio"];
             $cantidad_h15_fierro   = $row["cantidad_h15_fierro"];
      
             $cantidad_2            = $cantidad_2 * 2;
             $cantidad_5            = $cantidad_5 * 5;
             $cantidad_11           = $cantidad_11 * 11;
             $cantidad_15           = $cantidad_15 * 15;
             $cantidad_45           = $cantidad_45 * 45;
             $cantidad_h15_aluminio = $cantidad_h15_aluminio * 15;
             $cantidad_h15_fierro   = $cantidad_h15_fierro * 15;
             $suma_kilos += $cantidad_2 + $cantidad_5 + $cantidad_11 + $cantidad_15 + $cantidad_45 + $cantidad_h15_fierro + $cantidad_h15_aluminio;
         }
         //echo $query."<br>";
         return $suma_kilos;
     }

           
           // PEDIDOS ENTREGADOS
      $total_pedidos_entregados=total_pedidos_canal_venta_historico($id_lista_precios,$fecha1,$fecha2,$link);
      $suma_pedidos_entregados=$suma_pedidos_entregados+$total_pedidos_entregados;

      // PEDIDOS KILOS
      $total_kilos_entregados=total_kilos_canal_venta_historico($id_lista_precios,$fecha1,$fecha2,$link);
      $suma_kilos_entregados=$suma_kilos_entregados+$total_kilos_entregados;

      
      ?>

            <!-- INSERTAR GRAFICO DE COLUMNA PARA LA BUSQUEDA DE RANGO DE FECHAS -->
            
              <?php
                $con = new mysqli("localhost", "root", "Eweb02", "demo");
                $Query1="SELECT b.nombre as distribuidor, a.id_lista_precios, COUNT(a.id_pedido) as total_pedidos from pedido_historico a, lista_precios b WHERE a.id_lista_precios = b.id_lista_precios ";
                  if (trim($fecha1)!="--")
                  {
                    $Query1=$Query1." AND a.fecha_hora_crea>='$fecha1 00:00:01' ";
                  }
                  if (trim($fecha2)!="--")
                  {
                    $Query1=$Query1." AND a.fecha_hora_crea<='$fecha2 23:59:59' ";
                  }
                  $Query1=$Query1." GROUP by distribuidor, a.id_lista_precios";
                //echo "Query dimensional: $Query1.<br>";
                $res2 = $con->query($Query1);
              ?>
    <script type="text/javascript">
      google.charts.load('current', {packages:['corechart']});
      google.charts.setOnLoadCallback(drawStuff);

        function drawStuff() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Distribuidor');
          data.addColumn('number', 'Pedidos entregados');
          data.addRows([
            <?php
              while ($fila2 = $res2->fetch_assoc())
              {
                echo "['".$fila2["distribuidor"]."', ".$fila2["total_pedidos"]."],";
              }
              //['Work',     11]
              ?>    
          ]);

         var options = {
           title: 'GRAFICO DE BARRA QUE LISTA PEDIDOS POR DISTRIBUIDOR',
           legend: 'none',
           responsive: true,
           height: 400,
           bar: {groupWidth: '50%'},
           vAxis: { gridlines: { count: 2 }, textStyle: {color: 'black'} },
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
                    <strong>CUADRO RESUMEN TOTAL DE PEDIDOS Y KILOS POR LISTA DE PRECIOS</strong>
                   <tr>
                     <th scope="col">Distribuidor</th>
                     <th scope="col">Entregados</th>
                     <th scope="col">Kilos</th>
                   </tr>
                 </thead>
                 <tbody class="justify-content-center">
                   <?
                   
                    $result = mysqli_query($link, $Query1);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $nombre = $row["distribuidor"];
                      $id_lista_precios = $row["id_lista_precios"];
                      $entregados = $row["total_pedidos"];

                      $kilos_entregados = total_kilos_canal_venta_historico($id_lista_precios,$fecha1,$fecha2,$link);
                      
                    $total = $total + $entregados;
                    $totalkilos = $totalkilos + $kilos_entregados;
                    ?>
                       <td><?php echo $nombre; ?></td>
                       <td><?php echo number_format($entregados); ?></td>
                       <td><?php echo number_format($kilos_entregados)." KG"; ?></td>
                    </tr>
                       <?php }  ?>
                     </tr>
                     <tr class="bg-info" style="color: white; font-family: Arial, Helvetica, sans-serif">
                     <td>Totales</td>
                     <td><?php echo number_format($total); ?></td>
                     <td><?php echo number_format($totalkilos)." KG"; ?></td>
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