<?php

session_start();
require_once("../clases/conexion.php");
$db=new conexion();

if(isset($_POST)){
	extract($_POST);
	if(empty($ced_usr) && empty($psw)){
		echo 0;
	}
	else{
		$sql="SELECT idusers,Pswd,edo FROM tbl_users WHERE idusers='".$ced_usr."' ";
		$result=$db->executeQuery($sql);
		$row=$db->getRows($result);

			if($row['idusers']==$ced_usr && $row['Pswd']==$psw && $row['edo']==1){ 
				echo 1;
			}
			else{
				echo 0;
			}
	}
}
else{
	echo 0;
}

?>
