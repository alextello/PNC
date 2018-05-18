<ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navegación</li>
        <!-- Optionally, you can add icons to the links -->
<li {{ request()->is('admin') ? 'class=active' : ''}}><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        {{-- <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li> --}}
        <li class="treeview {{ request()->is('admin/posts*') ? 'active' : ''}}" >
          <a href="#"><i class="fa fa-clipboard"></i> <span>Reportes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li {{ request()->is('admin/posts') ? 'class=active' : ''}}><a href="{{ route('admin.posts.index') }}"><i class="fa fa-eye"></i>Ver reportes</a></li>
            <li>
              @if(request()->is('admin/posts/*'))
               <a href="{{ route('admin.posts.index', '#create') }}"><i class="fa fa-pencil"></i>Crear reporte</a>
              @else
              <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-pencil"></i>Crear reporte</a>
              @endif
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
   
       $('#myModal').on('hide.bs.modal', function(){
         window.location.hash = '#';
       });
   
       $('#myModal').on('shown.bs.modal', function(){
         window.location.hash = '#create';
         $('#title').focus();
       });
   </script>
 @endpush