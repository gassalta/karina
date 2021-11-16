 <!-- Sidebar menu-->
 <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="images/<?=$_SESSION['imagen']?>" width="48px" alt="Sue Palacios">
          <div>
            <p class="app-sidebar__user-name"><?=$_SESSION['nombre'].' '.$_SESSION['apellido']?></p>
            <p class="app-sideba__user-designation"><?=$_SESSION['nivel']?></p>
          </div>
        </div>
        <ul class="app-menu">
            <li><a class="app-menu__item active" href="index.php"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Inicio</span></a></li>
    
            <li><a class="app-menu__item" href="carga.php"><i class="app-menu__icon fa fa-edit"></i><span class="app-menu__label">Registro</span></a></li>
    
            <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-th-list"></i><span class="app-menu__label">Listados</span><i class="treeview-indicator fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a class="treeview-item" href="listado.php"><i class="icon fa fa-circle-o"></i> Listado de incidencias</a></li>
                <!--otros listados
                <li><a class="treeview-item" href="listado.php"><i class="icon fa fa-circle-o"></i> Listado2</a></li>
                <li><a class="treeview-item" href="listado.php"><i class="icon fa fa-circle-o"></i> Listado3</a></li>            
                -->
              </ul>
            </li>
          </ul>
      </aside>
    <!-- fin Sidebar menu-->