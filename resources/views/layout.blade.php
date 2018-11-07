<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>@yield('title', 'Reportes PNC')</title>
	<meta content="{{csrf_token()}}" name="csrf-token" >
	<meta name="description" content="@yield('meta-content', 'Sistema de reporteria de la Policia Nacional Civil de Guatemala')">
	<link rel="stylesheet" href="{{'/css/normalize.css'}}">
	<link rel="stylesheet" href="{{'/css/framework.css'}}">
	<link rel="stylesheet" href="{{'/css/style.css'}}">
	<link rel="stylesheet" href="{{'/css/responsive.css'}}">
	{{-- <link rel="stylesheet" href={{asset("/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css")}}> --}}
	<link rel="stylesheet" href="/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
	@stack('styles')
	<link rel="shortcut icon" type="image/x-icon" href="{{'/adminlte/img/pnc.jpg'}}" />
</head>
<body>
	<div class="preload"></div>
	<header class="space-inter">
		<div class="container container-flex space-between">
			<figure class="logo"><img src="{{'/img/logo.png'}}" alt=""></figure>
			@include('partials.nav')
		</div>
		@stack('scripts')
		
    </header>
    
    @yield('content')

    <section class="footer">
		<footer>
			<div class="container">
				<figure class="logo"><img src="{{'/img/logo.png'}}" alt=""></figure>
				<nav>
					<ul class="container-flex space-center list-unstyled">
						<li><a href=" {{ route('pages.home') }}" class="text-uppercase c-white">Inicio</a></li>
						<li><a href=" {{ route('pages.about') }}" class="text-uppercase c-white">Acerca de</a></li>
						<li><a href=" {{ route('pages.archive') }}" class="text-uppercase c-white">archive</a></li>
						<li><a href=" {{ route('pages.contact') }}" class="text-uppercase c-white">Contacto</a></li>
					</ul>
				</nav>
				{{-- <div class="divider-2"></div> --}}
				{{-- <p>Nunc placerat dolor at lectus hendrerit dignissim. Ut tortor sem, consectetur nec hendrerit ut, ullamcorper ac odio. Donec viverra ligula at quam tincidunt imperdiet. Nulla mattis tincidunt auctor.</p> --}}
				<div class="divider-2" style="width: 80%;"></div>
				<p>© 2019 - Derechos reservados. Diseñado y desarrollado por <span class="c-white">Edwin Tello</span></p>
				{{-- <ul class="social-media-footer list-unstyled">
					<li><a href="#" class="fb"></a></li>
					<li><a href="#" class="tw"></a></li>
					<li><a href="#" class="in"></a></li>
					<li><a href="#" class="pn"></a></li>
				</ul> --}}
			</div>
		</footer>
	</section>
</body>
<script src="{{asset("/adminlte/bower_components/moment/min/moment.min.js")}}"></script>
<script src="{{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}"></script>
<script>
	$('#reservation').daterangepicker({
	  maxDate: new Date(),
	  locale: {
	format: 'D/M/YYYY'
  }
  });
</script>
<script src="{{ mix('js/app.js') }}"></script>
</html>