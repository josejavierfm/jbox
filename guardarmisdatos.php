<?session_start();
require_once("lib/db.php");
require_once("lib/funciones.php");
require_once 'KLogger.php';
$idusuario=$_SESSION[prefijo.'idusuario'];
$log = KLogger::instance("logs", $log_level_en_clase);
$log->logDebug('Guardar mis datos:',$idusuario);

$telefono=limpio($_REQUEST['telefono']);
$clave=limpio($_REQUEST['clave']);
$nuevaclave=limpio($_REQUEST['nuevaclave']);
$email=limpio($_REQUEST['email']);
$nombre=limpio($_REQUEST['nombre']);
$apellidos=limpio($_REQUEST['apellidos']);

if ($clave!="" && $clave==$nuevaclave){
	$setclave=",password='".claveSegura($clave)."'";
}



	$omy = new DB_mysql();
				$omy->conectar("");
			
			$sentencia="update ".prefijo."usuario set 
					telefono='$telefono',
					email='$email',
					nombre='$nombre',
					apellidos='$apellidos'
					$setclave
					where id='$idusuario'
					";
			
			
			 $omy->Query = $sentencia;
    		$salida = $omy->consulta();
   			if ($salida){
				$_SESSION['nombreusuario']=$nombre." ".$apellidos;
				$_SESSION['error']="Datos actualizados correctamente";
				$_SESSION['trazas']="";
				header("Location:ok.php");
			}else{
				
				$_SESSION['error']="No se ha podido guardar los datos";
				$_SESSION['trazas']=$sentencia;
				if (!$res1){$log->logError('Sentencia erronea:',$omy);}
				$log->logDebug('Error Guardar mis datos sentencia:',$sentencia);
				header("Location:error.php");
			}
?>