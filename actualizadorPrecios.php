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

    $query = "SELECT id_producto, nombre FROM producto WHERE tipo_producto = 1";
    $result = mysqli_query($link, $query);
          while ($row = mysqli_fetch_assoc($result))
          {
            $idProducto = $row["id_producto"];
            $fechaHoy = $_POST["fecha"];
            $precio = $_POST["precio_$idProducto"];


            $query2 = "SELECT `fecha`,id_producto FROM `lista_precios_envases` where id_producto = $idProducto ORDER BY fecha DESC LIMIT 0,1";
            $result2= mysqli_query($link, $query2);
            $row = mysqli_fetch_assoc($result2);
            $fecha_ = $row["fecha"];

            if ($fecha_ == $fechaHoy)
            {
              $insert = "UPDATE lista_precios_envases set precio = $precio where fecha = '$fechaHoy' AND id_producto = $idProducto";
              $result2 = mysqli_query($link, $insert);
              echo $insert."<br>";
            }
            else 
            {
              $insert = "INSERT INTO lista_precios_envases (id_producto, fecha, precio) VALUES ($idProducto, '$fechaHoy', $precio);";
            $result2 = mysqli_query($link, $insert);
            echo $insert."<br>";
            }
          }
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
        <div class="card m-1 p-1">
          <div class="card-header">
            <h6><i class="fa-solid fa-money-check-dollar-pen"></i> ACTUALIZA PRECIOS ENVASES VACIOS</h6>
          </div>
          <div class="card-body p-0">
            <form name="datos" method="POST" action="actualizadorPrecios.php" class="was-validated">
              <input type="hidden" name="graba" value="<?php echo 1; ?>">
              <input type="hidden" name="fecha" value="<?php $fecha = date("Y-m-d"); echo $fecha; ?>">
              <div>
                <div class="card card-body">
                  <div class="form-group">
                    <div class="form-check mt-3">
                      <div class="container-fluid">
                      <div class="row">
                      <div class="col-md-6 col-sm-12">
                        </div>
                      </div>
                    </div>
            <table class="table table-hover mt-1">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Producto</th>
                  <th scope="col">Precio</th>
              </thead>
              <tbody>
                <?
                $query = "SELECT id_producto, nombre FROM producto WHERE tipo_producto = 1";
                $result = mysqli_query($link, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row["id_producto"];
                  $nombre = $row["nombre"];

                  $consultaPrecio = "SELECT id_producto, precio from lista_precios_envases where id_producto = $id order BY fecha DESC";
                  $resultPrecio = (mysqli_query($link, $consultaPrecio));
                  $row2 = mysqli_fetch_assoc($resultPrecio);
                  $precio = $row2["precio"];
                ?>
                  <tr>
                    <td><?php echo $nombre; ?>
                  </td>
                    <td><input class="form-control" type="number" name="precio_<?php echo $id; ?>" min="0" max="2147483647" step="1" value="<?php echo $precio; ?>"></td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                </div>
              </div>
            </form>
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