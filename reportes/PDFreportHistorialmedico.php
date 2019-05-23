<?php
session_start();
require_once("../clases/conexion.php");
$db=new conexion();	

require_once("../clases/fpdf/fpdf.php");
require_once("../clases/mpdf/mpdf.php");
	$today = date("d-m-Y");
	$fecha = date("d/m/Y");
	$nom_archivo='PDFreportHistorialmedico_'.$fecha.'.pdf';


//verificamos si exixte la variable en la url
if(isset($_GET['idpaci'])){
	$fk_paciente=$_GET['idpaci'];
	$Noregistrohistorial=$_GET['idHisto'];
	
	$sql="SELECT *,DATE_FORMAT(Cita,'%d/%m/%Y') AS CitaMod,DATE_FORMAT(Visita,'%d/%m/%Y') AS VisitaMod FROM tbl_pacientes INNER JOIN tbl_historial ON Paciente=idpacientes WHERE idHistorial =".$_GET['idHisto']." AND idpacientes= ".$_GET['idpaci']." AND edo=1 ";
	$result=$db->executeQuery($sql);
	$row=$db->getRows($result);
	
	$NameCompleto=$row['categoria'].".".$row['Nombre']." ".$row['Paterno']." ".$row['Materno'];
	$doctor= strtr($_SESSION['usuario'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
	$NameCompleto= strtr($NameCompleto, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
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
	$padecimientoAcentuado=strtr($row['Padecimiento'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
	$exploracionAcentuado=strtr($row['Exploracion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
	$estudiosAsentuados=strtr($row['Estudios'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
	$tratamientoAsentuados=strtr($row['Tratamiento'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

	
$html='
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Documento sin t&iacute;tulo</title>
	<style>
	.encabezado{
		font-family: "Tangerine", serif;
		font-size: 25px;
		text-shadow: 3px 2px 2px #aaa;
	}
	</style>
	<style>
	.encabezado{
		font-family: "Tangerine", serif;
		font-size: 25px;
		text-shadow: 3px 2px 2px #aaa;
	}
	.letras{
		font-family: "Tangerine", serif;
		font-size: 14px;
	}
	.paciente{
		font-family: "Tangerine", serif;
		font-size: 11px;
¡	}
	.textoreceta{
		font-family: "Tangerine", serif;
		font-size: 11px;
		padding:2px;
	}
	.pie{
		font-family: "Tangerine", serif;
		font-size:11px;
		width:400px;
		margin-top:135px;
		text-align:center;
	}
	</style>
	</head>

	<body>
		<table width="840" border="0" align="center">
			<tr>
			    <td width="105" colspan="1" rowspan="5"><img src="../images/LogoMedicina.png" width="105"></td>
			    <td width="105" colspan="9">&nbsp;</td>
			    <td width="105" style="padding:-60px;" colspan="1" rowspan="5"><img src="../images/logo.png" style="width:240px;"></td>
			</tr>
			<tr>
			    <td width="105" height="20" colspan="9" class="encabezado"><center><strong>'.'Dr. '.$doctor.'</strong></center></td>
			</tr>
			<tr>
			    <td width="105" height="20" colspan="9" class="letras"><center>'.'MEDICO GENERAL&nbsp;&nbsp;&nbsp;CED.PROF.'.$_SESSION['cedula'].'</center></td>
			</tr>
			<tr>
			    <td width="105" height="20" colspan="9" class="letras"><center>'.'INSTITUTO DE ESTUDIOS SUPERIORES DE CHIAPAS'.'</center></td>
			</tr>
			<tr>
			    <td width="105" height="20" colspan="9" class="letras"><center>'.'CONSULTORIO PRIVADO'.'</center></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
		</table>
		<table width="840" border="0" align="center">
			<tr>
			    <td width="105" colspan="9" class="paciente"><b>'.'NOMBRE DEL PACIENTE: '.'</b>'.$NameCompleto.'</td>
			    <td width="105" colspan="1" class="paciente" ><b>'.'EDAD: '.'</b>'.$row['Edad'].' años'.'</td>
			    <td width="105" colspan="2" class="paciente" align="right"><b>'.'FECHA: '.'</b>'.$row['VisitaMod'].'</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</table>
		<table width="840" border="0" align="center" style="text-align:justify;">
			<tr>
				<td width="105" colspan="9" class="paciente"><b>Padecimiento</b></td>
			</tr>
			<tr>
				<td width="105" colspan="9" class="textoreceta"><i>'.trim($padecimientoAcentuado).'<i/></td>
			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			<tr>
				<td width="105" colspan="9" class="paciente"><b>Exploración</b></td>
			</tr>
			<tr>
				<td width="105" colspan="9" class="textoreceta"><i>'.trim($exploracionAcentuado).'<i/></td>
			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			<tr>
				<td width="105" colspan="9" class="paciente"><b>Estudios</b></td>
			</tr>
			<tr>
				<td width="105" colspan="9" class="textoreceta"><i>'.trim($estudiosAsentuados).'<i/></td>
			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			<tr>
				<td width="105" colspan="9" class="paciente"><b>Tratamiento</b></td>
			</tr>
			<tr>
				<td width="105" colspan="9" class="textoreceta"><i>'.trim($tratamientoAsentuados).'<i/></td>
			</tr>
				<tr>
					<td>&nbsp;</td>
				</tr>
			<tr>
				<td width="105" colspan="9" class="paciente"><b>Próxima cita</b></td>
			</tr>
			<tr>
				<td width="105" colspan="9" class="textoreceta"><i>'.$feCita.'<i/></td>
			</tr>

		</table>

		<table width="840" border="0" align="center" class="pie">
			<tr>
				<td width="105" colspan="9" class="pie"><b>ARRIAGA, CHIAPAS</b></td>
			</tr>
			<tr>
				<td width="105" colspan="9" class="pie"><b>CEL. 961 269 1599</b></td>
			</tr>
		</table>

	</body>

</html>
';
 
#$res = $html . $html4 . $html3;
}
else{
	$html = "Lo Sentimos No Se Pudo Realizar la Consulta";
}
	
	$mpdf=new mPDF('utf-8','Letter','',''); 
	$mpdf->AddPage('P');
	$mpdf->WriteHTML($html);
	$mpdf->Output($nom_archivo, 'I');

?>