<?
$idusuario=$_REQUEST['idusuario'];


require_once("lib/db.php");
require_once("lib/funciones.php");
require_once 'KLogger.php';
require_once("lib/LogMail.php");
$log = KLogger::instance("logs", KLogger::ERR);
$log->logDebug('Borrar Usuario:',$idusuario);

	  $omy = new DB_mysql();
	  $omy->conectar("");

	if ($idusuario!=""){
	  $sentencia="update ".prefijo."usuario set valido=2 where id=$idusuario";
	  $omy->Query=$sentencia;

	  $omy->consulta();
	 
	  //tenemos que buscar el email del usuario
	   $email=EmailUsuario($omy,$idusuario);
	   if ($email!=""){
			//@EnviaCorreo($email,NOMBREWEB,"El usuario acaba de ser borrado");
	   }
	  
	}

	  header("Location:usuariospendientes.php");
?>