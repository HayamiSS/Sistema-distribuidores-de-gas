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
      $elimina = $_POST["elimina"];
      if (trim($elimina) == "") {
        $elimina = $_GET["elimina"];
      }

      $desactivar = $_POST["desactivar"];
      if (trim($desactivar) == "") {
        $desactivar= $_GET["desactivar"];
      }

      $por_defecto = $_GET["por_defecto"];


      // ************************************************************************
      //  GRABA REGISTRO
      // ************************************************************************
      if ($graba == 1) {
        // Variables POST
        $nombre = $_POST["nombre"];
        $activo = $_POST["activo"];
        if ($activo == "") {
          $activo = 0;
        }
        echo $id;
        if (trim($id) == "") {
          $query =  mysqli_query($link, "SELECT * FROM marca WHERE nombre = '$nombre';");
          $rows = mysqli_num_rows($query);
          
          if ($rows == 1) {
            $repeated = 1;
          }
          if ($repeated != 1) {
            $query = "INSERT INTO marca (activo, nombre) VALUES ($activo,'$nombre');";
            $result = mysqli_query($link, $query);
            $recorded = 1;
          }
        } else {
          $query =  mysqli_query($link, "SELECT id_marca FROM marca WHERE id_marca!=$id and nombre = '$nombre';");
         
          $rows = mysqli_num_rows($query);
          if ($rows == 1) {
            $repeated = 1;
          }
          if ($repeated != 1) {
            $query = "UPDATE marca SET nombre = '$nombre' WHERE id_marca=$id;";
            $result = mysqli_query($link, $query);
            $updated = 1;
          }
        }

        // Limpia Variables
        $id = "";
        $nombre = "";
        $activo = "";
      }
      // ************************************************************************

       //  desactivar / activar   
  // ************************************************************************
  if ($desactivar == 1) {

    $query = "SELECT activo FROM `marca` WHERE id_marca=$id";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) 
    {
      $valor_ = $row["activo"];
    }

    if ($valor_ == 1) {$valor_=0;} else {$valor_=1;}
   
    $query = "UPDATE marca SET activo = $valor_ WHERE id_marca=$id";
    $result = mysqli_query($link, $query);
    $updated = 1;

    $id = "";
  }

  // 


      // ************************************************************************
      //  ELIMINA REGISTRO  
      // ************************************************************************
      if ($elimina == 1) {
        $query = "DELETE FROM peoneta WHERE id_peoneta =$id";
        $result = mysqli_query($link, $query);
        $delete = 1;
        $id = "";
      }
      // ************************************************************************

      // ************************************************************************
      //  RECUPERA DATOS SEGUN ID
      // ************************************************************************
      $query = "SELECT id_marca,activo,nombre FROM marca WHERE id_marca='$id'";
      $result = mysqli_query($link, $query);
      if ($row = mysqli_fetch_assoc($result)) {
        $id = $row["id_marca"];
        $activo_ = $row["activo"];
        $nombre_ = $row["nombre"];
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
           <div class="card mt-3 justify-content-center">
             <div class="card-header">
               <h6>Crear Marcas</h6>
             </div>
             <div class="card-body">
               <form name="datos" method="POST" action="marca.php" class="was-validated">
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
                 <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" <? if ($edita == 1) { ?> style="display:none" <? } ?>>
                   Crea nuevo registro
                 </button>
                 <div class="collapse <? if ($edita == 1) { ?>show<? } ?>" id="collapseExample">
                   <div class="card card-body">
                     <div class="form-group">
                       <label for="nombre">Marca </label>
                       <input type="text" class="form-control" id="nombre" aria-describedby="texto_nombre" name="nombre" value="<?php echo $nombre_ ?>" maxlength="50" required>
                     </div>
                     <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                   </div>
                 </div>
               </form>
               <hr>
               <table class="table table-hover mt-1 col-md-8">
                 <thead class="thead-light">
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">
                       <span class="d-none d-md-block">Editar</span>
                       <span class="d-block d-md-none">Edit</span>
                     </th>
                     <th scope="col">Estado</th>
                     <th scope="col">Nombre</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?
                    $numero_linea = 0;
                    $query = "SELECT * FROM marca order by activo desc,id_marca;";
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result)) {
                      $id_ = $row["id_marca"];
                      $activo_ = $row["activo"];
                      $nombre_ = $row["nombre"];
                      $numero_linea += 1;
                    ?>
                    <?if($activo_ == 1){?> <?}else{?><tr class="table-danger"> <?}?>
                       <th scope="row"><?php echo $numero_linea ?></th>
                       <td>
                         <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='marca.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block"> <i class="far fa-edit" style="color:white;"></i></span></button>
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
                                   <h5 class="modal-title" id="ModalLabel">Activar marca</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Activar a <strong><?php echo $nombre_ ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-success" onclick="javascript:window.location.href='marca.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>&lista_inactivos=<?php echo $lista_inactivos ?>';">Activar <i class="far fa-check-circle" style="color:white;"></i></button>
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
                                   <h5 class="modal-title" id="ModalLabel">Desactivar marca</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Desactivar a <strong><?php echo $nombre_ ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='marca.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>&lista_inactivos=<?php echo $lista_inactivos ?>';">Desactivar <i class="far fa-times-circle" style="color:white;"></i></button>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- Fin Modal -->
                         </td>
                       <? } ?>
                       <td>
                         <!-- Button modal REGISTRO -->
                         <?php echo $nombre_ ?>
                       </td>
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