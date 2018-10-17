<?

	$omy = new DB_mysql();
	$omy->conectar("");
	
if ($_SESSION['directorio']!=""){
	$numficheros=numFicheros($_SESSION['directorio']);
	$numdirectorios=numDirectorios($_SESSION['directorio']);
}else{
	$numficheros="-";
	$numdirectorios="-";
}

$datosultimoacceso= datosUltimoAcceso($omy,$_SESSION[prefijo.'idusuario']);
?>
      <!-- Left side column. contains the logo and sidebar -->
      

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Estado
            <small>Panel de control</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Estado</a></li>
            
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">

            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box <?if ($numficheros==0){ echo "bg-red";}else{ echo "bg-green";}?>">
                <div class="inner">
                  <h3><? echo $numficheros;?></h3>
                  <p class="h42">Ficheros</p>
                </div>
                <div class="icon">
                  <i class="ion ion-users"></i>
                </div>
                <a href="ficheros.php" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			 <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box <?if ($numdirectorios==0){ echo "bg-red";}else{ echo "bg-green";}?>">
                <div class="inner">
                  <h3><? echo $numdirectorios;?></h3>
                  <p class="h42">Directorios</p>
                </div>
                <div class="icon">
                  <i class="ion ion-users"></i>
                </div>
                <a href="ficheros.php" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			<? if ($_SESSION['perfil']>1){
				$numpendientes=numPendientes($omy);
			?>
			  <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box <?if ($numpendientes==0){ echo "bg-red";}else{ echo "bg-green";}?>">
                <div class="inner">
                  <h3><? echo $numpendientes;?></h3>
                  <p class="h42">Usuarios pendientes</p>
                </div>
                <div class="icon">
                  <i class="ion ion-users"></i>
                </div>
                <a href="usuariospendientes.php" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			<?}?>
           
            
            
            
          </div><!-- /.row -->
          <!--<div class="row">
             <div class="col-lg-12" style="text-align: center;">
                <img src='dist/img/logo.png'>
             </div>
          </div>-->
		  <div class="row">
             <div class="col-lg-12">
                <label>Sus &uacute;ltimos accesos fueron:<br/>
					<? if ($datosultimoacceso){
						foreach ($datosultimoacceso as $dto){
							echo "".$dto['fecha']?> desde la ip <?=$dto['ip']."<br>";
						}
					}
					?>
				</label>
             </div>
          </div>

         
     
          <!-- Main row -->
          <div class="row">
           </div><!-- /.row (main row) -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->