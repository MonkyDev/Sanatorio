<?php 

require_once("../clases/conexion.php");
$db=new conexion();

$value=$_POST['value'];
$sql="SELECT * FROM tbl_pacientes WHERE Nombre LIKE '%".$value."%' LIMIT 3";
$result=$db->executeQuery($sql);
$reg=$db->getNRows($result);
if($reg>0 and $value !=''){
	while($row = $db->getRows($result)){
?>
	<div id="res" onclick="result(<?php echo $row['idpacientes']?>)" style="background-color:#f1f1f1;margin-bottom:10px;width:100%;padding:2px;">
		<?php
			$namecomplet=$row['Nombre']." ".$row['Paterno']." ".$row['Materno']; 
	        $cadena = strtr(strtoupper($namecomplet), "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ"); #conversor a mayuscula respetando acento
	        $paciente=$cadena;
				echo $paciente;
		?>
	</div>
<?php
	}
}
?>