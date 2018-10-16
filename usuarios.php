<?
session_start();
if ($_SESSION['perfil']=="1" ){
    $_SESSION['error']="No tienes permiso";
    header("Location:error.php");die;
  }
include_once("cabecera.php");
$_SESSION['error']="";
$_SESSION['trazas']="";
$_SESSION['condicion']="";
$_SESSION['tcondicion']="";
$_SESSION['idpaciente']="";
$_SESSION['contadorpaciente']="";
$_SESSION['fechavisita']="";
?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Usuarios
            <small>Lista</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>
         <!-- Main content -->
        <section class="content">

        	<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Lista usuarios</h3>
                </div><!-- /.box-header -->

                <?

                $omy = new DB_mysql();
				        $omy->conectar("");
                     $sentencia="select u.id,u.nombre,u.apellidos,email
                             from ".prefijo."usuario u
                             where valido=1";
                
				        
                $omy->Query=$sentencia;
                $res=$omy->arr_asocia();
				?>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>Nombre</th>
						<th>Apellidos</th>
                        <th>Email</th>
                        
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      if ($res){
                      	foreach($res as $r){
                          
                      		echo '<tr>
		                        
                            <td>'.$r['nombre'].'</td>
                            <td>'.$r['apellidos'].'</td>
                            <td>'.$r['email'].'</td>
                           
                            
		                       
		                      </tr>';
		                  }
		              }
		              ?>
                    </tbody>
					           <tfoot>
                      <tr>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      
      <?include_once("pie.php");?>
      <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
      <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
      <link rel="stylesheet" href="plugins/datatables/extensions/Responsive/css/dataTables.responsive.css">
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
    <?include_once("finhtml.php");?>