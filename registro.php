<?include_once("cabecerafuera.php");
require_once("lib/funciones.php");


?>
  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
        <a href="index.php"><b><?=NOMBREWEB?></b></a>
      </div>

      <div class="register-box-body">

        <p class="login-box-msg">Registro</p>
        <form action="registrar.php" method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" data-validate="required">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
           <div class="form-group has-feedback">
            <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
           
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email"  data-validate="required">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="email" class="form-control" id="email2" name="email2" placeholder="Repite Email"  data-validate="required">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Teléfono">
            <span class="glyphicon glyphicon-phone-alt form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="clave" name="clave" placeholder="Clave"  data-validate="required">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" id="clave2" name="clave2" placeholder="Repite clave"  data-validate="required">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-8">
              &nbsp;
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Registrar</button>
            </div><!-- /.col -->
          </div>
        </form>

       

        <a href="login.php" class="text-center">Ya estoy registrado</a>
      </div><!-- /.form-box -->
    </div><!-- /.register-box -->

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
