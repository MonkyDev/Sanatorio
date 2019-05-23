<?php
session_start();
include('../clases/consultasRandomDB.php');

  if(isset($_SESSION['pk_user'])){
    $user=$_SESSION['pk_user'];
	
    $querys= new Consultas;


    $val=$querys->getQuerysCountsbyDoctor($user);
    $res=explode('|',$val);
    $misPacientes=$res[0];
    $misConsultas=$res[1];

    $citasFuturas=$querys->getQueryProxCitasDoctor($user);
  }
?>
<!-- ROW  -->
<div class="col-md-4 col-sm-8 col-xs-8">           
      <div class="panel panel-back noti-box">
          <span class="icon-box bg-color-blue set-icon">
              <i class="fa fa-user"></i>
          </span>
          <div class="text-box" >
              <p class="main-text"><?php echo $misPacientes; ?></p>
              <p class="text-muted">Mis Pacientes</p>
          </div>
      </div>
</div>         
<div class="col-md-4 col-sm-6 col-xs-6">           
      <div class="panel panel-back noti-box">
          <span class="icon-box bg-color-green set-icon">
              <i class="fa fa-stethoscope"></i>
          </span>
          <div class="text-box" >
              <p class="main-text"><?php echo $misConsultas; ?></p>
              <p class="text-muted">Consultas</p>
          </div>
      </div>
</div>          
<div class="col-md-4 col-sm-6 col-xs-6">           
      <div class="panel panel-back noti-box">
          <span class="icon-box bg-color-red set-icon">
              <i class="fa fa-bell"></i>
          </span>
          <div class="text-box" >
              <p class="main-text"><?php echo $citasFuturas; ?></p>
              <p class="text-muted">Próximas Citas</p>
          </div>
      </div>
</div>                 
<!-- /. ROW  --> 