<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="img/audra_logo.png" width="50px" height="50px">
        </div>
        <div class="sidebar-brand-text mx-3">Audra <sup>Tech</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" style="position: fixed;" >
      <li class="nav-item">
        <label class="nav-link">
         <?php if($_SESSION['prol']=="estudiante" || $_SESSION['prol']=="Coinvestigador" || $_SESSION['prol']=="Inv Principal"){?>
            <i class="fas fa-fw fa-user"></i>
            <span><?php echo $_SESSION['username'] ?></span>
          <?php } ?>
        </label>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Opciones
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item <?php echo $proyectos;?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-folder"></i>
          <span>Proyectos</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="index.php">Mesa de trabajo</a>
              <?php if($_SESSION['prol']=='administrador'){?>
            <a class="collapse-item" href="calendario.php">Calendario</a>
          <?php }?>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
       <?php if($_SESSION['prol']=="Inv Principal"  || $_SESSION['prol']=="Coinvestigador" || $_SESSION['prol']=="administrador"){?>
      <li class="nav-item <?php echo $segmento;?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>Segmento</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
             <a class="collapse-item" href="programas.php">Programas</a>
             <a class="collapse-item" href="grupos.php">Grupos</a>
            <a class="collapse-item" href="miembros.php">Miembros</a>
          </div>
        </div>
      </li>
      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Componentes
      </div>
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="true" aria-controls="collapsePages1">
          <i class="fas fa-fw fa-folder"></i>
          <span>Graficas</span>
        </a>
        <div id="collapsePages1" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="pastel.php">Pastel</a>
            <a class="collapse-item" href="barra.php">Barra</a>
            <a class="collapse-item" href="barra_horizontal.php">Barra Horizontal</a>
             <a class="collapse-item" href="barra_triangular.php">Barra Triangular</a>
          </div>
        </div>
      </li>
<?php } ?>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>