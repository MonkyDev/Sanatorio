<?php
	require_once("../clases/conexion.php");
	$db = new conexion();
	$id=$db->genIndex('tbl_pacientes',0);
	$ide=$db->genIndex('tbl_historial',0);
	$id2=$db->genIndex('rel_consultas',0);


date_default_timezone_set('America/Mexico_City'); 
	switch($_POST['acc']){
		case 1:
			$sql="INSERT INTO tbl_pacientes 
			VALUES(".$id.",'".$_POST['nom']."','".$_POST['pat']."','".$_POST['mat']."','".$_POST['dir']."','".$_POST['tel']."',".$_POST['edd'].",'".date('Y-m-d')."','".$_POST['cat']."',".$_POST['ced'].",1)";
			$db->executeQuery($sql);
				echo 1;
		break;
		case 2:	
				$ejecuto=1;
				if($db->startTransaction()){
						$sql="INSERT INTO tbl_historial 
					VALUES(".$ide.",'".$_POST['pade']."','".$_POST['expl']."','".$_POST['estu']."','".$_POST['trat']."','".$_POST['cita']."',".$_POST['paci'].",'".date('Y-m-d')."','".$_POST['hra']."',0)";
						if(!$result=$db->execQueryTrans($sql))
							$ejecuto=0;
				}
				$ejecuto=1;
				if($db->startTransaction()){ 
						$sql="INSERT INTO rel_consultas 
						VALUES(".$id2.",".$_POST['cedDoc'].",".$ide.",".$_POST['paci'].",'".date('Y-m-d')."','".date('H:i:s')."',1)";
						if(!$result=$db->execQueryTrans($sql))
							$ejecuto=0;
				}
				if($ejecuto){
					$db->commitTransaction();
					echo 1;
				}
				else{
					$db->breakTransaction();
					echo "0|ERROR: " . $db->_error;
				}		 
	
		break;
		case 3:
			$sql="UPDATE tbl_historial SET Asistencia=".$_POST['asis']." WHERE Paciente=".$_POST['paci']." AND Cita=CURDATE()";
			$db->executeQuery($sql);
				echo 1;
		break;
		case 4:
			$sql="UPDATE tbl_pacientes SET edo=2 WHERE idpacientes=".$_POST['idpaci']." AND Doctor=".$_POST['cedDoc']." ";
			$db->executeQuery($sql);
				echo 1;
		break;
		case 5:
			$sql="UPDATE tbl_pacientes SET Nombre='".$_POST['nom']."',Direccion='".$_POST['dir']."',Telefono='".$_POST['tel']."',Edad=".$_POST['edd']." WHERE idpacientes=".$_POST['idpaci']." AND Doctor=".$_POST['cedDoc']." AND edo=1 ";
			$db->executeQuery($sql);
				echo 1;
		break;
	}

?>