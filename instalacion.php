<?session_start();
include_once("cabecerafuera.php");
require_once("lib/funciones.php");
require_once("lib/db.php");
$omy = new DB_mysql();
$instalado=false;
if ($omy->Servidor!="xxxx2xxxx"){$instalado=true;}
	
?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
		    <!--<img src='dist/img/logo.png'><br>-->
        <a href="index.php"><b><?=NOMBREWEB?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Creaci&oacute;n base datos</p>
        <form action="instalacion2.php" method="POST" id="fentrada" name="fentrada">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" name="server" id="server" placeholder="Servidor bbdd"  data-validate="required" value="localhost" autocomplete="off">
            <span class="glyphicon glyphicon-globe form-control-feedback"></span>
          </div>
		  <div class="form-group has-feedback">
            <input type="text" class="form-control" name="bd" id="bd" placeholder="Base de datos"  data-validate="required" value="jbox" autocomplete="off">
            <span class="glyphicon glyphicon-hdd form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario bbdd"  data-validate="required" autocomplete="off">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="clave" id="clave" placeholder="Clave bbdd"  data-validate="required" autocomplete="off">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		 
          <div class="row">
            <div class="col-xs-5">
           
            </div><!-- /.col -->
            <div class="col-xs-2">
              
            </div><!-- /.col -->
            <div class="col-xs-5">
			<? if ($instalado==false){?>
              <button type="submit" style="display:none" id="btentrar"  class="btn btn-success btn-block btn-flat" >Instalar</button>
			<?}?>
            </div><!-- /.col -->
          </div>
		  <?if (isset($_SESSION['error'])){?>
		  <div class="row">
            <div class="col-xs-12">
			<?=$_SESSION['error']?>
			<?=$_SESSION['trazas']?>
            </div><!-- /.col -->
		  </div>
		  <?
		  $_SESSION['error']="";
		  }?>
		 
			
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