 function accPacientes(acc){
	switch(acc){
		case 1:
			var nom=$('#nom').val(); pat=$('#pat').val(); mat=$('#mat').val(); ced=$('#ced').val(); 
			var dir=$('#dir').val(); tel=$('#tel').val();  edd=$('#edd').val(); cat=$('#cat').val();
			var alldata='acc=1&nom='+nom+'&pat='+pat+'&mat='+mat+'&dir='+dir+'&tel='+tel+'&edd='+edd+'&cat='+cat+'&ced='+ced;
			if(nom!="" && pat!="" && mat!="" && tel!="" && dir!="" && edd!=""){
				blockButton('boton');
				$.ajax({
					url: 'querysphp/accPacientes.php',
					type: 'POST',
					data: alldata,
					success: function(result){
						if(result==1){
							$('#content').html("");
							$('#content').html("<div style='text-align:center;margin-top:250px;'><img src='images/checkmark.gif' width='160'><br><h3 style='font-family:Arial,Helvetica,sans-serif;color:#999;font-size:16px;'>Se han guardado los datos del Paciente correctamente</h3><div>");
						}
					}
				});
			}
			else{
				alertify.error("Campos vacíos verifíque su llenado"); 
				activeButton('boton');
			}
		break;
		case 2:
			var paci=$('#idpac').val(); pade=$('#padecimiento').val(); expl=$('#exploracion').val(); cedDoc=$('#cedula').val();
			var estu=$('#estudios').val(); trat=$('#tratamiento').val(); cita=$('#cita').val(); hra=$('.hora').val();
			var date=cita.split("/"); newcita=date[2]+"-"+date[0]+"-"+date[1]; hrnum='';
			if((hra.length)==7){
				if((hra.substring(7,5))=='am'){
					hrnum=hra.replace('am',':01');
				}
				else{
					hrnum=hra.replace('pm',':02');
				}
			}
			else{
				if((hra.substring(6,4))=='am'){
					hrnum=hra.replace('am',':01'); 
				}
				else{
					hrnum=hra.replace('pm',':02');
				}				
			}
			var alldata='acc=2&paci='+paci+'&pade='+pade+'&expl='+expl+'&estu='+estu+'&trat='+trat+'&cita='+newcita+'&hra='+hrnum+'&cedDoc='+cedDoc;
			if(paci!="" && pade!="" && estu!="" && expl!="" && trat!=""){
				blockButton('boton');
				$.ajax({
					url: 'querysphp/accPacientes.php',
					type: 'POST',
					data: alldata,
					success: function(result){
						if(result==1){
							$('#content').html("");
							$('#content').html("<div style='text-align:center;margin-top:250px;'><img src='images/checkmark.gif' width='160'><br><h3 style='font-family:Arial,Helvetica,sans-serif;color:#999;font-size:16px;'>Se han guardado los datos del Paciente correctamente</h3><div>");
						}
					}
				});
			}
			else{
				alertify.error("Campos vacíos verifíque su llenado"); 
				activeButton('boton');
			}		
		break;
	}
}
function pasaLista(id,cedDoc){
	var ok;
	alertify.confirm('Seguimiento de asistencia', '¿El paciente asistio a la cita?..', 
		function(){ 
			ok=1;
			$.ajax({
				url:'querysphp/accPacientes.php',
				type:'POST',
				data:'acc=3&paci='+id+'&asis='+ok+'&cedDoc='+cedDoc,
				success: function(result) {
					if(result==1){
						cargaPantalla('pacientes/proximasCitas.php','citas');
						window.location.reload();
						alertify.success('Se ha pasado lista al paciente');
					}
				}
			});		
		}
        , function(){
	        ok=2;
			$.ajax({
				url:'querysphp/accPacientes.php',
				type:'POST',
				data:'acc=3&paci='+id+'&asis='+ok+'&cedDoc='+cedDoc,
				success: function(result) {
					if(result==1){
						cargaPantalla('pacientes/proximasCitas.php','citas');
						window.location.reload();
						alertify.success('Se ha pasado lista al paciente');
					}
				}
			});
    }).set('labels', {ok:'Si', cancel:'No'});
}
function accDeletePac(acc,id,cedDoc) {
	switch(acc){
		case 1:
			alertify.confirm('Eliminar Registros de Pacientes','¿Desea eliminar al paciente?',
				function(){//ok
					$.ajax({
						url: 'querysphp/accPacientes.php',
						type: 'POST',
						data: 'acc=4&idpaci='+id+'&cedDoc='+cedDoc,
						success:function(e){
							if(e==1){
								cargaPantalla('historial/buscarHistorial.php','content');
								alertify.success('Se ha borrado el paciente de la lista');
							}else {
								alertify.error('Ha ocurrido un error no se pudo eliminar');	
							}
						}
					});					
				},
					function(){//cancel
					alertify.success('No se registraron cambios!');
			});

		break;
	}
}
function accUpdateDataPac(acc,id) {
	switch (acc) {
		case 1:
			var nom=$('#nom').val(); cedDr=$('#ced').val(); idpaci=$('#idpaci').val();
			var dir=$('#dir').val(); tel=$('#tel').val();  edd=$('#edd').val();
			var alldata='acc=5&nom='+nom+'&dir='+dir+'&tel='+tel+'&edd='+edd+'&cedDoc='+cedDr+'&idpaci='+idpaci;
				if(nom!="" && tel!="" && dir!="" && edd!=""){
					blockButton('boton');
					$.ajax({
						url: 'querysphp/accPacientes.php',
						type: 'POST',
						data: alldata,
						success: function(result){
							if(result==1){
								closeWindow();
								cargaPantalla('historial/buscarHistorial.php','content');
							}
							else
								alertify.alert("No se ah encontrado paciente");
						}
					});
				}
				else{
					alertify.error("Campos vacíos verifíque su llenado"); 
					activeButton('boton');
			}
		break;
	}
}

function registrer(form,clase){
	$(document).on('click','#'+form,function(event){
		var error = 0;
		$('.'+clase).each(function(i, elem){
			if($(elem).val() == ''){
				//$(elem).css({'border':'1px solid red'});
				error++;
			}
		});
		if(error > 0){
			event.preventDefault();
			$('#error').css('display','block');
		}
		else{
			blockButton('enviar');
			$('#error').css('display','none');
			//$(elem).css('');
			var datas=$('#' + form).serialize();
			$.ajax({
				url: 'checkAltauser.php',
				type: 'POST',
				data: datas,
				success: function(res){
					var request=res.split('|');
					if(request[0]==1){
						window.location="login.php";
					}
					else{
						alertify.alert(request[1]);
						activeButton('enviar');
					}
				}
			});
		}//fin else
	});			
}
