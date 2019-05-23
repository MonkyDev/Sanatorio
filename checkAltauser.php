<?php
require_once("clases/conexion.php");
require_once("clases/activateLicencer.php");

$db= new conexion();
$check= new checkLicense();


if(isset($_POST)){
	extract($_POST);

	$sql="SELECT Nocedula AS existe FROM tbl_users WHERE Nocedula='$cedula' OR Nick='$nick_name'";
	$result=$db->executeQuery($sql);
	$row=$db->getRows($result);
	if(empty($row['existe'])){ #empty or NULL or "" utilizan cuando una busqueda esta vacia
		$encryptpass=$check->encriptationdouble(1,$pass);
		$namecomplet=$name.' '.$patern.' '.$matern;
		$sql="INSERT INTO tbl_users (Name,Nick,Pswd,Nocedula,Sexo,edo) 
		VALUES('".$namecomplet."', '".$nick_name."', '".$encryptpass."', ".$cedula.", ".$sex.", 1)";
			$db->executeQuery($sql);

	echo '1'.'|'.$nick_name.'|'.$encryptpass;
	}
	echo '0'.'|'.'existe coincidencia de usuarios';
}
?>