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

  $id_cliente = $_POST["id_cliente"];
  if (trim($id_cliente) == "")
  {
    $id_cliente = $_GET["id_cliente"];
  }

  $id_base_dato_ = $_POST["id_base_dato"];
  if (trim($id_base_dato_) == "")
  {
    $id_base_dato_ = $_GET["id_base_dato"];
  }

  $id_cliente2 = $_POST["id_cliente2"];
  if (trim($id_cliente2) == "")
  {
    $id_cliente2 = $_GET["id_cliente2"];
  }

  $id_base_dato2_ = $_POST["id_base_dato2"];
  if (trim($id_base_dato_) == "")
  {
    $id_base_dato2_ = $_GET["id_base_dato2"];
  }

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
  /*$edita = $_POST["edita"];
  if (trim($edita) == "") {
    $edita = $_GET["edita"];
  }
  $elimina = $_POST["elimina"];
  if (trim($elimina) == "") {
    $elimina = $_GET["elimina"];
  }*/
  
  $desactivar = $_POST["desactivar"];
  if (trim($desactivar) == "") {
    $desactivar= $_GET["desactivar"];
  }

	$busca = $_POST["busca"];
	if (trim($busca) == "") {
	$busca = $_GET["busca"];
	}
  //CREACION DE NOMBRE TEMPORAL DE LA IMAGEN
  function image_createThumb($src, $dest, $maxWidth, $maxHeight, $quality)
{
    if (file_exists($src) && isset($dest))
     {
        // path info
        $destInfo = pathInfo($dest);
        // image src size
        $srcSize = getImageSize($src);
        // image dest size $destSize[0] = width, $destSize[1] = height
        if ($srcSize[0] < $maxWidth && $srcSize[1] < $maxHeight)
          {
            $destSize[0] = $srcSize[0];
            $destSize[1] = $srcSize[1];
          }
          else
          {
            $srcRatio  = $srcSize[0] / $srcSize[1]; // width/height ratio
            $destRatio = $maxWidth / $maxHeight;
            if ($destRatio > $srcRatio)
              {
                $destSize[1] = $maxHeight;
                $destSize[0] = $maxHeight * $srcRatio;
              }
              else
              {
                $destSize[0] = $maxWidth;
                $destSize[1] = $maxWidth / $srcRatio;
              }
          }
        // path rectification
        if (strtolower($destInfo['extension']) == "gif")
          {
            $dest = substr_replace($dest, 'jpg', -3);
          }
        // true color image, with anti-aliasing
          $destImage = imageCreateTrueColor($destSize[0], $destSize[1]);
          imageAntiAlias($destImage, true);
          // src image
          switch ($srcSize[2])
          {
              case 1: //GIF
                  $srcImage = imageCreateFromGif($src);
                  break;
              case 2: //JPEG
                  $srcImage = imageCreateFromJpeg($src);
                  break;
              case 3: //PNG
                  $srcImage = imageCreateFromPng($src);
                  break;
              default:
                  return false;
                  break;
          }
          // resampling
          imageCopyResampled($destImage, $srcImage, 0, 0, 0, 0, $destSize[0], $destSize[1], $srcSize[0], $srcSize[1]);
          // generating image
          switch ($srcSize[2])
          {
              case 1:
              case 2:
                  imageJpeg($destImage, $dest, $quality);
                  break;
              case 3:
                  imagePng($destImage, $dest);
                  break;
          }
          return true;
      } 
      else
      {
          return false;
      }
}
  // ************************************************************************
  // CONTROL DE ACCESO
  // ************************************************************************
  // ************************************************************************

        //  desactivar / activar   
  // ************************************************************************
  if ($desactivar == 1) {

    $query = "SELECT activo FROM tickets WHERE id_ticket=$id";
    $result = mysqli_query($link, $query);
    if ($row = mysqli_fetch_assoc($result)) 
    {
      $valor_ = $row["activo"];
    }

    if ($valor_ == 1) {$valor_=0;} else {$valor_=1;}
   
    $query = "UPDATE tickets SET activo = $valor_ WHERE id_ticket=$id";
    $result = mysqli_query($link, $query);
    $updated = 1;

    $id = "";
  }

  // ************************************************************************
  //  GRABA REGISTRO
  // ************************************************************************
  if ($graba == 1)
	 {
    // Variables POST
    $id_cliente = $_POST["id_cliente"];
    $fecha = $_POST["fecha"];
    $id_base_dato = $_POST["id_base_datos"];
    $medio_contacto = $_POST["medio_contacto"];
    $asunto = $_POST["asunto"];
    $contenido = $_POST["contenido"];
    $activo = $_POST["activo"];
    if ($activo == "") { $activo = 0; }
    
    
    if (trim($id) == "") {
      $query =  mysqli_query($link, "SELECT id_ticket FROM tickets WHERE id_ticket = '$id';");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) {
        $repeated = 1;
      }
      if ($repeated != 1)
      {
        $query = "INSERT INTO tickets (id_cliente, activo, fecha, id_base_dato, medio_contacto, asunto, contenido) VALUES ($id_cliente, $activo, '$fecha',
        $id_base_dato, '$medio_contacto','$asunto', '$contenido')";
        $result = mysqli_query($link, $query);

        $selectID = "SELECT max(id_ticket)as pic_ticket FROM tickets";
        $resultadoID = (mysqli_query($link, $selectID));
        if ($row = mysqli_fetch_assoc($resultadoID))
        {
          $id_ticket = $row["pic_ticket"];
        }

        $img1 = $_FILES['imagen01']['name'];
        $imagen1 = $_FILES['imagen01']['tmp_name'];
      
        if (trim($img1)!="")
        {
          $extencion=strtolower(strrchr($img1,"."));
          if ($extencion!=".jpg" && $extencion!=".gif" && $extencion!=".jpeg" && $extencion!=".png")
          {
            $error=1;
            $recorded=0;
          }
          if ($extencion==".jpg" || $extencion==".gif" || $extencion==".jpeg" || $extencion==".png")
          {
            $calidad=100;
            $destino="foto1_$id_ticket.jpg";
            image_createThumb($imagen1,$destino,800,600,$calidad);
          }
        }

        $img2 = $_FILES['imagen02']['name'];
        $imagen2 = $_FILES['imagen02']['tmp_name'];
        
        if (trim($img2)!="")
        {
          $extencion=strtolower(strrchr($img2,"."));
          if ($extencion!=".jpg" && $extencion!=".gif" && $extencion!=".jpeg" && $extencion!=".png")
          {
            $error=1;
            $recorded=0;
          }
          if ($extencion==".jpg" || $extencion==".gif" || $extencion==".jpeg" || $extencion==".png")
          {
            $calidad=100;
            $destino="foto2_$id_ticket.jpg";
            image_createThumb($imagen2,$destino,800,600,$calidad);
          }
        }

        $img3 = $_FILES['imagen03']['name'];
        $imagen3 = $_FILES['imagen03']['tmp_name'];
        
        if (trim($img3)!="")
        {
          $extencion=strtolower(strrchr($img3,"."));
          if ($extencion!=".jpg" && $extencion!=".gif" && $extencion!=".jpeg" && $extencion!=".png")
          {
            $error=1;
            $recorded=0;
          }
          if ($extencion==".jpg" || $extencion==".gif" || $extencion==".jpeg" || $extencion==".png")
          {
            $calidad=100;
            $destino="foto3_$id_ticket.jpg";
            image_createThumb($imagen3,$destino,800,600,$calidad);
          }
        }

        $recorded = 1;
      }
    }
     
    else 
    {
      $query = mysqli_query($link, "SELECT id_ticket FROM tickets WHERE id_ticket!=$id;");
      $rows = mysqli_num_rows($query);
      if ($rows == 1) 
      {
        $repeated = 1;
      }
      if ($repeated != 1)
      {
        
        $query = "UPDATE tickets SET id_cliente=$id_cliente, id_base_dato = $id_base_dato, medio_contacto='$medio_contacto', asunto = $asunto, contenido = '$contenido' WHERE id_ticket='$id'";
        $result = mysqli_query($link, $query); 
        $updated = 1;
      }
    }
    // Limpia Variables

    $$id_cliente = ""; $fecha = ""; $id_base_dato = ""; $medio_contacto = ""; $asunto = "";  $contenido =""; $activo = "";
   }

  // ************************************************************************

	
  // ************************************************************************

  // ************************************************************************
  //  RECUPERA DATOS SEGUN ID
  // ************************************************************************

  $query5 = "SELECT * FROM tickets WHERE id_ticket='$id'";
  $result = mysqli_query($link, $query5);
  if ($row = mysqli_fetch_assoc($result)) {
    $id = $row["id_ticket"];
    $id_cliente = $row["id_cliente"];
    $activo = $row["activo"]; 
    $medio_contacto = $row["medio_contacto"];
    $asunto = $row["asunto"];
    $contenido = $row["contenido"];
  }
  // ************************************************************************
  ?>
  <div class="container-fluid">
    <!-- ENCABEZADO -->
    <!-- ENCABEZADO -->

    <!-- div para espaciado que se oculta en lg -->
    <div class="row justify-content-center text-center">
      <div class="col bg-success d-lg-none" style="height: 50px;">&nbsp;</div>
    </div>
    <!-- div para espaciado que se oculta en lg -->

    <div class="row">
      <!-- MENU -->
      <!-- MENU -->

      <!-- CONTENIDO -->
      <div class="col-lg-10 col-xl-12">

        <!-- BARRA NAVEGACION -->
        <!-- FIN BARRA NAVEGACION -->

        <!-- CONFIGURACION -->
        <div class="card mt-3 justify-content-center">
          <div class="card-header">
            <h6><i class="fa-solid fa-ticket"></i> CREACION DE TICKETS</h6>
          </div>
          <div class="card-body">
            <form name="datos" method="POST" action="tickets.php" class="was-validated" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?php echo $id; ?>">
              <input type="hidden" name="activo" value="1">
              <input type="hidden" name="fecha" value="<?php echo $fecha=date("Y-m-d"); ?>">
              <input type="hidden" name="graba" value="<?php echo 1; ?>"> 
              <? if ($edita == 1) { ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                  <strong>Modo Edici&oacute;n!</strong>
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
            
              <button class="btn btn-primary btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" <? if ($edita == 1) { ?>style="display:none" <? } ?>>
                Crea nuevo registro
              </button>
              <hr>
              <div class="collapse <? if ($edita == 1 || $id_cliente != "") { ?>show<? }
               ?>" id="collapseExample">
                <div class="card card-body">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-12">
                      <div class="col-6">
                      <label for="nombre">Cliente</label>
                    <br>
                    <select class="custom-select mr-sm-2" name="id_cliente" id="cliente" onchange="javascript:window.location.href='tickets.php?id=<? echo $id_; ?>&edita=<?php echo $edita ?>&id_cliente='+document.getElementById('cliente').value;">
                      <option>seleccione...</option>
                      <?
                      $consu = "SELECT id_cliente, nombre_cliente FROM clientes;";
                      $resu = mysqli_query($link, $consu);
                      while ($row = mysqli_fetch_array($resu)) {
                        $id_cliente_ = $row["id_cliente"];
                        $nombre_ = $row['nombre_cliente'];
                      ?>
                        <option value=<? echo $id_cliente_; ?> <?if ($id_cliente_==$id_cliente){?>selected<?}?>> <? echo $nombre_; ?></option>
                      <?
                      }
                      ?>
                    </select>
                    <div class="form-group col-4 pl-3">
                    <label> base de datos</label>
                    <select class="custom-select mr-sm-2" name="id_base_datos">
                      <option>seleccione...</option>
                      <?
                        $consu = "SELECT a.id_base_dato, b.nombre_cliente, a.nombre FROM base_dato a, clientes b WHERE a.id_cliente = b.id_cliente AND b.id_cliente = $id_cliente;";
                        echo $consu;
                        $resu = mysqli_query($link, $consu);
                        while ($row = mysqli_fetch_array($resu))
                        {
                          $id_base_dato_ = $row["id_base_dato"];
                          $id_cliente_ = $row["id_cliente"];
                          $nombre_base_dato_ = $row['nombre'];
                        
                      ?>
                        <option value=<? echo $id_base_dato_; ?> <?if ($id_cliente_==$id_cliente){?>selected<?}?>> <? echo $nombre_base_dato_; ?></option>
                      <?
                      }
                      ?>
                    </select> 
                  </div> 
                      </div>
                      <div class="col-12">
                        <label class="form-check-label">Medio de contacto</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="medio_contacto" value="Fono" <?php if ($medio_contacto == "Fono") { ?>checked<? } 
                        ?>>
                        <label class="form-check-label" for="inlineRadio1">Fono</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="medio_contacto" value="Whatsapp" <?php if ($medio_contacto == "Whatsapp") { ?>checked<? } 
                        ?>>
                        <label class="form-check-label" for="inlineRadio2">Whatsapp</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="medio_contacto" value="E-mail" <?php if ($medio_contacto == "E-mail") { ?>checked<? } 
                        ?>>
                        <label class="form-check-label" for="inlineRadio3">E-mail</label>
                      </div>
                      <div class="col-12">
                      <div class="col-6">
                      <label for="precioxlitro">Asunto </label>
                        <input type="text" class="form-control" id="asunto" aria-describedby="asunto" name="asunto" value="<?php echo $asunto;?>" maxlength="30">
                      </div>
                      <div class="col-12 pb-4">
                      <label for="motivo">Contenido </label>
                        <textarea type="text" class="form-control" id="contenido" name="contenido" maxlength="255" minlength="0" rows="3" style="resize: both;"> <?php echo $contenido; ?> </textarea>
                      </div>
                      <div class="custom-file p-4">
                        <input type="file" name="imagen01" class="custom-file-input" id="imagen01">
                        <label class="custom-file-label" for="customFile">Adjunte imagen</label>
                      </div>
                      <div class="custom-file p-4">
                        <input type="file" name="imagen02" class="custom-file-input" id="imagen02">
                        <label class="custom-file-label" for="customFile">Adjunte imagen</label>
                      </div>
                      <div class="custom-file p-4">
                        <input type="file" name="imagen03" class="custom-file-input" id="imagen03">
                        <label class="custom-file-label" for="customFile">Adjunte imagen</label>
                      </div>
                    </div>
                  </div>
                
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary mb-3">Grabar</button>
                </div>
              </div>
            </form>
            <hr>
            </div>
            <!-- Fin div collapse-->
            <label class="h4">Busqueda de ticket</label>
            <div class="text-center justify-content-center p-3">
            	<form action="tickets.php" method="POST">
								<input type="hidden" name="busca" value="<?php echo 1; ?>">
            		<div class="row">
            			<div class="form-group p-2">
              			<label for="nombre">Cliente </label>
                		<br>
                  	<select class="custom-select mr-sm-2" name="id_cliente2" id="cliente2" onchange="javascript:window.location.href='tickets.php?id=<? echo $id_; ?>&id_cliente2='+document.getElementById('cliente2').value;">
                  		<option>seleccione...</option>
                      <?
                      	$consu = "SELECT id_cliente, nombre_cliente FROM clientes;";
                      	$resu = mysqli_query($link, $consu);
                      	while ($row = mysqli_fetch_array($resu))
												{
                      		$id_cliente2_ = $row["id_cliente"];
                        	$nombre2_ = $row['nombre_cliente'];
                      	?>
                        <option value=<? echo $id_cliente2_; ?> <?if ($id_cliente2_==$id_cliente2){?>selected<?}?>> <? echo $nombre2_; ?></option>
                      	<?
                      	}
                      	?>
                    </select>
                    
                  </div>
                <div class="form-group p-2">
                  <label> base de datos</label>
                  <select class="custom-select mr-sm-2" name="id_base_datos2">
                    <option>seleccione...</option>
                    <?
                    $consu = "SELECT a.id_base_dato, b.nombre_cliente, a.nombre FROM base_dato a, clientes b WHERE a.id_cliente = b.id_cliente AND b.id_cliente = $id_cliente2;";
                    // echo $consu;
                    $resu = mysqli_query($link, $consu);
                    while ($row = mysqli_fetch_array($resu))
                    {
                      $id_base_dato2_ = $row["id_base_dato"];
                      $id_cliente2_ = $row["id_cliente"];
                      $nombre_base_dato2_ = $row['nombre'];  
                      ?>
                        <option value=<? echo $id_base_dato2_; ?> <?if ($id_cliente2_==$id_cliente2){?>selected<?}?>> <? echo $nombre_base_dato2_; ?></option>
                      <?
                      }
                      ?>
                    </select> 
                </div>
                <!-- SELECTORES DE FECHA -->
           <div class="form-group">
                <label class="col-form-label">Fecha inicio</label>
                  <div class="col-auto">
                    <input type="date" class="form-control" id="fecha1" name="fecha1" value="<?php echo $fecha1;?>" max="<?php echo $fechalimite; ?>">
                  </div>     
              </div>
              <div class="form-group">
              <label class="col-form-label">Fecha Fin</label>
                  <div class="col-auto">
                    <input type="date" class="form-control" id="fecha2" name="fecha2" value="<?php echo $fecha2;?>" max="<?php echo $fechalimite; ?>">
                  </div>
              </div>
              <div class="form-inline">
              <button type="submit" class="btn btn-primary form-check-label m-1" name="" >Filtrar</button>
              </div>
            </div> 
          </div>
        </form>
            <table class="table table-hover mt-1 col-md-8">
                 <thead class="thead-light">
                   <tr>
                     <th scope="col">#</th>
                     <th scope="col">
                     <span class="d-none d-md-block">Editar</span>
                       <span class="d-block d-md-none">Edit</span>
                     </th>
                     <th>
                       <span class="d-none d-md-block">ESTADO</span>   
                     </th>
                     <th scope="col">CLIENTE</th>
                     <th scope="col">BASE DE DATOS</th>
                     <th scope="col">CONTACTO</th>
                     <th scope="col">ASUNTO</th>
                     <th scope="col">CONTENIDO</th>
                     <th scope="col">IMAGEN 1</th>
                     <th scope="col">IMAGEN 2</th>
                     <th scope="col">IMAGEN 3</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?
											//	BUSQUEDA POR FILTRO
											echo "Busca: ".$busca;
												if ($busca == 1)
												{
													$id_cliente2_ = $_POST["id_cliente2"];
													$id_base_dato2_ = $_POST["id_base_datos2"];
													$fecha1= $_POST["fecha1"];
													$fecha2= $_POST["fecha2"];

														$query = "SELECT * from tickets WHERE fecha BETWEEN '$fecha1' AND '$fecha2' ";
														if ($id_base_dato2_ != "seleccione..." && $id_cliente2_ != "seleccione...")
														{
															$query.= "AND id_cliente = $id_cliente2_ AND id_base_dato = $id_base_dato2_";
														}
														$query.= " ORDER BY activo DESC, id_ticket";
														echo "query del filtro ".$query;
														$result = mysqli_query($link, $query);
														while ($row = mysqli_fetch_assoc($result))
														{
															$id_ = $row["id_ticket"];
															$id2_ = $row["id_cliente"];
															$id_base_dato_ = $row["id_base_dato"];
															$activo_ = $row["activo"];
															$medio_contacto_ = $row["medio_contacto"];
															$asunto_ = $row["asunto"];
															$contenido_ = $row["contenido"];

															$queryNombre = "SELECT nombre_cliente FROM clientes WHERE id_cliente = $id2_";
															$result2 = mysqli_query($link, $queryNombre);
															if ($row1 = mysqli_fetch_assoc($result2))
															{
																$nombre_cliente = $row1["nombre_cliente"];
															}

                              $querynombreBD = "SELECT nombre FROM base_dato WHERE id_base_dato = '$id_base_dato_'";
                              $resultBD = mysqli_query($link, $querynombreBD);
                              if ($row2 = mysqli_fetch_assoc($resultBD))
                              {
                                $nombreBaseDatos = $row2["nombre"];
                              }

															$numero_linea += 1;
														
														//echo $query."\n";
														
											
                    ?>
                   <?if($activo_ == 1){?> <?}else{?><tr class="table-danger"> <?}?>
                       <th scope="row"><?php echo $numero_linea ?></th>
                       <td>
                         <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='tickets.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block"> <i class="far fa-edit" style="color:white;"></i></span></button>
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
                                   <h5 class="modal-title" id="ModalLabel">Activar ticket</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Activar a <strong><?php echo $nombre_cliente; ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-success" onclick="javascript:window.location.href='tickets.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>';">Activar <i class="far fa-check-circle" style="color:white;"></i></button>
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
                                   <h5 class="modal-title" id="ModalLabel">Desactivar ticket</h5>
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                     <span aria-hidden="true">&times;</span>
                                   </button>
                                 </div>
                                 <div class="modal-body" id="modal-body">
                                   Esta seguro que desea Desactivar a <strong><?php echo $nombre_cliente ?></strong>
                                 </div>
                                 <div class="modal-footer">
                                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                   <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='tickets.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>';">Desactivar <i class="far fa-times-circle" style="color:white;"></i></button>
                                 </div>
                               </div>
                             </div>
                           </div>
                           <!-- Fin Modal -->       
                         </td>
                       <? } ?>
                      <td><?php echo $nombre_cliente; ?></td>
                      <td><?php echo $nombreBaseDatos; ?></td>
                      <td><?php echo $medio_contacto_; ?></td>
                      <td><?php echo $asunto_; ?></td> 
                      <td><?php echo $contenido_; ?></td>
                      <td><?php $ruta = "foto1_$id_.jpg"; if (file_exists($ruta)) { echo "<img src='foto1_$id_.jpg' width='200'>";} else { echo "File not found";} ?></td>
                      <td><?php $ruta = "foto2_$id_.jpg"; if (file_exists($ruta)) { echo "<img src='foto2_$id_.jpg' width='200'>";} else { echo "File not found";}?></td>
                      <td><?php $ruta = "foto3_$id_.jpg"; if (file_exists($ruta)) { echo "<img src='foto3_$id_.jpg' width='200'>";} else { echo "File not found";} ?></td>
                     </tr>
                   <?
                    }
									}
                  else{
                  $id_cliente2_ = $_POST["id_cliente2"];
                  $id_base_dato2_ = $_POST["id_base_datos2"];
                  $fecha1= $_POST["fecha1"];
                  $fecha2= $_POST["fecha2"];

                    $query = "SELECT * from tickets ORDER BY activo DESC";
                    echo "query del filtro ".$query;
                    $result = mysqli_query($link, $query);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      $id_ = $row["id_ticket"];
                      $id2_ = $row["id_cliente"];
                      $id_base_dato_ = $row["id_base_dato"];
                      $activo_ = $row["activo"];
                      $medio_contacto_ = $row["medio_contacto"];
                      $asunto_ = $row["asunto"];
                      $contenido_ = $row["contenido"];

                      $queryNombre = "SELECT nombre_cliente FROM clientes WHERE id_cliente = $id2_";
                      $result2 = mysqli_query($link, $queryNombre);
                      if ($row1 = mysqli_fetch_assoc($result2))
                      {
                        $nombre_cliente = $row1["nombre_cliente"];
                      }

                      $querynombreBD = "SELECT nombre FROM base_dato WHERE id_base_dato = '$id_base_dato_'";
                      $resultBD = mysqli_query($link, $querynombreBD);
                      if ($row2 = mysqli_fetch_assoc($resultBD))
                      {
                        $nombreBaseDatos = $row2["nombre"];
                      }

                      $numero_linea += 1;
                    
                    //echo $query."\n";
                    
              
            ?>
           <?if($activo_ == 1){?> <?}else{?><tr class="table-danger"> <?}?>
               <th scope="row"><?php echo $numero_linea ?></th>
               <td>
                 <button type="button" class="btn btn-sm btn-primary" onclick="javascript:window.location.href='tickets.php?id=<? echo $id_ ?>&edita=<?php echo 1 ?>';"><span class="d-block d-md-none"><i class="far fa-edit" style="color:white;"></i></span><span class="d-none d-md-block"> <i class="far fa-edit" style="color:white;"></i></span></button>
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
                           <h5 class="modal-title" id="ModalLabel">Activar ticket</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body" id="modal-body">
                           Esta seguro que desea Activar a <strong><?php echo $nombre_cliente; ?></strong>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                           <button type="button" class="btn btn-success" onclick="javascript:window.location.href='tickets.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>';">Activar <i class="far fa-check-circle" style="color:white;"></i></button>
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
                           <h5 class="modal-title" id="ModalLabel">Desactivar ticket</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body" id="modal-body">
                           Esta seguro que desea Desactivar a <strong><?php echo $nombre_cliente ?></strong>
                         </div>
                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                           <button type="button" class="btn btn-danger" onclick="javascript:window.location.href='tickets.php?id=<? echo $id_ ?>&desactivar=<?php echo 1 ?>';">Desactivar <i class="far fa-times-circle" style="color:white;"></i></button>
                         </div>
                       </div>
                     </div>
                   </div>
                   <!-- Fin Modal -->       
                 </td>
               <? } ?>
              <td><?php echo $nombre_cliente; ?></td>
              <td><?php echo $nombreBaseDatos; ?></td>
              <td><?php echo $medio_contacto_; ?></td>
              <td><?php echo $asunto_; ?></td> 
              <td><?php echo $contenido_; ?></td>
              <td><?php $ruta = "foto1_$id_.jpg"; if (file_exists($ruta)) { echo "<img src='foto1_$id_.jpg' width='200'>";} else { echo "File not found";} ?></td>
              <td><?php $ruta = "foto2_$id_.jpg"; if (file_exists($ruta)) { echo "<img src='foto2_$id_.jpg' width='200'>";} else { echo "File not found";}?></td>
              <td><?php $ruta = "foto3_$id_.jpg"; if (file_exists($ruta)) { echo "<img src='foto3_$id_.jpg' width='200'>";} else { echo "File not found";} ?></td>
             </tr>
                <?
                  }
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