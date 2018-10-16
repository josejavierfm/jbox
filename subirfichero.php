<?
session_start();
$_SESSION['error']="";
$_SESSION['trazas']="";


//miramos si viene como array (cuando es drag
if (is_array($_FILES['fd-file']['name'])){ 
	$nombre=basename($_FILES['fd-file']['name'][0]);
	$nombretmp=$_FILES['fd-file']['tmp_name'][0];
}else{
	$nombre=basename($_FILES['fd-file']['name']);
	$nombretmp=$_FILES['fd-file']['tmp_name'];
} 
$uploaddir=$_SESSION['directorio'];
$uploadfile = $uploaddir ."/". $nombre;

if (move_uploaded_file($nombretmp, $uploadfile)) {
   header("Location:ficheros.php");
} else {
	$_SESSION['error']="Error al subir el fichero";
    header("Location:error.php");die;
}


?>