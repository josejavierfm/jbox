<?
session_start();
require_once("lib/db.php");
require_once("lib/funciones.php");
require_once("lib/Security-1.0.php");
$email=limpioINJECTION($_REQUEST['email']);
$clave=limpioINJECTION($_REQUEST['clave']);

$clavecifrada=Security::encrypt($clave,Security::claveDefecto());

require_once 'KLogger.php';
$log = KLogger::instance("logs", $log_level_en_clase);

	$omy = new DB_mysql();
    $omy->conectar("");

$res=login($omy,$email,$clave);
$log->logDebug('Acceso aplicación:',$email." [".$clavecifrada."] ");
if ($res){
	if ($res[0]['valido']==1){
		guardarultimoacceso($omy,getUserIP(),$res[0]['id']);
		$_SESSION[prefijo.'idusuario']=$res[0]['id'];
		$_SESSION['nombreusuario']=$res[0]['nombre']." ".$res[0]['apellidos'];
		$_SESSION['perfil']=$res[0]['perfil'];
		$_SESSION['dirRAIZ']=$res[0]['directorio'];
		$_SESSION['directorio']="";
		$_SESSION['pendientevalidar']="0";
		$_SESSION['loginincorrecto']="0";

		if ($res[0]['tienecambiarclave']==1){
			$_SESSION['tienecambiarclave']=true;
			header("Location:cambioclave.php");
		}else{
			header("Location:index.php");
		}
	}else{
		if ($res[0]['valido']==0){
			$log->logError('Acceso aplicación:',"El usuario ($email) no tiene permisos ".$omy->Error);
			$_SESSION['loginincorrecto']="0";
			$_SESSION['pendientevalidar']="1";
			$_SESSION['dirRAIZ']="";
			$_SESSION['directorio']="";
			header("Location:login.php");
		}else{
			$log->logError('Acceso aplicación:',"El usuario no existe ".$omy->Error);
			$_SESSION[prefijo.'idusuario']="";
			$_SESSION['nombreusuario']="";
			$_SESSION['perfil']="";
			$_SESSION['pendientevalidar']="0";
			$_SESSION['loginincorrecto']="1";
			$_SESSION['dirRAIZ']="";
			$_SESSION['directorio']="";
			header("Location:login.php");
		}
	}
}else{
	$log->logError('Acceso aplicación:',"El usuario no existe ".$omy->Error);
	$_SESSION[prefijo.'idusuario']="";
	$_SESSION['nombreusuario']="";
	$_SESSION['perfil']="";
	$_SESSION['pendientevalidar']="0";
	$_SESSION['loginincorrecto']="1";
	$_SESSION['dirRAIZ']="";
	$_SESSION['directorio']="";
	header("Location:login.php");
}


?>