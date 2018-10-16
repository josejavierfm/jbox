<?session_start();
//miramos que venimos de instalacion...
if (strpos($_SERVER['HTTP_REFERER'],"instalacion.php")===false){
	$_SESSION['error']="No ha seguido el proceso";
	header("Location:instalacion.php");
}


require_once("lib/funciones.php");
$server=$_POST['server'];
$user=$_POST['usuario'];
$clave=$_POST['clave'];
$bd=$_POST['bd'];

//modificamos el fichero libbd.php para añadir los datos
$str=file_get_contents('lib/db.php');

if (strpos($str,'xxxx2xxxx')!==false){
	$str=str_replace('xxxx1xxxx', $bd,$str);
	$str=str_replace("xxxx2xxxx", $server,$str);
	$str=str_replace("xxxx3xxxx", $user,$str);
	$str=str_replace("xxxx4xxxx", $clave,$str);
	$str=str_replace("xxxx5xxxx", prefijo,$str);

	$res=file_put_contents('lib/db.php', $str);
	if($res===false){
		$_SESSION['error']="No se pudo continuar, edite el fichero lib/db.php a mano";
		header("Location:instalacion.php");
	}
}else{
	//ya estaba cambiado
}

//miramos si ya existen las tablas
require_once("lib/db.php");
$omy = new DB_mysql();
$omy->conectarSinBD();
if ($omy->elegirbd($bd)){
	$haybbdd=true;
}else{
	$sentencia_create="create database ".$bd.";";
	$omy->Query=$sentencia_create;
	$haybbdd=$omy->consulta();
	if ($haybbdd){
		
		$sentencia_use="use ".$bd.";";
		$omy->Query=$sentencia_create;
		$res1=$omy->consulta();
	}
}
if ($haybbdd){

	$check="select count(*) as t from ".prefijo."usuario";
	$omy->Query=$check;
	$res2=$omy->arr_asocia();

	if ($res2[0]['t']>0){
		$_SESSION['error']="No se pudo continuar, ya existe una instalacion";
		header("Location:instalacion.php");
	}else{
		
		
		

		$sentencia_log="CREATE TABLE `".prefijo."log` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `usuario` int(11) DEFAULT NULL,
		  `fecha` datetime DEFAULT NULL,
		  `texto` varchar(255) DEFAULT NULL,
		  `accion` varchar(255) DEFAULT NULL,
		  `detalle` text DEFAULT NULL,
		  PRIMARY KEY (`id`) USING BTREE
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$omy->Query=$sentencia_log;
		$res1=$omy->consulta();
		$sentencia_logacceso="CREATE TABLE `".prefijo."logacceso` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `idusuario` int(11) DEFAULT NULL,
		  `ip` varchar(20) DEFAULT NULL,
		  `fecha` datetime DEFAULT NULL,
		  PRIMARY KEY (`id`) USING BTREE
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$omy->Query=$sentencia_logacceso;
		$res1=$omy->consulta();
		$sentencia_usuarios="CREATE TABLE `".prefijo."usuario` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nombre` varchar(255) DEFAULT NULL,
		  `apellidos` varchar(255) DEFAULT NULL,
		  `email` varchar(255) DEFAULT NULL,
		  `telefono` varchar(255) DEFAULT NULL,
		  `password` varchar(255) DEFAULT NULL,
		  `perfil` smallint(1) DEFAULT NULL,
		  `valido` smallint(6) DEFAULT '0',
		  `formato` varchar(10) DEFAULT 'ods',
		  `ultimocambioclave` date DEFAULT NULL,
		  `ultimoacceso` datetime DEFAULT NULL,
		  `ipultimoacceso` varchar(30) DEFAULT NULL,
		  `directorio` varchar(30) DEFAULT NULL,
		  
		  PRIMARY KEY (`id`) USING BTREE,
		  UNIQUE KEY `ind_emai` (`email`) USING BTREE
		) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;";
		$omy->Query=$sentencia_usuarios;
		$res1=$omy->consulta();
	}
}else{
		$_SESSION['error']="No se pudo continuar, no se pudo crear la base datos";
		header("Location:instalacion.php");
}
include_once("cabecerafuera.php");
?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
		    <!--<img src='dist/img/logo.png'><br>-->
        <a href="index.php"><b><?=NOMBREWEB?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Instalacion paso2</p>
        <form action="instalacion3.php" method="POST" id="fentrada" name="fentrada">
           <div class="row">
            <div class="col-xs-12">
				  <div class="form-group has-feedback">
					
					<input type="text" class="form-control" name="email" id="email" placeholder="Email administrador"  data-validate="required,email" autocomplete="off">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
				   <div class="form-group has-feedback">
					
					<input type="text" class="form-control" name="email2" id="email2" placeholder="Repite Email administrador"  data-validate="required,email" autocomplete="off">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
					
					<input type="password" class="form-control" name="clave" id="clave" placeholder="Clave administrador"  data-validate="required" autocomplete="off">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				   <div class="form-group has-feedback">
					
					<input type="password" class="form-control" name="clave2" id="clave2" placeholder="Repite Clave administrador"  data-validate="required" autocomplete="off">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
			</div>
			</div>
		  <div class="row">
            <div class="col-xs-12">
				  <div class="form-group has-feedback">
					
					<input type="text" class="form-control" name="smtp" id="smtp" placeholder="SMTP"  data-validate="" autocomplete="off">
					<span class="glyphicon glyphicon-globe form-control-feedback"></span>
				  </div>
				   <div class="form-group has-feedback">
					
					<input type="text" class="form-control" name="puerto" id="puerto" placeholder="Puerto smtp"  data-validate="number" autocomplete="off">
					<span class="glyphicon glyphicon-globe form-control-feedback"></span>
				  </div>
				   <div class="form-group has-feedback">
					
					<input type="text" class="form-control" name="cuenta" id="cuenta" placeholder="Cuenta de correo"  data-validate="email" autocomplete="off">
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
					
					<input type="password" class="form-control" name="claveEmail" id="claveEmail" placeholder="Clave cuenta correo"  data-validate="" autocomplete="off">
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				   
			</div>
			</div>
          <div class="row">
            <div class="col-xs-5">
           
            </div><!-- /.col -->
            <div class="col-xs-2">
              
            </div><!-- /.col -->
            <div class="col-xs-5">
              <button type="submit" style="display:none" id="btentrar"  class="btn btn-success btn-block btn-flat" >Continuar</button>
            </div><!-- /.col -->
          </div>
		 
			
			<div class="row" id="avisonav">
              <div class="col-xs-12">
                  <span  ><i class="fa fa-warning text-red"></i>Su navegador no es compatible <a href="https://jquery.com/browser-support/" target="_blank">info</a></span>
            
              </div><!-- /.col -->
          </div>
        </form>
       

       
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="plugins/notify.js"></script>
    <script src="plugins/verify.notify.es.121.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
	  
	  /* comprobamos que carga jquery */
       $(document).ready(function() {
          $('#btentrar').show();
          $('#avisonav').hide();
        });
		
    </script>
    <script> 
var $buoop = {vs:{i:10,f:-4,o:-4,s:8,c:-4},api:4}; 
function $buo_f(){ 
 var e = document.createElement("script"); 
 e.src = "//browser-update.org/update.min.js"; 
 document.body.appendChild(e);
};
try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
catch(e){window.attachEvent("onload", $buo_f)}
</script>
  </body>
</html>