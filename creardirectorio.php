<?
session_start();
$_SESSION['error']="";
$_SESSION['trazas']="";
$dir=$_REQUEST['dir'];

$uploaddir=$_SESSION['directorio'];


$carpeta = $uploaddir."/".$dir;
if(!mkdir($carpeta, 0777, true)) {
	$_SESSION['error']="Error creando la carpeta";
   header("Location:error.php");die;
}else{
	header("Location:ficheros.php");
}


?>