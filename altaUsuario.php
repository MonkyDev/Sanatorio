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
       
 	<script src="js/jquery-2.2.1.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>  
	<script src="alertifyjs/alertify.js"></script>
  <script src="js/generales.js" type="text/javascript"></script>
  <script src="js/accionesEventos.js" type="text/javascript"></script>
    
</head>
<body>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <br /><br />
                <h2><img src="images/user.png" width="150"></h2>
                <br />
            </div>
        </div>
         <div class="row ">
               
                  <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                        <strong>   Registre sus datos </strong> 
                         <a href="login.php" style="float:right;">atrás</a>
                            </div>
                            <div class="panel-body">
                                <form role="form" id="f_registroDoctores">
                                       <br />
                                    <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user-md"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="cédula" name="cedula" onkeypress="return jumpEnter(event,this)" maxlength="8" autofocus />
                                        </div>

                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-user "  ></i></span>
                                            <input type="text" class="form-control" placeholder="nombre " name="name" onkeypress="return jumpEnter(event,this)"/>
                                        </div>
                                     
                                     <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-list-alt"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="paterno" name="patern" onkeypress="return jumpEnter(event,this)"/>
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-list-alt"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="materno" name="matern" onkeypress="return jumpEnter(event,this)"/>
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <input type="text" class="form-control"  placeholder="nick_name" name="nick_name" onkeypress="return jumpEnter(event,this)"/>
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-tag"  ></i></span>
                                            <select class="form-control" name="sex" onkeypress="return jumpEnter(event,this)">
                                                <option value="0">selecione</option>
                                                <option value="1">másculino</option>
                                                <option value="2">femenino</option>
                                            </select>
                                        </div>

                                        <div class="form-group input-group">
                                            <span class="input-group-addon"><i class="fa fa-key"  ></i></span>
                                            <input type="password" class="form-control"  placeholder="pass" name="pass" onkeypress="return jumpEnter(event,this)"/>
                                        </div>
                                        <center>
                                      <a href="#" onClick="registrer('f_registroDoctores','form-control');" id="enviar" class="btn btn-primary">registrarse</a>
                                        </center>
                                    <hr/>
                                        <div class="alert alert-danger" style="display:none;" id="error">
                                          <center>Debe rellenar los campos requeridos.</center>
                                        </div>
                                     </form>
                            </div>
                           
                        </div>
                    </div>
        </div>
    </div>
   
</body>
</html>