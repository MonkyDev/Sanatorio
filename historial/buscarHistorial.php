<?php 
session_start();
    require_once("../clases/conexion.php");
    $db=new conexion();
    $sql="SELECT * FROM  tbl_pacientes WHERE edo=1 AND Doctor=".$_SESSION['pk_user']." "; 
    $result=$db->executeQuery($sql);
?>
<section>
<div id="formulario" class="form">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <div style="font-size:15px;">Ver pacientes atentidos</div>
        </div>
        <!-- Advanced Tables -->
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                             <thead>
                                <tr>
                                    <th width="260">Paciente</th>
                                    <th>Direccion</th>
                                    <th width="140">Telefono</th>
                                   <th width="30" style="text-align: center;"><i class="fa fa-trash" title="eliminar"></i></th>
                                   <th width="30" style="text-align: center;"><i class="fa fa-gear" title="editar"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while($row=$db->getRows($result)) {  
                                    $NameCompleto=$row['categoria'].".".$row['Nombre']." ".$row['Paterno']." ".$row['Materno'];
                                    $NameCompleto= strtr($NameCompleto, "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
                                    $Direccion= strtr($row['Direccion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

                                ?>
                                <tr>
                                    <td onclick="cargaPantalla('historial/historialMed.php?id='+<?php echo $row['idpacientes']?>,'content');">
                                    <?php echo $NameCompleto; ?></td>
                                    <td onclick="cargaPantalla('historial/historialMed.php?id='+<?php echo $row['idpacientes']?>,'content');"><?php echo $Direccion; ?></td>
                                    <td onclick="cargaPantalla('historial/historialMed.php?id='+<?php echo $row['idpacientes']?>,'content');"><?php echo $row['Telefono']?></td>
                                    <td style="text-align: center;">
                                    <i class="fa fa-times" title="borrar" onclick="accDeletePac(1,<?php echo $row['idpacientes']?>,<?php echo $_SESSION['pk_user']?>)">                          
                                    </i>
                                    </td>
                                    <td style="text-align: center;">
                                    <i  class="fa fa-refresh" title="actualizar" onclick="displayWindow('650','500');cargaPantalla('pacientes/actualizarDatos.php?idPaci='+<?php echo $row['idpacientes']?>,'window');">                          
                                    </i> 
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
            <!--End Advanced Tables -->
    </div>
</div>
</section>
<style>
#form{
    width:100%;
    height: 10%;
}
i{
    cursor: pointer;
}
td:hover{
    cursor: pointer;
}
</style>
<script>
    $(document).ready(function () {
        $('#dataTables-example').dataTable();
    });
</script>