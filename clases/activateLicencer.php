<?php 

class checkLicense {
	
	public function encriptationdouble($process,$cadena){
		switch ($process) {
			case 1:#encripta la cadena
				$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
			    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
			    return $encrypted; //Devuelve el string encriptado
			break;
				
			case 2:#desencripta la cadena
				$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	     		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	   			 return $decrypted;  //Devuelve el string desencriptado
			break;
		}
	}
	
	
	public function findiasporcadaMes($mes,$anhio){ #feb 2020 biciesto
		$proxbiciesto=2020;
		if($anhio != $proxbiciesto){
			$numDias= array('01'=>'31', '02'=>'28', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
			return($numDias[$mes]);
		}
		else{
			$proxbiciesto=2020+4;
			$numDias= array('01'=>'31', '02'=>'29', '03'=>'31', '04'=>'30', '05'=>'31', '06'=>'30', '07'=>'31', '08'=>'31', '09'=>'30', '10'=>'31', '11'=>'30', '12'=>'31');
			return($numDias[$mes]);
		}
			
	}
	public function nextmes($mes){
		$zero='0';
		if($mes<10){
			$mes+=1;
			$nMes=$zero.$mes;
			return($nMes);
		}
		else{
			$mes+=1;
			return($mes);
		}
	}
	
	public function getRealIP() {
		if (!empty($_SERVER['HTTP_CLIENT_IP']))
			return $_SERVER['HTTP_CLIENT_IP'];
		
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		
		return $_SERVER['REMOTE_ADDR'];
	}

	public function diferenciaentreFechas($register){
		$today=date('Y-m-d'); #actual
		$old=$register; #la que se registro


		$datetime1 = date_create($old);
		$datetime2 = date_create($today);
		$interval = date_diff($datetime1, $datetime2);
		return($interval->format('%a'));
	}

}
/*$cadena='ou8N51OSuBMtSBCPh9o+Y5ZZq6Z9rtFilxulMGpa5Xc=';
$key='';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
	     		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
	   			 echo $decrypted;*/
?>