<?
session_start();
require_once("lib/db.php");
require_once("lib/funciones.php");
$actual=limpio($_REQUEST['actual']);
$nueva=limpio($_REQUEST['nueva']);
$repite=limpio($_REQUEST['repite']);

	$omy = new DB_mysql();
    $omy->conectar("");
if ($nueva==$repite && $actual!="" && $nueva!=""){
		$nueva=claveSegura($nueva);
		$actual=claveSegura($actual);
		
	$sentencia="update ".prefijo."usuario set password='$nueva',ultimocambioclave=now() 
				where id=".$_SESSION[prefijo.'idusuario']." and password='$actual'";
	$omy->Query=$sentencia;
	$res=$omy->consulta();
	if ($res){

		$_SESSION['error']="Clave cambiada correctamente";
		$_SESSION['trazas']="";
		$_SESSION['tienecambiarclave']=false;
		header("Location:ok.php");
	}else{
		$_SESSION['error']="No se pudo cambiar la clave";
		$_SESSION['trazas']=$sentencia;
		header("Location:error.php");
	}
}else{
	$_SESSION['error']="No coinciden las claves";
	$_SESSION['trazas']="";
	header("Location:error.php");
}

?>