    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><img class="app-sidebar__user-avatar" src="<?= media(); ?>/images/avatar.png" alt="User Image">
        <div>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['trabajador_nombre'] ?></p>
          <p class="app-sidebar__user-designation"><?= $rol = $_SESSION['userData']['users_rol'] == 1 ? 'DIGITALIZADOR':'ADMINISTRADOR'  ?></p>
          <p class="app-sidebar__user-name"><?= $_SESSION['userData']['nombre'] ?>
        </div>
      </div>
      <ul class="app-menu">
        
        <li><a class="app-menu__item" href="<?= base_url(); ?>/dashboard"><i class="app-menu__icon fa fa-dashboard"></i><span class="app-menu__label">Dashboard</span></a></li>
        
        <?php if(!empty($_SESSION['userData']['users_rol'] == 3 || $_SESSION['userData']['users_rol'] == 1 )) {?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-archive" aria-hidden="true"></i><span class="app-menu__label">Documentos</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url(); ?>/oficios"><i class="icon fa fa-circle-o"></i> Oficios</a></li>
          </ul>
        </li>
        <?php } ?>

        <?php if(!empty($_SESSION['userData']['users_rol'] == 3 || $_SESSION['userData']['users_rol'] == 1 )) {?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-bell" aria-hidden="true"></i><span class="app-menu__label">Notificaciones</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
        </li>
        <?php } ?>
        
        <?php if(!empty($_SESSION['userData']['users_rol'] == 3)){ ?>
        <li class="treeview">
          <a class="app-menu__item" href="#" data-toggle="treeview">
            <i class="app-menu__icon fa fa-cogs"" aria-hidden="true"></i><span class="app-menu__label">Configuración</span>
            <i class="treeview-indicator fa fa-angle-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="<?= base_url(); ?>/usuarios"><i class="icon fa fa-circle-o"></i> Usuarios</a></li>
          </ul>
        </li>
        <?php } ?>

        <li>
            <a class="app-menu__item" href="<?= base_url(); ?>/logout">
                <i class="app-menu__icon fa fa-sign-out" aria-hidden="true"></i>
                <span class="app-menu__label">Logout</span>
            </a>
        </li>


        
        
      </ul>
    </aside>