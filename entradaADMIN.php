<?
session_start();
require_once("lib/db.php");
require_once("lib/funciones.php");
$email=limpioINJECTION($_REQUEST['email']);
$clave=limpioINJECTION($_REQUEST['clave']);


	$omy = new DB_mysql();
    $omy->conectar("");

$res=loginADMIN($omy,$email,$clave);

if ($res){
	if ($res[0]['valido']==1){
		$_SESSION[prefijo.'idusuario']=$res[0]['id'];
		$_SESSION['nombreusuario']=$res[0]['nombre'];
		$_SESSION['perfil']=$res[0]['perfil'];
		$_SESSION['centrousuario']=$res[0]['hospital'];
		$_SESSION['nombrecentrousuario']=$res[0]['nombrehospital'];
		$_SESSION['pendientevalidar']="0";
		$_SESSION['loginincorrecto']="0";
		header("Location:index.php");
	}else{
		$_SESSION['loginincorrecto']="0";
		$_SESSION['pendientevalidar']="1";
		header("Location:login.php");
	}
}else{
	$_SESSION[prefijo.'idusuario']="";
	$_SESSION['nombreusuario']="";
	$_SESSION['nombrecentrousuario']="";
	$_SESSION['perfil']="";
	$_SESSION['pendientevalidar']="0";
	$_SESSION['loginincorrecto']="1";
	$_SESSION['centrousuario']="";
	header("Location:login.php");
}


?>