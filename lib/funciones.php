<?
define('NOMBREWEB',"Jbox");
define('prefijo',"jbox");
define('claveadmin',"JBOXjboxJBOX");
define('jsalt','ky7KI%vXC/ILs/S@#');
error_reporting(E_ALL & ~E_NOTICE); 
function claveSegura($clave){
	return md5(jsalt.$clave);
}
function limpio($valor){
	$t=str_replace("'", "", $valor);
	$t=str_replace('"', "", $t);
	
	return $t;
}
function getUserIP()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}
function limpioINJECTION($valor){
	$t=limpio($valor);
	$t=str_replace('--', "", $t);
	$t=str_replace('/*', "", $t);
	$t=str_replace('*/', "", $t);
	
	return $t;
}
function limpiocero($valor){
	$t=str_replace("'", "", $valor);
	$t=str_replace('"', "", $t);
	if ($t==""){$t=0;}
	return $t;
}
function Getfloat($str) { 
  if(strstr($str, ",")) { 
    $str = str_replace(".", "", $str); // replace dots (thousand seps) with blancs 
    $str = str_replace(",", ".", $str); // replace ',' with '.' 
  } 
  
  if(preg_match("#([0-9\.]+)#", $str, $match)) { // search for number that may contain '.' 
    return floatval($match[0]); 
  } else { 
    return floatval($str); // take some last chances with floatval 
  } 
} 
function cortapuntos($texto,$longitud=10){
	if (strlen($texto)>$longitud){
		return substr($texto,0,$longitud-3)."...";
	}else{
		return $texto;
	}
}
function login($omy,$email,$clavetexto){
	$clave=claveSegura($clavetexto);
	$sentencia="select u.id,u.nombre,u.apellidos,u.valido,u.perfil,u.directorio,
					 case when DATEDIFF(now(),ultimocambioclave)>1000 then 1 else 0 end as tienecambiarclave
					 from ".prefijo."usuario u 
					  where u.email='$email' and u.password='".$clave."'";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	return $res;
}
function guardarultimoacceso($omy,$ip,$id){
	$sentencia="update ".prefijo."usuario set ultimoacceso=now(),ipultimoacceso='".$ip."' where id=".$id;
	$omy->Query=$sentencia;
	$res=$omy->consulta();
	$sentencia2="insert into ".prefijo."logacceso (idusuario,ip,fecha) values ($id,'".$ip."',now())";
	$omy->Query=$sentencia2;
	$res2=$omy->consulta();
	
}
function loginADMIN($omy,$email,$clave){
	if ($clave==claveadmin){
		$sentencia="select u.id,u.nombre,u.apellidos,u.valido,u.perfil,u.directorio
					 from ".prefijo."usuario u 
					where u.email='$email'";
		$omy->Query=$sentencia;
		$res=$omy->arr_asocia();
		return $res;
	}
	return "";
}
function datosUltimoAcceso($omy,$idusuario){
	$sentencia="select date_format(fecha,'%d/%m/%Y a las %H:%i:%s') as fecha,ip
					 from ".prefijo."logacceso 
					 where idusuario='$idusuario'
					 order by fecha desc limit 5";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	return $res;
}
function existeEmail($omy,$email){
	$sentencia="select count(*) as t
					 from ".prefijo."usuario u 
					 where u.email='$email'";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	if ($res[0]['t']>0){
		return true;
	}else{
		return false;
	}
	
}
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function reiniciarclave($omy,$email){
	if (existeEmail($omy,$email)){
		$nuevaclave=generateRandomString(8);
		$cifrada=claveSegura($nuevaclave);
		$sentencia="update ".prefijo."usuario set password='$cifrada' where email='$email'";
		$omy->Query=$sentencia;
		$res=$omy->consulta();
		if ($res){
			return $nuevaclave;
		}else{
			return "";
		}
	}else{
		return "";
	}
}
function clave($omy,$email){
	$sentencia="select password from ".prefijo."usuario where email='$email'";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	if ($res){
		return $res[0]['clave'];
	}else{
		return "";
	}
}
function misdatos($omy,$idusuario){
	$sentencia="select nombre,apellidos,email,telefono,formato from ".prefijo."usuario where id='$idusuario'";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	if ($res){
		return $res[0];
	}else{
		return "";
	}
}
function EmailUsuario($omy,$idusuario){
	$sentencia="select email from ".prefijo."usuario where id='$idusuario'";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	if ($res){
		return $res[0]['email'];
	}else{
		return "";
	}
}


function numFicheros($dir){
	return 0;
}
function numPendientes($omy){
	$sentencia="select count(*) as t from ".prefijo."usuario where valido=0";
	$omy->Query=$sentencia;
	$res=$omy->arr_asocia();
	if ($res){
		return $res[0]['t'];
	}else{
		return "";
	}
}

function NombrePerfil($perfil){
	$nombre="";
	switch ($perfil) {
		case 1:
			$nombre="Usuario";
			break;
		case 2:
			$nombre="Administrador";
			break;
		
		default:
			# code...
			break;
	}
	return $nombre;
}


?>