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
  
  $desactivar = $_POST["desactivar"];
  if (trim($desactivar) == "") {
    $desactivar= $_GET["desactivar"];
  }

  $id_descuento = $_POST["id_descuento"];
  if (trim($id_descuento) == "") {
    $id_descuento= $_GET["id_descuento"]; 
  }

  // ************************************************************************
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

    //  desactivar / activar   
  // ************************************************************************
  if ($desactivar == 1) {

    $query = "SELECT activo FROM rendicion_descuento WHERE id_rendicion_descuento=$id";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) 
    {
      $valor_ = $row["activo"];
    }

    if ($valor_ == 1) {$valor_=0;} else {$valor_=1;}
   
    $query = "UPDATE rendicion_descuento SET activo = $valor_ WHERE id_rendicion_descuento=$id";
    $result = mysqli_query($link, $query);
    $updated = 1;

    $id = "";
  }


  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1) {
    // Variables POST
    $id_descuento = $_POST["id_descuento"];
    $fecha = $_POST["fecha"];
    $hora = $_POST["hora"];
    $monto = $_POST["monto"];
    $motivo = $_POST["motivo"];
    $activo = $_POST["activo"];
    $tipo = $_POST["tipo"];
    if ($activo == "") {
      $activo = 0;
    }
    
    //$fecha1 = $_POST["fecha1"];
    
    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT id_rendicion_descuento FROM rendicion_descuento;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1) {
        $query = "INSERT INTO rendicion_descuento (id_descuento,fecha,hora,monto,motivo,activo, tipo) VALUES ($id_descuento,'$fecha','$hora',$monto, '$motivo',$activo, $tipo)";
        $result = mysqli_query($link, $query);
        $recorded = 1;
      }
    }
     
    else 
    {
      $query = mysqli_query($link, "SELECT id_rendicion_descuento FROM rendicion_descuento WHERE id_rendicion_descuento!=$id;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated != 1)
      {
        
        $query = "UPDATE rendicion_descuento SET id_descuento=$id_descuento,monto=$monto,activo=$activo, motivo='$motivo', tipo = $tipo WHERE id_rendicion_descuento='$id'";
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

  $query = "SELECT id_rendicion_descuento,id_descuento,fecha,hora,monto,motivo,activo,tipo FROM rendicion_descuento WHERE id_rendicion_descuento='$id'";
  $result = mysqli_query($link, $query);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_rendicion_descuento"];
    $id_descuento = $row["id_descuento"];
    $fecha = $row["fecha"];
    $hora = $row["hora"]; 
    $monto_ = $row["monto"];
    $motivo_ = $row["motivo"];
    $activo = $row["activo"];
    $tipo = $row["tipo"];
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
            <h6><i class="fa-solid fa-gas-pump"></i> RETIRO/ABONO DE DINERO A LA</h6>
            <p style="color: red;">RENDICIÓN DE DINERO</p>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="retiro_abono.php" class="was-validated">
              <input type="hidden" name="fecha" value="<?php echo $fecha=date("Y-m-d"); ?>">
              <input type="hidden" name="fecha1" value="<?php echo $fecha1;?>">
              <input type="hidden" name="hora" value="<?php echo $hora = date("H:i:s");?>">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="activo" value="1">
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
                  <div class="form-group">
                    <div class="row">
                      <div class="col-12">
                        <label class="form-check-label">Tipo: </label>
                      <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="tipo" id="tipo" value="1" <?php if ($tipo == "1") { ?>checked<? } 
                        ?>>
                        <label class="form-check-label" for="exampleRadios1">
                        RETIRO (suma al total a rendir) 
                        </label>
                      </div>
                      <div class="form-check col-6">
                        <input class="form-check-input" type="radio" name="tipo" id="tipo" value="2" <?php if ($tipo == "2") { ?>checked<? }
                        ?>>
                        <label class="form-check-label" for="exampleRadios1">
                        ABONO (resta al total a rendir) 
                        </label>
                      </div>
                      </div>
                      <div class="col-6">
                      <label for="nombre">Concepto: </label>
                    <br>
                    <select class="custom-select mr-sm-2" name="id_descuento" id="descuento">
                      <option>seleccione...</option>
                      <?
                      $consu = "SELECT id_descuento, nombre FROM descuento;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_descuento_ = $row["id_descuento"];
                        $nombre_ = $row['nombre'];
                      ?>
                        <option value=<? echo $id_descuento_; ?> <?if ($id_descuento_==$id_descuento){?>selected<?}?>
                        > <? echo $nombre_; ?></option>
                      <?
                      }
                      ?>
                    </select> 
                      </div>
                      <div class="col-6">
                      <label for="precioxlitro">Monto: </label>
                        <input type="number" class="form-control" step="1" id="monto" aria-describedby="texto_nombre" name="monto" value="<?php echo $monto_;?>"
                        max="2147483647" min="<?php echo $monto_; ?>" step="1">
                      </div>
                      <div class="col-12">
                      <label for="motivo">Motivo: </label>
                        <input type="text" class="form-control" id="motivo" aria-describedby="texto_nombre" name="motivo" value="<?php echo $motivo_;?>" maxlength="50" min="1">
                        <br>
                        <p><b>RETIRO: </b>El concepto de retiro es que se <strong class="text-primary">SUMA</strong> el monto al total a rendir y lo resta del total vendido.</p>
                      <p><b>ABONO: </b>Es lo contrario del Retiro, esto quiere decir que <strong class="text-danger">RESTA</strong> el monto al total a rendir y lo suma al total vendido. </p>
                      </div>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            <div class="text-right">
            <form name="fecha" action="retiro_abono.php" method="POST">
              <div class="form-group row">
                <div class="col-sm-2">
                  <input type="date" class="form-control" id="fechaxeditar" name="fecha1" value="<?php echo $fecha1;?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2" name="">Filtrar</button>
              </div>
            </form>
            </div>
            
            <table class="table table-hover mt-1 col-md-8">
                 <thead class="thead-light">
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">
                       <span class="d-none d-md-block">Editar</span>
                       <span class="d-block d-md-none">Edit</span>
                     </th>
                     <th scope="col">Estado</th>
                     <th scope="col">Fecha</th>
                     <th scope="col">Hora</th>
                     <th scope="col">Tipo</th>
                     <th scope="col">Concepto</th>
                     <th scope="col">Monto</th>
                     <th scope="col">Motivo</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?
                    $numero_linea = 0;
                    $query = "SELECT * FROM rendicion_descuento where fecha = '$fecha1' and id_descuento is not null order by activo desc, id_descuento;";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id_ = $row["id_rendicion_descuento"];
                      $id2_ = $row["id_descuento"];
                      $activo_ = $row["activo"];
                      $fecha_ = $row["fecha"];
                      $hora_ = $row["hora"];
                      $tipo_ = $row["tipo"];
                      $monto_ = $row["monto"];
                      $motivo_ = $row["motivo"];
                      $numero_linea += 1;
                      
                      //query para selecionar el concepto del id_descuento

                      $numero_linea1 = 0;
                      $query1 = "SELECT nombre from descuento where id_descuento = $id2_";
                      $result1 = mysqli_query($link, $query1);
                      if ($row1 = mysqli_fetch_assoc($result1)) {
                        $nombre_usuario = $row1["nombre"];
                      $numero_linea1 +=1;
                      }
                    ?>
                    <?if($activo_ == 1){?> <?}else{?><tr class="table-danger"> <?}?>
                       <th scope="row"><?php echo $numero_linea ?></th>
                       <td>
                         <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='retiro_abono.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>&fecha1=<?php echo $fecha1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block"> <i class="far fa-edit" style="color:white;"></i></span></button>
                       </td>
                       <? if ($activo_ == 0) { ?>

                         <td>
                           <!-- Button modal REGISTRO -->
                           <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Modal1<?php echo $id_ ?>"><span class="d-block">
                               Des<i class="far fa-times-circle" style="color:white;"></i></span>
                           </button>
                           <!-- Modal desactivar -->
                           <div class="modal fade" id="Modal1<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                   <h5 class="modal-title" id="ModalLabel">Activar rendicion de dinero</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Activar a <strong><?php echo $nombre_usuario ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-success" onclick="javascript:window.location.href='retiro_abono.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?> &fecha1=<?php echo $fecha1; ?>';">Activar <i class="far fa-check-circle" style="color:white;"></i></button>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- Fin Modal -->
                         </td>

                       <? } else if ($activo_ == 1) { ?>

                        <td>
                           <!--xt-center Button modal REGISTRO -->
                           <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Modal2<?php echo $id_ ?>"><span class="d-block">
                               Act <i class="far fa-check-circle" style="color:white;"></i></span>
                           </button> 
                           <!-- Modal activar -->
                           <div class="modal fade" id="Modal2<?php echo $id_ ?>" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
                             <div class="modal-dialog">
                               <div class="modal-content">
                                 <div class="modal-header">
                                   <h5 class="modal-title" id="ModalLabel">Desactivar rendicion de dinero</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Desactivar a <strong><?php echo $nombre_usuario ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-danger" oncli-ck="javascript:window.location.href='retiro_abono.php?id=<? echo $id_ ?>&desactivar=<?php echo 1?>';">Desactivar <i class="far fa-times-circle" style="color:white;"></i></button>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- Fin Modal -->
                         </td>
                       <? } ?>
                       <td><?php echo $fecha_; ?></td>
                       <td><?php echo $hora_; ?></td>
                       <td><?php $tipo_; if ($tipo_ =="1")
                       { echo "Retiro"; } else { echo "Abono"; } ?></td>
                       <td><?php echo $nombre_usuario; ?></td>
                       <td><?php echo number_format($monto_); ?></td>
                       <td><?php echo $motivo_; ?></td>
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