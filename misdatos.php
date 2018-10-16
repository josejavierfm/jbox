<?include_once("cabecera.php");$_SESSION['error']="";
		$omy = new DB_mysql();
		$omy->conectar("");
		
		
		$misdatos=misdatos($omy,$_SESSION[prefijo.'idusuario']);
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Mis datos
            
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Mis datos</li>
          </ol>
        </section>
         <!-- Main content -->
        <section class="content">

			<div class="row">
            <!-- left column -->
            <div class="col-md-12">
			<form role="form" action="guardarmisdatos.php" method="POST">
              
			  
			<div class="box box-info">
                <div class="box-header with-border">
                  <h3 class="box-title">MIS DATOS</h3>
                </div>
                <div class="box-body">
                  <div class="row">
                    <div class="col-xs-3">
					            <label for="email">EMAIL</label>
                      <input type="text" name="email" id="email" class="form-control" placeholder="EMAIL" data-validate="required,email">
                    </div>
                    <div class="col-xs-3">
                      <label for="clave"> NUEVA CLAVE</label>
                      <input type="text" name="clave" id="clave" class="form-control" placeholder="">
                    </div>
                    <div class="col-xs-3">
                      <label for="nuevaclave">REPITE CLAVE</label>
                      <input type="text" name="nuevaclave" id="nuevaclave" class="form-control" placeholder="">
                    </div>
                   <div class="col-xs-3">
                      <label for="telefono">TELEFONO</label>
                      <input type="text" name="telefono" id="telefono" class="form-control" placeholder="" data-validate="required">
                    </div>
                   
                  </div>
                   <div class="row">
                    <div class="col-xs-6">
                      <label for="nombre">NOMBRE</label>
                      <input type="text" name="nombre" id="nombre" class="form-control" placeholder="NOMBRE" data-validate="required">
                    </div>
                    <div class="col-xs-6">
                      <label for="apellidos">APELLIDOS</label>
                      <input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="">
                    </div>
                  </div>
				 
				   
				  
				 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
			<div class="box-footer"> 
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                  </div>
            </form>
		</div>   <!-- /.row -->





        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?include_once("pie.php");?>
	 <script>
document.getElementById('nombre').value='<?=$misdatos['nombre']?>';
document.getElementById('apellidos').value='<?=$misdatos['apellidos']?>';
document.getElementById('email').value='<?=$misdatos['email']?>';
document.getElementById('telefono').value='<?=$misdatos['telefono']?>';



    </script>
      <?include_once("finhtml.php");?>