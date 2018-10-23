<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('title', 'Reportes PNC')</title>
	<meta content="{{csrf_token()}}" name="csrf-token" >
	<meta name="description" content="@yield('meta-content', 'Sistema de reporteria de la Policia Nacional Civil de Guatemala')">
	<link rel="stylesheet" href="{{asset('/css/normalize.css')}}">
	<link rel="stylesheet" href="{{asset('/css/framework.css')}}">
	<link rel="stylesheet" href="{{asset('/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('/css/responsive.css')}}">
	<link rel="stylesheet" href="{{asset('/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <style>
    
    </style>
	@stack('styles')
	<link rel="shortcut icon" type="image/x-icon" href="/adminlte/img/pnc.jpg" />
</head>
<body>
    <div id="app">
	<div class="preload"></div>
	<header class="space-inter">
		<div class="container container-flex space-between">
			<figure class="logo"><img src="/img/logo.png" alt=""></figure>
			<nav-bar></nav-bar>
               
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
                {{-- <div class="container container-flex space-between">
                  <nav class="custom-wrapper" id="menu">
                      <div class="pure-menu"></div>
                      <ul class="container-flex list-unstyled">
                          <li><a href="{{ route('pages.home') }}" class="text-uppercase {{ setActiveRoute('pages.home') }}">Inicio</a></li>
                      </ul>
                  </nav>
                </div> --}}
		</div>
		@stack('scripts')
		
    </header>
<router-view></router-view>
    <section class="footer">
            <footer>
                <div class="container">
                    <figure class="logo"><img src="/img/logo.png" alt=""></figure>
                    <nav>
                        <ul class="container-flex space-center list-unstyled">
                            <li><a href=" {{ route('pages.home') }}" class="text-uppercase c-white">Inicio</a></li>
                            <li><a href=" {{ route('pages.about') }}" class="text-uppercase c-white">Acerca de</a></li>
                            <li><a href=" {{ route('pages.archive') }}" class="text-uppercase c-white">archive</a></li>
                            <li><a href=" {{ route('pages.contact') }}" class="text-uppercase c-white">Contacto</a></li>
                        </ul>
                    </nav>
                    <div class="divider-2"></div>
                    <p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p>
                    <div class="divider-2" style="width: 80%;"></div>
                    <p>© 2017 - Zendero. All Rights Reserved. Designed & Developed by <span class="c-white">Agencia De La Web</span></p>
                    <ul class="social-media-footer list-unstyled">
                        <li><a href="#" class="fb"></a></li>
                        <li><a href="#" class="tw"></a></li>
                        <li><a href="#" class="in"></a></li>
                        <li><a href="#" class="pn"></a></li>
                    </ul>
                </div>
            </footer>
        </section>
    </div>
    </body>
    <link rel="stylesheet" href="{{asset("/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("/css/twitter-bootstrap.css")}}">
    <link rel="stylesheet" href="{{asset("/css/style.css")}}">
    <link rel="stylesheet" href="{{asset("/adminlte/bower_components/font-awesome/css/font-awesome.min.css")}}">
    <link rel="stylesheet" href="{{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}">
    <script src="{{asset("/adminlte/bower_components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("/js/twitter-bootstrap.js")}}"></script>
    <script src="{{asset("/adminlte/bower_components/moment/min/moment.min.js")}}"></script>
    <script src="{{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
<script>
    $('#reservation').daterangepicker({
        'startDate': '01/01/2019',
        'endDate': '02/01/2019',
        locale: {
      format: 'D/M/YYYY'
    }
    });
</script>

    <script src="{{ mix('js/app.js') }}"></script>
    </html>

@push('styles')
 
@endpush

@push('scripts')

@endpush
	