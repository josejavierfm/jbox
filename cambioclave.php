<?  include_once("cabecera.php");
?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Cambio clave
            <small></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Cambio clave</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Cambio clave</h3>
                </div><!-- /.box-header -->

                <!-- form start -->
                <form role="form" action="cambiarclave.php" method="POST">
                  <div class="box-body">
      
      
                  <? if ($_SESSION['tienecambiarclave']){ ?>
                  <div class="row">
                    <div class="col-xs-12">
                      <label style='color:red;'><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Por seguridad debe cambiar la clave, hace mas de 200 días que no la ha cambiado</label>
                    </div>
                  </div>
                  <?}?>

                  <div class="row">
                    <div class="col-xs-6">
                     <label for="v6_1">Clave actual</label>
                    </div>
                    <div class="col-xs-6">
                      
                      <input type="password" name="actual" id="actual" class="form-control" placeholder="" data-validate="required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6">
                     <label for="v6_2">Nueva clave</label>
                    </div>
                    <div class="col-xs-6">
                      
                      <input type="password" name="nueva" id="nueva" class="form-control" placeholder="" data-validate="required">
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-6">
                     <label for="v6_3">Repite nueva clave</label>
                    </div>
                    <div class="col-xs-6">
                      
                      <input type="password" name="repite" id="repite" class="form-control" placeholder="" data-validate="required">
                    </div>
                  </div>
                 
                 
               


 
                  
         
                </div><!-- /.box-body -->

                  <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                  </div>
                </form>
              </div><!-- /.box -->

             
             
              

            </div><!--/.col (left) -->
            
          </div>   <!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <?include_once("pie.php");?>
      <script>
              <?
              if ($datos){
                echo "$('#v6_1').val('".$datos[0]['v6_1']."');";
                echo "$('#v6_2').val('".$datos[0]['v6_2']."');";
                echo "$('#v6_3').val('".$datos[0]['v6_3']."');";
              }
              ?>
      </script>
      <?include_once("finhtml.php");?>