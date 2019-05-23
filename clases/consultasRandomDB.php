<?php 
require_once("../clases/conexion.php");

class Consultas{

  public function getQuerysCountsbyDoctor($pk_user){
  	$db = new conexion();
    $flag=1;
    while($flag<=2){ 
      #generalizamos los pacientes que hemos registrado en total
      if($flag<2){
         $sql="SELECT count(idpacientes) AS totalPaci FROM tbl_pacientes WHERE edo=1 AND Doctor=".$pk_user." ";
         $result=$db->executeQuery(trim($sql));
         $row=$db->getRows($result);
         $misPacientes=$row['totalPaci'];
      }else{
          #consultas del dia de hoy por doctor
        $sql="SELECT count(idconsultas) AS totalConsu FROM rel_consultas WHERE fecha=CURDATE() AND fk_doctor=".$pk_user.""; 
        $result=$db->executeQuery(trim($sql));
        $row=$db->getRows($result);
        $misConsultas=$row['totalConsu'];
      }
      $flag++;
    }
    return($misPacientes.'|'.$misConsultas);
  }

  public function getQueryProxCitasDoctor($doctor){
 	$db = new conexion();
    $flag=1;
    while ($flag <= 2) {
      if($flag < 2){
        /*$sql="SELECT fk_doctor,fk_paciente,Paciente,Asistencia,Cita AS Proxima FROM tbl_historial INNER JOIN rel_consultas ON fk_paciente=Paciente WHERE fk_doctor=".$doctor." AND Asistencia=0 ORDER BY Cita DESC";*/
        $sql="SELECT fk_doctor,fk_historial,fk_paciente,idhistorial,Asistencia,Cita AS Proxima FROM rel_consultas INNER JOIN tbl_historial ON idhistorial=fk_historial WHERE fk_doctor=".$doctor." AND Asistencia=0 ORDER BY Proxima DESC";
        $result=$db->executeQuery(trim($sql));
        $row=$db->getRows($result);
        $proximaCita=$row['Proxima'];
      }else{
        if($proximaCita!=""){
        #citas para hoy
        $sql="SELECT count(Cita) AS citasHoy FROM  tbl_historial WHERE Cita BETWEEN CURDATE() AND '".$proximaCita."' AND Asistencia=0";
        $result=$db->executeQuery(trim($sql));
        $row=$db->getRows($result);
        $citasFuturas=$row['citasHoy'];
          return($citasFuturas);
        }else {
          return(0);
        }

      }
    $flag++;  
    }

  }

}

?>