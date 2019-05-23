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
  <link rel="stylesheet" type="text/css" href="alertifyjs/css/themes/default.css">
  <link rel="stylesheet" type="text/css" href="alertifyjs/css/alertify.css">
	<link rel="stylesheet" type="text/css" href="css/datepicker.css">
    <link rel="stylesheet" type="text/css" href="css/jquery.timepicker.css">
       
 	<script src="js/jquery-2.2.1.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>  
	<script src="alertifyjs/alertify.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.js"></script>
  <script src="js/generales.js" type="text/javascript"></script>
  <script src="js/accionesEventos.js" type="text/javascript"></script>
    
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br /><br />
                <h2><img src="images/doctorLogin.jpg" width="150"></h2>
                <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Ingese sus datos correctamente </strong>  
                            </div>
                            <div class="panel-body">
                                <form role="form">
                                       <br />
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-md"  ></i></span>
                                            <input type="text" class="form-control" placeholder="Escriba su nick " id="nick" onkeypress="return jumpEnter(event,this)" autofocus />
                                        </div>
                                     
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"  ></i></span>
                                            <input type="password" class="form-control"  placeholder="Escriba su contrase&ntilde;a" id="pass"  onkeyup="if(validateTecla(event)=='enter'){checkUser();}"/>
                                        </div>
                                     <a href="#" onClick="checkUser();" class="btn btn-primary ">iniciar sesi&oacute;n ahora</a>
                                    <hr />
                                    <center><a href="altaUsuario.php" style="color:#F00;">REGISTRARSE</a></center>
                                     </form>
                            </div>
                           
                        </div>
                    </div>
        </div>
    </div>
   
</body>
</html>