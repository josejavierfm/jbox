<?
session_start();
include_once("cabecera.php");
?>
<style>
.fversion{
	font-size:8pt;
}
.listaversiones{
	font-weight:bold;
}
.listaversiones p{
	font-weight:normal;
}
</style>
 <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Logs
          </h1>
         
        </section>
         <!-- Main content -->
        <section class="content">
			 <div class="box">
                <div class="box-header">
                  <h3 class="box-title"> Versiones </h3>
                </div><!-- /.box-header -->
				<div class="box-body">
				<ul class="listaversiones">
					
					<li> 1.0.0
						<p>Primera version</p> 
						<span class="fversion">16 octubre 2018</span>
					</li>
				</ul>
				</div>
		    </div><!-- /.box -->
           
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
 <?include_once("pie.php");?>
 <?include_once("finhtml.php");?>