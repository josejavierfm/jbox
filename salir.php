<?
session_start();
require_once("lib/funciones.php");
$_SESSION[prefijo.'idusuario']="";
$_SESSION['nombreusuario']="";
$_SESSION['perfil']="";
$_SESSION['dirRAIZ']="";
$_SESSION['directorio']="";
header("Location:login.php");
?>