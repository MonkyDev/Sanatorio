<?php  
session_start();
?>
<script>
    $(function(){
        $('.datepicker').datepicker();
    });
    $(function() {
        $('#basicExample').timepicker();
    });
</script>
<section>
<div id="formulario">
	 <div class="panel panel-primary">
                    <div class="panel-heading">
                    	Consultas de pacientes  
                    </div>
                    <div class="panel-body" style="height:500px;">
                    	<form id="pacientes" name="pacientes"><center>
                        	<table width="850">
                                    </tr>
                                    <tr>
                                        <td>Paciente: </td>
                                        <td>
                                        <div id="cliente">                                        
                                        <input type="text" name="buscar" class="form-control" id="clie" 
                                        onkeyup="searchClie();" placeholder="ingrese el nombre..." 
                                        onkeypress="return jumpEnter(event,this)" autofocus/>
                                        </td>
                                        </div>
                                    </tr>
                                    <tr>
                                    <td>&nbsp;</td>
                                    
                                    <td><div id="result"></div></td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                        			<tr>
                        				<td>Padecimiento actual: </td>
                        				<td>
                                        <textarea class="form-control" id="padecimiento" onkeypress="return jumpEnter(event,this)"></textarea>
                        				</td>
                        			</tr>
									<tr>
									    <td>&nbsp;</td>
									    <td>&nbsp;</td>
									</tr>
                                    <tr>
                                        <td>Exploraci&oacute;n F&iacute;sica: </td>
                                        <td>
                                        <textarea class="form-control" id="exploracion" onkeypress="return jumpEnter(event,this)"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>Estudios de Gabinete: </td>
                                        <td>
                                        <textarea class="form-control" id="estudios" onkeypress="return jumpEnter(event,this)"></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                        			<tr>
                        				<td>Tratamientos: </td>
                        				<td>
                        				<textarea class="form-control" id="tratamiento"></textarea>
                        				</td>
                        			</tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <i class="fa fa-calendar"></i> &nbsp;Agendar pr&oacute;xima cita: 
                                        </td>
                                        <td>
                                        <input type="text" name="date" class="datepicker" id="cita" 
                                        placeholder="Fecha cita...00/00/0000"/>
                                        <input id="basicExample" type="text" class="hora" placeholder="Hora cita...(00:00am)" />
                                        </td>  
                                    </tr>
                                    <tr>
                                    <input type="hidden" id="idpac">
                                    <input type="hidden" id="cedula" value="<?php echo $_SESSION['cedula'];?>">
                        	</table>                        		
                    	</form></center>
                    </div>
                    <div class="panel-footer">
                        <input type="button" class="btn btn-success" id="boton" value="Guardar" onclick="accPacientes(2);" />
                    </div>
                </div>
</div>
</section>
<style>
i:hover{
    cursor: pointer;
}
#result{
    border:#7691EB 2px solid; 
    width:100%;
    height:100px;
    display: none;
    background-color: #fff;
}
.hora{
    padding: 4px;
    float: right;
    margin-top: 1px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
</style>