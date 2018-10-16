<?
include_once("cabecerafuera.php");
require_once("lib/funciones.php");
?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index.php"><b><?=NOMBREWEB?></b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Recordar</p>
		<p>Se generará una clave nueva y se le enviará por email</p>
        <form action="mandarrecordatorio.php" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-validate="required">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
         
          <div class="row">
            <div class="col-xs-4">
              <div class="checkbox icheck">
                
              </div>
            </div><!-- /.col -->
            <div class="col-xs-8">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Mandar recordatorio</button>
            </div><!-- /.col -->
          </div>
        </form>

        
         <a href="login.php" class="text-center">Login</a>

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
  </body>
</html>

