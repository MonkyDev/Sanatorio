<?php
require_once("../clases/conexion.php");
$db=new conexion();	

$sql="SELECT *,DATE_FORMAT(Cita,'%d/%m/%Y') AS CitaMod,DATE_FORMAT(Visita,'%d/%m/%Y') AS VisitaMod FROM  tbl_pacientes INNER JOIN  tbl_historial ON Paciente=idpacientes WHERE idHistorial ='".$_GET['idHisto']."' AND edo=1 ";
$result=$db->executeQuery($sql);
$row=$db->getRows($result);

$NameConcatena=$row['categoria'].".".$row['Nombre']." ".$row['Paterno']." ".$row['Materno'];
$NameCompleto= strtr($NameConcatena, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
$Direccion= strtr($row['Direccion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

$meses=array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$fecha[0]=0;
$fecha=explode("/",$row['VisitaMod']);
if($row['CitaMod']!= '00/00/0000'){
	$fech=explode("/",$row['CitaMod']);
	$feCita='El dìa '.$fecha[0]." de ".$meses[$fecha[1]-1]." de ".$fecha[2];
}
else{$feCita="No hay registro de evento";}



    #acentuamos todas las cadenas de texto
    $padecimientoAcentuado =strtr($row['Padecimiento'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    $exploracionAcentuado =strtr($row['Exploracion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    $estudiosAcentuado =strtr($row['Estudios'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    $tratamientoAcentuado =strtr($row['Tratamiento'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

?>
<section>
<div class="panel panel-primary">
    <div class="panel-heading">
        Detalles por consultas
        <i style="margin-left:610px;" class="fa fa-remove" onclick="closeWindow();"></i>   
    </div>
</div>
<div style="padding:7px;">
	<label>FECHA CONSULTA:&nbsp;</label><?php echo $fecha[0]." de ".$meses[$fecha[1]-1]." de ".$fecha[2]; ?><br>
	<label>NOMBRE DEL PACIENTE:&nbsp;</label><i><?php echo $NameCompleto;?></i><br>
	<label>DIRECCION:&nbsp;</label><i><?php echo $Direccion;?></i><br>
	<label>TELEFONO:&nbsp;</label><i><?php echo $row['Telefono']; ?></i><p>
</div>
<div style="padding:7px;text-aling:justify;width:100%;height:500px;overflow-y:auto;">
	<label>Padecimiento:&nbsp;</label>
        <div class="detalles">
            <?php echo $padecimientoAcentuado; ?>
        </div>
    <label>Exploración:&nbsp;</label>
        <div class="detalles">
            <?php echo $exploracionAcentuado; ?>
        </div>
    <label>Estudios:&nbsp;</label>
        <div class="detalles">
            <?php echo $estudiosAcentuado; ?>
        </div>
    <label>Tratamiento:&nbsp;</label>
        <div class="detalles">
            <?php echo $tratamientoAcentuado; ?>
        </div>
    <label>Próxima cita:&nbsp;</label>
        <div class="detalles1">
        	<?php echo $feCita; ?>
        </div>
</div>
</section>
<style>
i:hover{
	cursor:pointer;
}
</style>