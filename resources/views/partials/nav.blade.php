<nav class="custom-wrapper" id="menu">
    <div class="pure-menu"></div>
    <ul class="container-flex list-unstyled">

    <li><a href="{{ route('pages.home') }}" class="text-uppercase {{ setActiveRoute('pages.home') }}">Inicio</a></li>
        <li><a href="{{ route('pages.about') }}" class="text-uppercase {{ setActiveRoute('pages.about') }}">Acerca de</a></li>
        <li><a href="{{ route('pages.archive') }}" class="text-uppercase {{ setActiveRoute('pages.archive') }}">Archivo</a></li>
        <li><a href="{{ route('pages.contact') }}" class="text-uppercase {{ setActiveRoute('pages.contact') }}">Contacto</a></li>
        <li><a href="{{ route('login') }}" class="text-uppercase {{ setActiveRoute('auth.login') }}">Login</a></li>
    </ul>
</nav>
@if(request()->routeIs('pages.home') || 
        request()->routeIs('categories.show') || 
        request()->routeIs('subcategories.show') ||
        request()->routeIs('tags.show') )
        <div class="form-group col-md-12">
        <form class="form-inline" action="{{ url()->full()}}" id="searchForm" method="get" target="_blank">
            @csrf
          <label>Rango de fecha:</label>
          <div class="form-group">
              
                  <div class="input-group">
                      <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" name="reservation" id="reservation">
                  </div>
              <div class="form-group">
                  <button class="btn btn-primary" id="buscar">Buscar</button>
              </div>
              </div>
          </form>
        </div> 

        <div class="form-group col-md-12">
                <form class="form-inline" action="{{route('buscar.novedad')}}" id="searchForm" method="get" target="_blank">
                    @csrf
                  <label>Buscar novedad: </label>
                  <input type="text" class="form-control" name="titulo" placeholder="Ingrese el titulo" required>
                      <div class="form-group">
                          <button class="btn btn-primary" id="buscarT">Buscar</button>
                      </div>
                      </div>
                  </form>
                </div> 
        @endif
