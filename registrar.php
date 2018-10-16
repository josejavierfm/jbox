<?
session_start();
require_once("lib/db.php");
require_once("lib/funciones.php");
require_once("lib/LogMail.php");
$email=limpio($_REQUEST['email']);
$email2=limpio($_REQUEST['email2']);
$telefono=limpio($_REQUEST['telefono']);
$clave=limpio($_REQUEST['clave']);
$clave2=limpio($_REQUEST['clave2']);
$nombre=limpio($_REQUEST['nombre']);
$apellidos=limpio($_REQUEST['apellidos']);

	$omy = new DB_mysql();
    $omy->conectar("");

if ($email!="" && $email==$email2  && $clave!="" && $clave==$clave2 && $nombre!=""){
	$clave=claveSegura($clave);
	$dir=generateRandomString(15);
	$carpeta = "RAIZ/".$dir;
	if(mkdir($carpeta, 0777, true)) {
		$sentencia="insert into ".prefijo."usuario(
			nombre,apellidos,email,telefono,password,perfil,ultimocambioclave,directorio) values
		 ('$nombre','$apellidos','$email','$telefono','$clave',1,now(),'$dir') ";
		$omy->Query=$sentencia;//echo $sentencia;die;
		$res_in=$omy->consulta();
		if ($res_in){
			@EnviaCorreo($email,NOMBREWEB,"El usuario se encuentra pendiente de validar");
			$_SESSION['pendientevalidar']="1";
			$_SESSION['loginincorrecto']="0";
			header("Location:login.php");
		}else{
			$_SESSION['loginincorrecto']="0";
			$_SESSION['pendientevalidar']="0";
			$_SESSION[prefijo.'idusuario']="";
			$_SESSION['nombreusuario']="";
			header("Location:login.php");
		}
	}else{
			$_SESSION['loginincorrecto']="0";
			$_SESSION['pendientevalidar']="0";
			$_SESSION[prefijo.'idusuario']="";
			$_SESSION['nombreusuario']="";
			header("Location:login.php");
		}

}else{
	header("Location:registro.php");
}

?>