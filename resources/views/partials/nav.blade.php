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
<form action="{{ url()->full()}}" id="searchForm" method="get" target="_blank">
    @csrf
  <label>Rango de fecha:</label>
  <div class="form-group">
      
      <div class="col-md-6">
          <div class="input-group">
              <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
              </div>
              <input type="text" class="form-control pull-right" name="reservation" id="reservation">
          </div>
      </div>
      <div class="col-md-6">
          <button class="btn btn-primary btn-block" id="buscar">Buscar</button>
      </div>
      </div>
  </form>
  <div class="text-muted">
        <p>Escoja un dia antes del deseado en el rango de fecha</p>
    </div>
@endif
{{-- <div class="container container-flex space-between">
  <nav class="custom-wrapper" id="menu">
      <div class="pure-menu"></div>
      <ul class="container-flex list-unstyled">
          <li><a href="{{ route('pages.home') }}" class="text-uppercase {{ setActiveRoute('pages.home') }}">Inicio</a></li>
      </ul>
  </nav>
</div> --}}