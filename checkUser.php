<?php
session_start();
require_once("clases/conexion.php");
require_once("clases/activateLicencer.php");

date_default_timezone_set('America/Mexico_City');
$db = new conexion();
$check = new checkLicense();


$usr=$_POST['usr'];
$pwd=$_POST['psw'];

if(empty($usr) && empty($pwd)){
	echo '0|<b>no hay información';
}
else{
	$sql="SELECT COUNT(*) AS registros FROM rel_licencersusers INNER JOIN cat_licencers ON idlicencias=fk_licencia INNER JOIN tbl_users ON idusers=fk_user WHERE Nick='$usr' ";
	$result=$db->executeQuery($sql);
	$row=$db->getRows($result);
	$registros=$row['registros'];
	if($registros == 0){#quiere decir qe el user ya esta registrado pero no tiene licencia de prueba 
		$flagConsult=1;
			while($flagConsult <= 3){
				if($flagConsult < 2){
					$sql="SELECT idusers,Nick FROM tbl_users WHERE Nick='$usr'";
					$result=$db->executeQuery($sql);
					$row=$db->getRows($result);
					$iduser=$row['idusers'];
				}
				elseif($flagConsult < 3){
					$mes=date('m'); $anhio=date('Y'); $day=date('d');
					$Mes=$check->nextmes($mes);
					$LastdayLicenser=$anhio.'-'.$Mes.'-'.$day;
					$ipUser=$check->getRealIP();
					$sql="INSERT INTO rel_licencersusers 
					VALUES(".$iduser.",1,'".date('Y-m-d')."','".$LastdayLicenser."',1,'".$ipUser."')";
					$db->executeQuery($sql);
				}
				else{
					$sql="SELECT * FROM tbl_users INNER JOIN rel_licencersusers ON idusers=fk_user WHERE idusers='".$usr."' ";
					$result=$db->executeQuery($sql);
					$row=$db->getRows($result);
					$passdecrypt=$check->encriptationdouble(2,$row['Pswd']);
					
					if($row['Nick']==$usr && $passdecrypt==$pwd && $row['tipoLicencia']==1 && $row['edo']==1){ 
						$_SESSION['usuario'] = $row['Name'];
						$_SESSION['pk_user'] = $row['idusers'];
						$_SESSION['cedula'] = $row['Nocedula'];
						$_SESSION['licencia'] = $row['tipoLicencia'];
							
						echo '1|Licencia de Prueba';
					}
					else{
						echo '0|<b>Error de comprobación';
					} 
				}
				
			$flagConsult++;
			}
	}
	else{# en caso qe ya se le haya asignado la prueba vamo a checar la fecha de la prueba actualizar estado de prueba si ya caduco y si ya tiene licencia de prueba que se loguee hasta qe se caduque la prueba y en caso de compra pos que diga producto Original
		$sql="SELECT idusers FROM tbl_users WHERE Nick='$usr'";
		$result=$db->executeQuery($sql);
		$row=$db->getRows($result);
		$iduser=$row['idusers'];
		mysql_free_result($result); 

		$sql="SELECT * FROM rel_licencersusers WHERE fk_user='$iduser' ";
		$result=$db->executeQuery($sql);
		$row=$db->getRows($result);
		
		if($row['tipoLicencia']==1){
			$diferencia=$check->diferenciaentreFechas($row['fechaFin']);
			if($diferencia!=0){
				
				$sql="SELECT * FROM tbl_users INNER JOIN rel_licencersusers ON idusers=fk_user WHERE idusers='$iduser'";
				$result=$db->executeQuery($sql);
				$row=$db->getRows($result);
				$passdecrypt=$check->encriptationdouble(2,$row['Pswd']);
				
				if($row['Nick']==$usr && $passdecrypt==$pwd && $row['tipoLicencia']==1 && $row['edo']==1){ 
					$_SESSION['usuario'] = $row['Name'];
					$_SESSION['pk_user'] = $row['idusers'];
					$_SESSION['cedula'] = $row['Nocedula'];
					$_SESSION['licencia'] = $row['tipoLicencia'];
						
					echo '1|Licencia de Prueba';
					mysql_free_result($result);
				}
				else{
					echo '0|<b>Error de comprobación';
				} 
			}//fin de la diferencia fechas dateOut si no ah vencido
			else{
				$sql="UPDATE rel_licencersusers SET tipoLicencia=0 WHERE fk_user='$iduser'";
				$db->executeQuery($sql);
				echo '0|<b>Mes de prueba caducado';
			}
			mysql_free_result($result);
		}//fin de tipo de licencia
		elseif($row['tipoLicencia']==2){ //licencia pagada
				
				
				
		}
		else
			echo '0|<b>Mes de prueba caducado';
	}//fin else del registro de usuarios

}//fin del else cuando no vacio el registro

?>
