<?php 
session_start();
header("Content-Type: text/text; charset=ISO-8859-1");
    require_once("../clases/conexion.php");
    $db=new conexion();
    $sql="SELECT idpacientes,categoria,Nombre,Paterno,Materno,fk_doctor,fk_historial,fk_paciente,idhistorial,Asistencia,HrCita,Cita FROM rel_consultas INNER JOIN tbl_historial ON idhistorial=fk_historial INNER JOIN tbl_pacientes ON idpacientes=fk_paciente WHERE fk_doctor=".$_SESSION['pk_user']." AND Asistencia=0 AND Cita=CURDATE() ORDER BY HrCita ASC "; 
    $result=$db->executeQuery($sql);
?>
<section>
<div id="formulario" class="form">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <div style="font-size:15px;">Citas el dia de Hoy</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Paciente</th>
                            <th width="80">Hora</th>
                            <th width="30" colspan="2" style="text-align:center;"><i class="fa fa-edit"></i></th>
                        </tr>
                    </thead>
                    <tbody align="center">
                        <?php 
                            while($row=$db->getRows($result)) {                           
                        ?>
                        <tr>
                            <td><?php echo utf8_decode($row['categoria'].".".$row['Nombre']." ".$row['Paterno']." ".$row['Materno']); ?></td>
                            <td>
                            <?php $h=explode(":",$row['HrCita']);
                                if($h[2]=='01'){
                                  echo  str_replace(':01',' am',$row['HrCita']);
                                }
                                else{
                                    echo  str_replace(':02',' pm',$row['HrCita']);
                                }
                            ?>
                            </td>
                            <td>
                                <i class="fa fa-check" onclick="pasaLista(<?php echo $row['idpacientes']?>,<?php echo $_SESSION['pk_user']?>)">
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
#form{
    width:100%;
    height: 10%;
}
i:hover{
    cursor: pointer;
}
</style>