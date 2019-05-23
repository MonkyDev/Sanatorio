<?php  

require_once("../clases/conexion.php");
$db=new conexion();

$value=$_POST['value'];
$sql="SELECT * FROM tbl_pacientes WHERE idpacientes=".$value;
$result=$db->executeQuery($sql);
$row = $db->getRows($result);

$namecomplet=$row['Nombre']." ".$row['Paterno']." ".$row['Materno']; 
$cadena = strtr(strtoupper($namecomplet), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ"); #conversor de cadena a mayusculas respetando acentos
$paciente=$cadena;
	echo $paciente;

?>