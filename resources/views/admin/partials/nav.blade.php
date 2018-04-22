<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navegación</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        {{-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
        <li class="treeview">
          <a href="#"><i class="fa fa-clipboard"></i> <span>Reportes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i>Ver reportes</a></li>
            <li><a href="#"><i class="fa fa-pencil"></i>Crear reporte</a></li>
          </ul>
        </li>
 </ul>