<?php 
session_start();
header("Content-Type: text/text; charset=ISO-8859-1");
    require_once("../clases/conexion.php");
    $db=new conexion();
    $sql="SELECT * FROM tbl_pacientes WHERE edo=1 AND Doctor=".$_SESSION['pk_user']." ORDER BY idpacientes DESC LIMIT 5"; 
    $result=$db->executeQuery($sql);
?>
<section>
<div id="formulario" class="form">
    <div class="panel panel-primary">
        <div class="panel-heading">
           <div style="font-size:15px;">Pacientes recien agregados</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th width="140">Telefono</th>
                            <th width="70">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            while($row=$db->getRows($result)) {                           
                        ?>
                        <tr>
                            <td><?php echo utf8_decode($row['categoria'].".".$row['Nombre']); ?></td>
                            <td><?php echo $row['Telefono']; ?></td>
                            <td><?php if($row['edo']==1) echo 'Activo'; else echo 'Borrado';  ?></td>
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
</style>