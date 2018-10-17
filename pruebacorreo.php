<?
session_start();
require_once("lib/db.php");
require_once("lib/funciones.php");
	$omy = new DB_mysql();
	$omy->conectar("");
	$email=EmailUsuario($omy,$_SESSION[prefijo.'idusuario']);
	if ($email!=""){
		include_once("lib/LogMail.php");
		$res=EnviaCorreo($email,"probando","Son las ".date("H:i:s"));
		//echo "<pre>";print_r($res);echo "</pre>";die;

		if ($res->Exito==1){
			$_SESSION['avisopopup']="Se ha mandado un  email de prueba";
		}else{
			$_SESSION['avisopopup']="ha fallado el email de prueba";
		}
	}else{
		$_SESSION['avisopopup']="No se ha encontrado el email del usuario";
	}

header("Location:index.php");
?>