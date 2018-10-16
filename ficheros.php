<?
session_start();
if ($_SESSION['dirRAIZ']==""){
		$_SESSION['error']="Se ha producido un error con tu directorio raiz";
		header("Location:error.php");die;
	}
$_SESSION['error']="";
$_SESSION['trazas']="";

	$raiz="RAIZ/".$_SESSION['dirRAIZ'];
	
	if (isset($_SESSION['directorio']) && $_SESSION['directorio']!=""){
		$dir=$_SESSION['directorio'];
	}else{
		$dir=$raiz;
	}
	if (isset($_POST['dir']) && $_POST['dir']!=""){
		if ($_POST['dir']==".."){
			$dir=substr($dir,0,strrpos($dir,"/"));
		}else{
			$dir.="/".$_REQUEST['dir'];
		}
		
	}
	
	
	if (strpos($dir,$raiz)===false){
		$_SESSION['error']="Se ha producido un error al navegar";
		header("Location:error.php");
	}
	$_SESSION['directorio']=$dir;
	$dirbarra=$dir."/";
	
	$actual=substr($dir,strlen($raiz));
	include_once("cabecera.php");
?>
	<style>
	#formdrop{
		text-align:center;
		padding:20px;
		border:1px solid #3F84FF ;
		border:2px dotted #3F84FF !important;
	}
	#fd-file{
		color:#3F84FF;
		border:1px solid #3F84FF !important;
		border:4px dotted #3F84FF !important;
		background-color:#eeeeee;
		padding:50px;
		width:100%;
	}
	#ayuda{
		height:105px;
		
	}
	#ayudatexto{
		
		color:#D40013;
		font-size:16pt;
	}
	</style>
	<script>
		function ver(directorio){
			document.getElementById('dirsalto').value=directorio;
			document.getElementById('f1').submit();
		}
	</script>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		<form action="ficheros.php" method="POST" id="f1">
			<input type="hidden" name="dir" id="dirsalto" value="">
		</form>
		 <form action="borrarfichero.php" method="POST" style="display:inline" id="f6" name="f6">
                  <input type="hidden" name="idficheroborrar" id="idficheroborrar" value="">
                  </form>
        <section class="content-header">
          <h1>
            Ficheros
            <small><?=$actual?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Ficheros</li>
          </ol>
        </section>
         <!-- Main content -->
        <section class="content">

        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Navegador</h3>
                </div><!-- /.box-header -->

                <?
	
                
				?>
                <div class="box-body">
					<div class="row">
						<div class="col-xs-3">
							<ul class="nav">
							<?
								if ($raiz!=$_SESSION['directorio']){
									echo "<li>";
										echo "<a href='#' onclick='ver(\"..\")'><i class='fa fa-folder'></i>..</a></li>";
								}else{
									echo "<li>RAIZ</li>";
								}
								foreach (glob($dirbarra."*") as $file) {
									
									if (is_dir($file)){
										$nombrecarpeta=substr($file,strlen($dirbarra));
										echo "<li>";
										echo "<a href='#' onclick='ver(\"".$nombrecarpeta."\")'><i class='fa fa-folder'></i>";
										echo $nombrecarpeta;
										echo "</a></li>";
									}
									
								}
							
							?>
							</ul>
						</div>
						<div class="col-xs-9">
						  <table id="example1" class="table table-bordered table-hover">
							<thead>
							  <tr>
								<th>Nombre</th>
								<th>Fecha</th>
								<th>Tamaño</th>
								
								<th>Tipo</th>
								
								
							  </tr>
							</thead>
							<tbody>
							  <?
							
								foreach (glob($dirbarra."*") as $file=>$f) {
									
									if (is_file($f)){
										$ficheros++;
										$nombre=substr($f,strlen($dirbarra));
										$fecha=date ("d/m/Y H:i:s.", filemtime($f));
										$estadísticas = stat($f);
										$tam=$estadísticas['size'];
										$tipo=substr($nombre,strrpos($nombre,".")+1);
										echo '<tr class="context-menu-one"  id="'.$f.'">
										
											<td>';
										echo "<a href='".$f."' target='_blank'>".$nombre."</a>";
										if(strpos($nombre,".jpg")!==false || strpos($nombre,".png")!==false || strpos($nombre,".pdf")!==false){
											$modal=true;
										}else{
											$modal=false;
										}
										
										if ($modal){
											echo "<a href='#' onclick='modal(\"".$f."\")'>&nbsp;&nbsp;&nbsp;<i class='fa fa-image'></i></a>";
										}else{
											
										}
										
										echo '</td>
											<td>'.$fecha.'</td>
											<td>'.$tam.'</td>
											<td>'.$tipo.'</td>
										   
											
											   
											  </tr>';
												
									}
								  
									
								}
							  
							  ?>
							</tbody>
									   <tfoot>
							  <tr>
								<th>Nombre</th>
								<th>Fecha</th>
								<th>Tamaño</th>
								<th>Tipo</th>
								
							  </tr>
							</tfoot>
						  </table>
						</div>
					</div>
                </div><!-- /.box-body -->
				<div class="box-header">
                  <h3 class="box-title">Subir Fichero</h3>
                </div><!-- /.box-header -->
				<div class="box-footer">
					
					<div class="row">
						<div class="col-xs-12">
						
							<div id="formdrop">
								<form id="upload" action="subirfichero.php" method="POST" enctype="multipart/form-data">
									
								<div id="ayuda"><table id="ayudatexto" style="display:none"><tr><td>Drag and drop a file from your desktop</td><td><img src="dist/img/flecharoja.png"></td></tr></table></div>
								<input type="file" id="fd-file" name="fd-file" data-validate="required">
								<output id="filesInfo"></output>
								<div id="submitbutton">
									<input type="submit" class="btn btn-success" value="Subir" id="btsubmit" >
								</div>
								</form>
							</div>
													
						
						</div>
					</div>
				</div>
              </div><!-- /.box -->
			  <div class="box">
				<div class="box-header">
                  <h3 class="box-title">Crear directorio</h3>
                </div><!-- /.box-header -->
				<div class="box-footer">
					
					<div class="row">
						<form id="upload" action="creardirectorio.php" method="POST" >
						<div class="col-xs-9">
							<label for="dir">Nombre</label>
							<input type="text" name="dir" id="dir" data-validate="required" placeholder="Nombre del directorio" class="form-control" autocomplete="off">
						</div>
						<div class="col-xs-3"><label>&nbsp;</label> <br>
							<input type="submit" class="btn btn-success" value="Crear" id="btsubmit" >
						</div>
						</form>
					</div>
				</div>
			  </div>
          
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?include_once("pie.php");?>
	    <script src="plugins/contextMenu/jquery.contextMenu.js" type="text/javascript"></script>

    <script src="plugins/contextMenu/jquery.ui.position.min.js" type="text/javascript"></script>
    <link href="plugins/contextMenu/jquery.contextMenu.css" rel="stylesheet" type="text/css" />
	
	
      <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
      <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
      <link rel="stylesheet" href="plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
	  
	  
      <link rel="stylesheet" href="plugins/modallink/jquery.modalLink-1.0.0.css">
	  <script src="plugins/modallink/jquery.modalLink-1.0.0.js"></script>
      <script>
      $(function () {
        $("#example1").DataTable({
			"language": {
            "lengthMenu": "Mostrando _MENU_ elementos por pagina",
            "zeroRecords": "No hay resultados",
            "info": "Viendo la  pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultado",
            "infoFiltered": "(filtered from _MAX_ total records)"
			},
		  "lengthMenu": [[-1,50, 25, 10],["All",50, 25, 10]],	
          "paging": false,
          "lengthChange": true,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": true,
          "orderable": false,
          "responsive":true,
            // Create an HTML select with all the versions of the data
            //TODO Correggi +01
            "render": function (row, type, val, meta) {
                return  '<input type="checkbox"/>';
        	}
        });
      });
    </script>
		<script>
  function fileSelect(evt) {
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var files = evt.target.files;
 
        var result = '';
        var file;
        for (var i = 0; file = files[i]; i++) {
            // if the file is not an image, continue
            if (!file.type.match('image.*')) {
                continue;
            }
 
            reader = new FileReader();
            reader.onload = (function (tFile) {
                return function (evt) {
                    var div = document.createElement('div');
                    div.innerHTML = '<img style="width: 90px;" src="' + evt.target.result + '" />';
                    document.getElementById('filesInfo').appendChild(div);
                };
            }(file));
            reader.readAsDataURL(file);
        }
    } else {
        alert('The File APIs are not fully supported in this browser.');
    }
}
 
 var item = document.getElementById("fd-file");
item.addEventListener('change', fileSelect, false);
item.addEventListener("mouseover", dentro, false);
item.addEventListener("mouseout", fuera, false);

function dentro()
{  
   document.getElementById('ayudatexto').style.display="";

}

function fuera()
{  
	 document.getElementById('ayudatexto').style.display="none";
  
}
function abrirenlace(fichero){
	window.open(fichero);
}
function preguntaborrar(fichero){
            document.getElementById('idficheroborrar').value=fichero;
            swal({
            title: 'Borrar?',
            text: "¿Está seguro de borrar el fichero?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí,borrar!'
          }).then(function () {
              document.getElementById('f6').submit();
          }, function(dismiss) {
          // dismiss can be 'overlay', 'cancel', 'close', 'esc', 'timer'
              
          })

        }     
function modal(fichero){
	$.modalLink.open(fichero, {

		// options here

	  }); 
}

       $(function() {
        $.contextMenu({
            selector: '.context-menu-one', 
            callback: function(key, options, rootMenu, originalEvent) {
                var m = "clicked: " + key;
                id_fila=options.$trigger[0].id;
                if (id_fila!=""){
                  switch(key){
                   case "ver":
                      abrirenlace(id_fila);
                      break;
                   case "modal":
                      modal(id_fila);
                      break;
                   case "borrar":
                      preguntaborrar(id_fila);
                      break;
                  }
                }
                
            },
            items: {
                "ver": {name: "Ver", icon: "edit"},
                "modal": {name: "Modal", icon: "edit"},
               
                "borrar": {name: "Borrar", icon: function(){
                    return 'context-menu-icon context-menu-icon-quit';
                }}
            }
        });

        
    });
</script>
    <?include_once("finhtml.php");?>