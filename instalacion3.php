<?session_start();
//miramos que venimos de instalacion...
if (strpos($_SERVER['HTTP_REFERER'],"instalacion2.php")===false){
	$_SESSION['error']="No ha seguido el proceso";
	header("Location:instalacion.php");
}


require_once("lib/funciones.php");
$email=$_POST['email'];
$email2=$_POST['email2'];
$clave=$_POST['clave'];
$clave2=$_POST['clave2'];

require_once("lib/db.php");
$omy = new DB_mysql();
$omy->conectar("");

if ($email=="" || $email!=$email2 || $clave=="" || $clave!=$clave2){
	$_SESSION['error']="No se pudo continuar, faltan datos";
	header("Location:instalacion.php");die;
}


	$check="select count(*) as t from ".prefijo."usuario";
	$omy->Query=$check;
	$res2=$omy->arr_asocia();

	if ($res2[0]['t']>0){
		$_SESSION['error']="No se pudo continuar las instalacion, ya existe una instalacion";
		header("Location:login.php");die;
	}else{
		$clave=claveSegura($clave);
		$dir=generateRandomString(15);
		//creamos el directorio
		$carpeta = "RAIZ/".$dir;
		if(mkdir($carpeta, 0777, true)) {
	
		
			$sentencia_usuario1="insert into ".prefijo."usuario (nombre,apellidos,email,perfil,valido,password,directorio)
			values('Administrador','Administrador','$email',2,1,'$clave','$dir');";
			$omy->Query=$sentencia_usuario1;
			$idusuario=$omy->insert();
			if ($idusuario!=null){
				$_SESSION[prefijo.'idusuario']=$idusuario;
				$_SESSION['nombreusuario']="Administrador";
				$_SESSION['perfil']=2;
				$_SESSION['dir']=$dir;
				
				//miramos si configuramos el correo
				$smtp=$_POST['smtp'];
				$puerto=$_POST['puerto'];
				$cuenta=$_POST['cuenta'];
				$claveEmail=$_POST['claveEmail'];
				$str=file_get_contents('lib/LogMail.php');
				if (strpos($str,'xxxx1xxxx')!==false){
					if ($smtp!="" && $puerto!="" && $cuenta!="" && $claveEmail!=""){
						//modificamos el fichero de correo para añadir los datos
						

					
						$str=str_replace('xxxx1xxxx', "smtp",$str);//tipo de envio
						$str=str_replace("xxxx2xxxx", $smtp,$str);
						$str=str_replace("xxxx3xxxx", $puerto,$str);
						$str=str_replace("xxxx4xxxx", $cuenta,$str);
						$str=str_replace("xxxx5xxxx", $claveEmail,$str);
						$str=str_replace("xxxx6xxxx", prefijo,$str);

						$res=file_put_contents('lib/LogMail.php', $str);
						if($res===false){
							$_SESSION['avisopopup']="No se ha configurado el servidor de correo";
							
						}else{
							require_once("lib/LogMail.php");
							$res=EnviaCorreo($email,"Prueba de correo","Se ha mandado un correo de prueba");
							if ($res->Exito==1){
								$_SESSION['avisopopup']="Se ha configurado el correo y se ha mandado un email de prueba";
							}else{
								$_SESSION['avisopopup']="Se ha configurado el correo pero ha fallado el email de prueba";
							}
							
						}
				
					}else{
						$str=str_replace('xxxx1xxxx', "sendmail",$str);
						$res=file_put_contents('lib/LogMail.php', $str);
					}
					
				}else{
					//el fichero estaba configurado
					$res=EnviaCorreo($email,"Prueba de correo","Se ha mandado un correo de prueba aunque ya estaba configurado");
				}
				
				
				
				header("Location:index.php");
			}else{
				$_SESSION['error']="No se pudo continuar,error al insertar el administrador";
				$_SESSION['trazas']=$sentencia_usuario1;
				
				header("Location:instalacion.php");
			}
		}else{
			$_SESSION['error']="No se pudo continuar,error al crear la carpeta";
			$_SESSION['trazas']=$sentencia_usuario1;
			
			header("Location:instalacion.php");
		}
	}

?>  