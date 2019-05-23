<?php
session_start();
require_once("../clases/conexion.php");
$db=new conexion();	

$sql="SELECT * FROM tbl_pacientes WHERE idpacientes = ".$_GET['id']." AND edo=1";
$result=$db->executeQuery($sql);
$row=$db->getRows($result);
$NameCompleto=$row['categoria'].".".$row['Nombre']." ".$row['Paterno']." ".$row['Materno'];
$NameCompleto= strtr($NameCompleto, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
$Direccion= strtr($row['Direccion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
$nameDoctor=strtr($_SESSION['usuario'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha[0]=0;
$fecha=explode("-",$row['Registro']);
$x=0; $y=0;
	if($fecha[1] && $x[1] && $y[1] <10){
		$e="''"+$fecha[1]; //LE QUITO EL CERO AL MES PARA PODER COMPARARLO CON EL ARRAY
		$m="''"+$x[1];
		$me="''"+$y[1];
	}
	else{
		 $e=$fecha[1];
		 $m=$x[1];
		 $me=$y[1];
	}
?>
<div class="consultorio">
    <div class="image"></div>
    <div class="image2"></div>
    <div class="info">
    	<label style="font-family: 'Tangerine', serif;font-size: 48px;text-shadow: 4px 4px 4px #aaa;"><?php echo 'Dr.'.$nameDoctor; ?></label>
        <label>INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS</label><br />
        <label>MEDICO GENERAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CED.PROF.<?php echo $_SESSION['cedula']?></label><br />
        <label>CONSULTORIO PRIVADO</label>
    </div>
    <label style="float:right;margin-top:45px;">FECHA: <?php echo date('d/m/Y') ?></label>
</div>
<div class="infPaci">
	<label>FECHA REGISTRO:&nbsp;</label><?php echo $fecha[2]." de ".$meses[$e-1]." de ".$fecha[0] ?><br>
	<label>NOMBRE DEL PACIENTE:&nbsp;</label><i><?php echo $NameCompleto?></i><br>
	<label>DIRECCION:&nbsp;</label><i><?php echo $Direccion?></i><br>
	<label>TELEFONO:&nbsp;</label><i><?php echo $row['Telefono'] ?></i>
    
</div>
<?php
$sql="SELECT * FROM tbl_pacientes INNER JOIN tbl_historial ON idpacientes=Paciente WHERE idpacientes =".$_GET['id']." AND edo=1";
$result=$db->executeQuery($sql);
?>
<section class="consultas">
<div id="formulario" class="form">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <div style="font-size:15px;">Historial medico por paciente</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive" style="height:410px;">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="200">Consulta</th>
                            <th>Padecimiento</th>
                            <th width="210">Cita</th>
                            <th width="20">Asistio</th>
                            <th width="20" style="text-align:center;"><i class="fa fa-print" title="imprimir"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($row=$db->getRows($result)) {     
                            $meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
							$fecha=explode("-",$row['Visita']);
								if($fecha[1] && $x[1] && $y[1] <10){
									$e="''"+$fecha[1]; //LE QUITO EL CERO AL MES PARA PODER COMPARARLO CON EL ARRAY
									$m="''"+$x[1];
									$me="''"+$y[1];
								}
								else{
									 $e=$fecha[1];
									 $m=$x[1];
									 $me=$y[1];
								}  

                            $padecimientoAcentuado =strtr($row['Padecimiento'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

                        ?>
                        <tr>
                            <td onclick="displayWindow('800','700');cargaPantalla('historial/detalleporConsult.php?idHisto='+<?php echo $row['idHistorial'];?>,'window');">
							<?php echo $fecha[2]." de ".$meses[$e-1]." de ".$fecha[0]; ?></td>
                            <td onclick="displayWindow('800','700');cargaPantalla('historial/detalleporConsult.php?idHisto='+<?php echo $row['idHistorial'];?>,'window');">
    							<?php
                                    if(strlen($padecimientoAcentuado)>=80){
                                        $padecimientoControl=substr($padecimientoAcentuado,0,70);
                                        echo $padecimientoControl.'...'; 
                                    }
                                    else{
                                        $padecimientoControl=$padecimientoAcentuado;
                                        echo $padecimientoControl;
                                    }
                                 ?>
                             </td>
                            <td onclick="displayWindow('800','700');cargaPantalla('historial/detalleporConsult.php?idHisto='+<?php echo $row['idHistorial'];?>,'window');">
                            	<?php if($row['Cita']!=0){
	                            		$r=explode("-",$row['Cita']);
	                            		echo "El dia ".$r[2]." de ".$meses[$r[1]-1]." de ".$r[0];
                            		}else echo 'No hay cita';
                            	?>
                            </td>
                            <td align="center"  onclick="displayWindow('800','700');cargaPantalla('historial/detalleporConsult.php?idHisto='+<?php echo $row['idHistorial'];?>,'window');">
                                <?php if($row['Asistencia']==1) echo 'Si'; elseif($row['Asistencia']==2) echo 'No'; else echo '--';?> 
                            </td>
                            <td style="text-align:center;" 
                            onclick="printReportPDF(<?php echo $_GET['id'] ?>,<?php echo $row['idHistorial'] ?>);">
                                <i class="fa fa-file-pdf-o" title="pdf"></i>
                            </td>
                        </tr>                    
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</section>
<style>
td:hover{
	cursor:pointer;
}
</style>