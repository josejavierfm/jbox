<?session_start();
	/*header("location:update.php");*/
include_once("cabecerafuera.php");
require_once("lib/funciones.php");
?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b><?=NOMBREWEB?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Identificate ADMIN</p>
        <form action="entradaADMIN.php" method="POST" id="fentrada" name="fentrada">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="email" id="email" placeholder="Email"  data-validate="required">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="clave" id="clave" placeholder="Clave"  data-validate="required">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-5">
           
            </div><!-- /.col -->
            <div class="col-xs-2">
              
            </div><!-- /.col -->
            <div class="col-xs-5">
              <button type="submit" class="btn btn-success btn-block btn-flat" >Entrar</button>
            </div><!-- /.col -->
          </div>
		  <? if ($_SESSION['pendientevalidar']=="1"){ ?>
			<div class="row">
				<div class="col-xs-12">
					 <p class="login-box-msg">Pendiente de validar</p>
				</div><!-- /.col -->
			</div>
		  <? } ?>
			<? if ($_SESSION['loginincorrecto']=="1"){ ?>
				<div class="row">
					<div class="col-xs-12">
						<p class="login-box-msg">Acceso incorrecto</p>
					</div><!-- /.col -->
				</div>
			<? } ?>
        </form>
       

        <a href="registro.php" class="text-center">Registrar</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="plugins/iCheck/icheck.min.js"></script>
    <script src="plugins/notify.js"></script>
    <script src="plugins/verify.notify.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
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