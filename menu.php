      <? $fichero= basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="./dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p style='white-space: pre-line;'>Usuario:<span style='font-weight:normal'><? echo ($_SESSION['nombreusuario']);?></span></p>
              
            </div>
          </div>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class=''><a><span style="white-space:normal !important;color:#008cd1"><? echo "Perfil:".NombrePerfil($_SESSION['perfil']);?></span></a></li>

            <li class="header">MI ESPACIO</li>
            <li <? if($fichero=="ficheros")echo " class='active'"; ?> ><a href="ficheros.php"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Ver</span></a></li>
           
           
            <!--

            <li class="header">DOCUMENTOS</li>
            <li><a href="#"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Documento 1</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Documento 2</span></a></li>
           
            -->
          <li class="header">MI CUENTA</li>
          <li><a href="misdatos.php"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Mis datos</span></a></li>
			<?if ($_SESSION['perfil']=="2"){?>
			<li class="header">ADMIN</li>
			<li <? if($fichero=="usuarios")echo " class='active'"; ?> ><a href="usuarios.php"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Usuarios</span></a></li>
			<li <? if($fichero=="usuariospendientes")echo " class='active'"; ?> ><a href="usuariospendientes.php"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Usuarios pendientes</span></a></li>
			<li <? if($fichero=="pruebacorreo")echo " class='active'"; ?> ><a href="pruebacorreo.php"><i class="fa fa-circle-o "></i> <span style="white-space:normal !important;">Prueba correo</span></a></li>
			<? }?>
		   
         
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>