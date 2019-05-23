// JavaScript Document
function cargaPantalla(file,content){
	$.ajax({
		beforeSend: function(){
			$('#'+content).html("<div style='text-align:center;margin-top:250px;'><img src='images/loading.gif' width='40' height='40'><br><h3 style='font-family:Arial,Helvetica,sans-serif;color:#999;font-size:16px;'>Trabajando en ello... Espere por favor</h3><div>");
		}, 
		url:file,
		success: function(e){
			$('html, body').animate({scrollTop:0}, 'slow');
			$('#'+content).html(e);
		}	
	});
}
function cargaPantallaSimple(file,content){
	$.ajax({
		url:file,
		success: function(e){
			$('html, body').animate({scrollTop:0}, 'slow');
			$('#'+content).html(e);
		}	
	});
}

function cerrarPantalla(){
	$('html, body').animate({scrollTop:0}, 'slow');
	document.getElementById('content').innerHTML="";
}


$("#cita").datepicker({dateFormat: "dd/mm/yy"});
$('#hora').timepicker();

 function validateTecla(e){
	var key=e.keyCode || e.which;
	switch(key)
	{
		case 13:
			return('enter');
		case 114:
			return('F2');
		case 114:
			return('F3');
		case 115:
			return('F4');
		case 116:
			return('F5');
		case 117:
			return('F6');
		case 118:
			return('F7');
		case 119:
			return('F8');
		case 120:
			return('F9');
		case 121:
			return('F10');
		case 122:
			return('F11');
		case 123:
			return('F12');
	}
}

 function checkUser(){
	var usr=$('#nick').val();
	var psw=$('#pass').val();
	$.ajax({
			url:'checkUser.php',
			type:'POST',
			data:'usr='+usr+'&psw='+psw,
			success: function(e){
				var res=e.split('|');
				if(res[0]==1){
					window.location="index.php";
					//alertify.success("Bienvenido..."+res[1]);
				}
				else{
					alertify.error("El servidor responde..."+res[1]);
				}
			}
		})
}
function salir(){
	alertify.confirm('Finalizar Session','Desea cerrar sesion?',
  function(){
  	window.location='logOut.php';
    alertify.success('Hasta luego');
  },
  function(){
    alertify.success('Continuamos');
  });
}
function searchClie(){
	var value=$('#clie').val();
	if(value !=''){
		$.ajax({
			url:'querysphp/SearchClie.php',
			type:'POST',
			data:'value='+value,
			success: function(e){
				$('#result').css('display','block');
				$('#result').html(e);
			}
		});
	}
	else{
		$('#result').css('display','none');
	}
}
function result(res){
	$('#idpac').attr('value',res);
	$('#cliente').html("<input class='form-control' id='clie' type='text' onkeyup='searchClie();'/>");	
	$.ajax({
		url:'querysphp/buscar.php',
		type:'POST',
		data:'value='+res,
		success: function(e){
			$('#clie').attr('value',e);
			$('#clie').css('text-align','center')
			$('#clie').attr('readonly',true);
			$('#padecimiento').focus();
		}
	});	
	$('#result').css('display','none');
}
function blockButton(btn){
	$('#'+btn).each(function (){
    	this.style.pointerEvents = 'none'; 
	});
}

function activeButton(btn){
	$('#'+btn).each(function (){
    	this.style.pointerEvents = 'auto'; 
	});
}
function acerca(){
	alertify.alert('Acerca del software','Desarrollado por el Ing.Ricardo Elías Mondragón Trujillo, contáctame al número celular +52(961)1752635 o +52(961)1574169, si cuentas con correo electrónico esperamos tu mensaje a la dirección wyrecosmony@gmail.com para dudas o aclaraciones.');
}
function displayWindow(w,h){
	$('html, body').animate({scrollTop:0}, 'slow');
	var x=w/2;
	var y=h/2;
	$('#backScreen,#window').fadeIn(1000);
	document.getElementById('backScreen').style.display="block";
	document.getElementById('window').style.display="block";
	document.getElementById('window').style.width=w+"px";
	document.getElementById('window').style.height=h+"px";
	document.getElementById('window').style.marginTop="-"+y+"px";
	document.getElementById('window').style.marginLeft="-"+x+"px";	
}

function closeWindow(){
	$('#backScreen,#window').fadeOut(1000);		
}
function printReportPDF(idpaci,idHisto){
	window.open('reportes/PDFreportHistorialmedico.php?idpaci='+idpaci+'&idHisto='+idHisto);
}

function jumpinput(res){// solo sirve en google para sartar de campo
	if(validateTecla(event)=='enter'){
		$('#'+res).focus();
	}
}
function jumpEnter(e,obj) { // salta en mozilla
  tecla=(document.all) ? e.keyCode : e.which;
  if(tecla!=13) return;
  frm=obj.form;
  for(i=0;i<frm.elements.length;i++) 
    if(frm.elements[i]==obj) { 
      if (i==frm.elements.length-1) i=-1;
      break }
  frm.elements[i+1].focus();
  return false;
} 

/*function refresPag(){
	window.location.reload();
}*/
/*$("input[name=nombre1]").click(function(){
	alert('Evento click sobre un input text con nombre="nombre1"');
});*/

$(document).ready(function(){
	$('#backup').click(function(){
		alertify.prompt("Realizar copia de seguridad","Ingrese su contraseña para continuar...", "",
			function(evt, pass){//ok
				if(pass!=""){
					var cedula=$('#cedula').val();
					$.ajax({
						url: 'backupsDB/checkUserBackupDB.php',
						type: 'POST',
						data: 'ced_usr='+cedula+'&psw='+pass,
						success: function(result){
							if(result==1){
								window.location.href = 'backupsDB/backupFileDB.php',
								alertify.alert('Se realizo respaldo exitosamente');
								//window.location.reload();
							}else{
								alertify.alert('Se produjo un error en la comprobación');
							}
						}
					});
					
				}else{
					alertify.alert('No se intrudujo contraseña');
				}
				
			},
			function(){
			alertify.error('No se realizo respaldo');
		});
	});
});

function activateLicenser(feinicio,contador){
	
}

function resetform(forms){
    $("#"+forms).reset();
}