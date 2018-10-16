<?
session_start();

if (isset($_POST['idficheroborrar']) && $_POST['idficheroborrar']!=""){
	$fichero=$_POST['idficheroborrar'];
	if (!unlink($fichero)){
		$_SESSION['error']="No se ha podido borrar el fichero";
		header("Location:error.php");die;
	}
}else{
	$_SESSION['error']="No se ha recibido ningun fichero";
	header("Location:error.php");die;
}

header("Location:ficheros.php");
?>