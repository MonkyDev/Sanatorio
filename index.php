<?php
session_start();
	if(!isset($_SESSION['usuario']))
		header("Location:login.php");
  $SessionameUser= strtr($_SESSION['usuario'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
date_default_timezone_set('America/Mexico_City');

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Sanatorio</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    
  <link type="image/x-ico" href="icon/iconMedic.png" rel="icon">
 	<link href="assets/css/bootstrap.css" rel="stylesheet"/>
 	<link href="assets/css/font-awesome.css" rel="stylesheet"/>
 	<link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
  <link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="css/datepicker.css">
  <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
  <link href="assets/js/dataTables/dataTables.bootstrap.css" rel="stylesheet" /> 
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Tangerine">


	<script src="js/jquery-2.2.1.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="alertifyjs/alertify.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.js"></script>
  <script src="js/generales.js" type="text/javascript"></script>
  <script src="js/accionesEventos.js" type="text/javascript"></script>
  <script src="assets/js/dataTables/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
  <!--<script src="js/OutsetSession.js" type="text/javascript"></script>-->

</head>

<body>
<section class="fullcontent">
<?php
isset($_SESSION['licencia']); 
if($_SESSION['licencia']==1){
	echo '<center><b>Licencia de Prueba</b></center>';
}else{
	echo '<center><b>Producto Original</b></center>';
}
?>
	<div id="backScreen"></div>
  <div id="window"></div>
    
	<div id="wrapper">
    <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
      <div class="navbar-header">
          <a class="navbar-brand" href="#"><i class="fa fa-user-md fa-2x"></i>&nbsp;<?php echo $_SESSION['usuario']?></a> 
      </div>
      <div style="color: white;padding: 15px 50px 5px 50px;float: right;font-size: 16px;"> 
        <a class="btn btn-danger square-btn-adjust" onclick="salir();" style="border-radius:3px;width:80px;">Salir</a>
        <button type="button" class="btn btn-primary btn-circle" title="Copia de seguridad" id="backup">
        <input type="hidden" id="cedula" value="<?php echo $_SESSION['pk_user']; ?>">
          <i class="fa fa-cloud-download"></i>
        </button> 
      </div>
      <div class="menu">
        <a class="active-menu"  href="index.php"><i class="fa fa-home fa-2x"></i> Inicio</a>&nbsp;&nbsp; 
        <a class="active-menu"  href="#" onclick="cargaPantalla('pacientes/nuevoPaciente.php','content');">
          <i class="fa fa-male fa-1x"></i>&nbsp;Pacientes
        </a>&nbsp;&nbsp;
        <a class="active-menu"  href="#" onclick="cargaPantalla('historial/buscarHistorial.php','content');">
          <i class="fa fa-book fa-1x"></i> Historial Medico
        </a>&nbsp;&nbsp;
        <a class="active-menu"  href="#" onclick="cargaPantalla('consultas/consultaPaciente.php','content');">
         <i class="fa fa-tags fa-1x"></i> Consultas Medicas
        </a>
      </div>
    </nav>
  </div>
 <div id="cuerpo" class="cuerpo">
  <div id="content" class="content">
  <div id="banner" class="banner"><script>cargaPantalla('noticias/bannerNoticias.php','banner');</script></div>
    <div  id="notific" class="notific"><script>cargaPantalla('consultas/bannerNotific.php','notific');</script></div>
      <div id="agregados" class="adds"><script>cargaPantalla('pacientes/recienAgregados.php','agregados');</script></div>
      <div id="citas" class="citas"><script>cargaPantalla('pacientes/proximasCitas.php','citas');</script></div>
    </div>
  </div>
</section>
    <div style="margin-top:-25px; float:left; margin-left: 150px;">
      <a onclick="acerca()"><i><u>Acerca de</u></i></a>
    </div> 
    <div style="margin-top:-25px; float: right; margin-right: 150px;">
      <i>Todos los derechos reservados 2017</i>
    </div>  
</body>
</html>