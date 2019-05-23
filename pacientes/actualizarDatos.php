<?php 
session_start();

    require_once("../clases/conexion.php");
    $db = new conexion();

    $sql="SELECT * FROM tbl_pacientes WHERE idpacientes=".$_GET['idPaci']." AND edo=1 AND Doctor";
    $result=$db->executeQuery($sql);
    $row=$db->getRows($result);


    $Nombre= strtr($row['Nombre'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    $Paterno= strtr($row['Paterno'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    $Materno= strtr($row['Materno'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");
    $Direccion= strtr($row['Direccion'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

?> 
<section>
<div id="formulario">
	 <div class="panel panel-primary">
                    <div class="panel-heading">
                    	Actualizar datos
                        <i style="margin-left:500px;" class="fa fa-remove" onclick="closeWindow();"></i>   
                    </div>
                    <div class="panel-body" style="height:405px;">
                    	<form id="pacientes" name="pacientes"><center>
                        	<table width="550">
                            <input type="hidden" id="idpaci" value="<?php echo $_GET['idPaci']; ?>">
                            <input type="hidden" id="ced" value="<?php echo $_SESSION['pk_user']; ?>">
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                        			<tr>
                        				<td>Nombre del paciente: </td>
                        				<td>
                        				<input class="form-control" name="Nombre" id="nom" value="<?php echo $Nombre?>"  type="text" onkeypress="return jumpEnter(event,this)" autofocus />
                        				</td>
                        			</tr>
									<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
                                    <tr>
                                        <td>Apellido paterno: </td>
                                        <td>
                                        <input class="form-control" name="Paterno"  value="<?php echo $Paterno?>"  type="text" readonly onkeypress="return jumpEnter(event,this)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Apellido materno: </td>
                                        <td>
                                        <input class="form-control" name="Materno"  value="<?php echo $Materno?>" type="text" readonlyonkeypress="return jumpEnter(event,this)" readonly/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                        			<tr>
                        				<td>Direcci&oacute;n: </td>
                        				<td>
                        				<input class="form-control" name="Direccion" id="dir" value="<?php echo $Direccion?>" 
                                        type="text" onkeypress="return jumpEnter(event,this)" />
                        				</td>
                        			</tr>
                        			<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
									<tr>
                        				<td>Tel&eacute;fono: </td>
                        				<td>
                        				<input class="form-control" name="Telefono" id="tel" value="<?php echo $row['Telefono']?>" type="text" maxlength="15" onkeypress="return jumpEnter(event,this)" />
                        				</td>
                        			</tr>
                        			<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
									<tr>
                        				<td>Edad:</td>
                        				<td>
                                        <input class="form-control" name="Edad" id="edd" value="<?php echo $row['Edad']?>" 
                                        maxlength="2" type="text" 
                                        onkeyup="if(validateTecla(event)=='enter'){accUpdateDataPac(1,<?php echo $_GET['idPaci']?>);}" />
                        				</td>
                        			</tr>
                        	</table>                        		
                    	</form></center>
                    </div>
                    <div class="panel-footer">
                        <input type="button" class="btn btn-success" id="boton" value="Actualizar" onclick="accUpdateDataPac(1,<?php echo $_GET['idPaci']?>);" />
                        <!--<input type="button" class="btn btn-danger" id="eliminar" value="Eliminar" onclick="Actioncheck(2,'');" />-->
                    </div>
                </div>
</div>
</section>
<style>
#form_clie{
	margin: auto;
	width:550px;
	height:590px;
}
i:hover{
    cursor: pointer;
}
</style>