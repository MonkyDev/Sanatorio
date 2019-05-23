<?php 
session_start();
$SessionameUser= strtr($_SESSION['usuario'], "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ", "àáâãäåæçèéêëìíîïðñòóôõöøùüú");

?> 
<section>
<div id="formulario">
	 <div class="panel panel-primary">
                    <div class="panel-heading">
                    	Nuevos Pacientes
                    </div>
                    <div class="panel-body" style="height:405px;">
                    	<form id="pacientes" name="pacientes"><center>
                        	<table width="850">
                            <input type="hidden" id="dr" value="<?php echo $SessionameUser ?>"/>
                            <input type="hidden" id="ced" value="<?php echo $_SESSION['pk_user']?>"/>
                                    <tr>
                                        <td>Categorias: </td>
                                        <td>
                                           <select class="form-control" name="cat" id="cat" autofocus>
                                                <option value="C">Ciudano</option>
                                                <option value="Ing">Ingeniero</option>
                                                <option value="Med">M&eacute;dico</option>
                                                <option value="Arq">Arquitecto</option>
                                                <option value="Abg">Abogado</option>
                                                <option value="Lic">Licenciado</option>
                                                <option value="Prof">Profesor</option>
                                                <option value="C.P">Contador</option>
                                                <option value="LAE">Lic. Administrador</option>
                                                <option value="Peq">Ni&ntilde;o</option>
                                            </select>  
                                        </td>                                       
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                        			<tr>
                        				<td>Nombre del paciente: </td>
                        				<td>
                        				<input class="form-control" name="Nombre" id="nom"  type="text" placeholder="nombre(s)" onkeypress="return jumpEnter(event,this)"/>
                        				</td>
                        			</tr>
									<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
                                    <tr>
                                        <td>Apellido paterno: </td>
                                        <td>
                                        <input class="form-control" name="Paterno" id="pat"  type="text" placeholder="apellido paterno" onkeypress="return jumpEnter(event,this)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Apellido materno: </td>
                                        <td>
                                        <input class="form-control" name="Materno" id="mat"  type="text" placeholder="apellido materno" onkeypress="return jumpEnter(event,this)" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                        			<tr>
                        				<td>Direcci&oacute;n: </td>
                        				<td>
                        				<input class="form-control" name="Direccion" id="dir" type="text" 
                                        onkeypress="return jumpEnter(event,this)"/>
                        				</td>
                        			</tr>
                        			<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
									<tr>
                        				<td>Tel&eacute;fono: </td>
                        				<td>
                        				<input class="form-control" name="Telefono" id="tel" type="text" maxlength="15" placeholder="n&uacute;mero celular o de casa" onkeypress="return jumpEnter(event,this)"/>
                        				</td>
                        			</tr>
                        			<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
									<tr>
                        				<td>Edad:</td>
                        				<td>
                                        <input class="form-control" name="Edad" id="edd" maxlength="2" type="text" 
                                        onkeyup="if(validateTecla(event)=='enter'){accPacientes(1);}"/>
                        				</td>
                        			</tr>
                        	</table>                        		
                    	</form></center>
                    </div>
                    <div class="panel-footer">
                        <input type="button" class="btn btn-success" id="boton" value="Agregar" onclick="accPacientes(1);" />
                        <!--<input type="button" class="btn btn-danger" id="eliminar" value="Eliminar" onclick="Actioncheck(2,'');" />-->
                    </div>
                </div>
</div>
</section>
<style>
#form_clie{
	margin: auto;
	width:850px;
	height:590px;
}
i:hover{
    cursor: pointer;
}
</style>