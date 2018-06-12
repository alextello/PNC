<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navegación</li>
        <!-- Optionally, you can add icons to the links -->
<li {{ request()->is('admin') ? 'class=active' : ''}}><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        {{-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
        <li class="treeview {{ request()->is('admin/posts*') ? 'active' : ''}}" >
          <a href="#"><i class="fa fa-folder"></i> <span>Eventos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li {{ request()->is('admin/posts') ? 'class=active' : ''}}><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i>Ver eventos</a></li>
            <li>
              @if(request()->is('admin/posts/*'))
               <a href="{{ route('admin.posts.index', '#create') }}"><i class="fa fa-pencil"></i>Crear evento</a>
              @else
              <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>Crear evento</a>
              @endif
            </li>
          </ul>
        </li>
        <li class="treeview {{ request()->is('admin/plantillas*') ? 'active' : ''}}" >
          <a href="#"><i class="fa fa-align-left"></i> <span>Plantillas</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li {{ request()->is('admin/plantillas') ? 'class=active' : ''}}><a href="{{ route('admin.plantillas.index') }}"><i class="fa fa-eye"></i>Ver plantillas</a></li>
            <li {{ request()->is('admin/plantillas/create') ? 'class=active' : ''}}>
               <a href="{{ route('admin.plantillas.create') }}"><i class="fa fa-pencil"></i>Crear plantilla</a>
            </li>
          </ul>
        </li>

        <li class="treeview {{ request()->is('admin/users*') ? 'active' : ''}}" >
            <a href="#"><i class="fa fa-users"></i> <span>Usuarios</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li {{ request()->is('admin/users') ? 'class=active' : ''}}><a href="{{ route('admin.users.index') }}"><i class="fa fa-eye"></i>Ver usuarios</a></li>
              <li {{ request()->is('admin/users/create') ? 'class=active' : ''}}>
                 <a href="{{ route('admin.users.create') }}"><i class="fa fa-pencil"></i>Crear usuario</a>
              </li>
            </ul>
          </li>

          <li class="treeview {{ request()->is('admin/estadisticas*') ? 'active' : ''}}" >
            <a href="#"><i class="fa fa-pie-chart"></i> <span>Estadisticas</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
              <li {{ request()->is('admin/estadisticas/tag') ? 'class=active' : ''}}>
                <a href="{{ route('admin.estadisticas.tag') }}"><i class="fa fa-tags"></i>Ver por etiquetas</a>
              </li>
              <li {{ request()->is('admin/estadisticas/categoria') ? 'class=active' : ''}}>
                 <a href="{{ route('admin.estadisticas.categoria') }}" ><i class="fa fa-tag"></i>Ver por categorias</a>
              </li>
              <li {{ request()->is('admin/estadisticas/auth') ? 'class=active' : ''}}>
                 <a href="{{ route('admin.estadisticas.auth') }}"><i class="fa fa-user"></i>Ver por autor</a>
              </li>
            </ul>
          </li>
 </ul>

 @push('scripts')
 <script>

    if(window.location.hash === '#create')
    {
      $('#myModal').modal('show');
      $('#title').focus();
    }

    // if(window.localtion.hash === '#error')
    // {
    //   $('#myModal').modal('hide');
    // }   
       $('#myModal').on('hide.bs.modal', function(){
         window.location.hash = '#';
       });
   
       $('#myModal').on('shown.bs.modal', function(){
         window.location.hash = '#create';
         $('#title').focus();
       });
   </script>

   <script>
 
   </script>
 @endpush