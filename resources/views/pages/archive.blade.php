@extends('layout')
@section('content')
<router-view></router-view>
<section class="pages container">
		{{-- <div class="page page-archive"> --}}
<div class="box box-widget widget-user-2">
    <!-- Add the bg color to the header using any of the bg-* classes -->
    <div class="widget-user-header bg-aqua-active">
      <div class="widget-user-image">
        <img class="img-circle" src="{{asset('/adminlte/img/pnc.jpg')}}" alt="User Avatar">
      </div>
      <!-- /.widget-user-image -->
      <h3 class="widget-user-username">Policia Nacional Civil</h3>
      <h5 class="widget-user-desc">Seleccione un filtro para las novedades</h5>
    </div>
    <div class="box-footer no-padding">
      <ul class="nav nav-stacked">
          <div class="box box-default collapsed-box">
              <div class="box-header with-border">
                <h3 class="box-title">Categorias</h3>
  
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                  </button>
                </div>
                <!-- /.box-tools -->
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                @foreach ($categories as $cat)
                <p class="btn btn-block btn-default"><a target='_blank' href="{{ route('categories.show', $cat ) }}">{{ $cat->name }}</a></p>
                @endforeach
              </div>
              <!-- /.box-body -->
            </div>
            <div class="box box-warning collapsed-box">
                <div class="box-header with-border">
                  <h3 class="box-title">Subcateogrias</h3>
    
                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                    </button>
                  </div>
                  <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  @foreach ($subcategories as $sub)
                  <p class="btn btn-block btn-warning"><a class="botones" target="_blank" href="{{ route('subcategories.show', $sub ) }}">{{ $sub->name  }}</a></p>
                  @endforeach
                </div>
                <!-- /.box-body -->
              </div>
              <div class="box box-success collapsed-box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Etiquetas positivas</h3>
      
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.box-tools -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    @foreach ($ptags as $p)
                    <p class="btn btn-block btn-success"><a class="botones" target="_blank" href="{{ route('tags.show', $p ) }}">{{ $p->name  }}</a></p>
                    @endforeach
                  </div>
                  <!-- /.box-body -->
                </div>
                <div class="box box-danger collapsed-box">
                    <div class="box-header with-border">
                      <h3 class="box-title">Etiquetas negativas</h3>
        
                      <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                      </div>
                      <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      @foreach ($ntags as $n)
                      <p class="btn btn-block btn-danger"><a class="botones" target="_blank" href="{{ route('tags.show', $n ) }}">{{ $n->name  }}</a></p>
                      @endforeach
                    </div>
                    <!-- /.box-body -->
                  </div>
        {{-- <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
        <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li> --}}
      </ul>
    </div>
  </div>
{{-- </div> --}}
</section>
{{-- <section class="pages container">
		<div class="page page-archive">
			<h1 class="text-capitalize">archive</h1>
			<p>Nam efficitur, massa quis fringilla volutpat, ipsum massa consequat nisi, sed eleifend orci sem sodales lorem. Curabitur molestie eros urna, eleifend molestie risus placerat sed.</p>
			<div class="divider-2" style="margin: 35px 0;"></div>
			<div class="container-flex space-between">
				<div class="authors-categories">
					<h3 class="text-capitalize">Categorias</h3>
					<ul class="list-unstyled">
                        @foreach ($categories as $cat)
                        <li><a href="">{{ $cat->name }}</a></li>
                        @endforeach
					</ul>
					<h3 class="text-capitalize">Subategorias</h3>
					<ul class="list-unstyled">
                        @foreach ($subcategories as $sub)
                        <li class="text-capitalize"><a href="">{{ $sub->name }}</a></li>
                        @endforeach
					</ul>
				</div>
				<div class="latest-posts">
					<h3 class="text-capitalize">últimas novedades</h3>
                    @foreach ($posts as $post)
                    <a href=""><p>{{ $post->excerpt }}</p></a>
                    @endforeach
					<h3 class="text-capitalize">ultimos meses</h3>
					<ul class="list-unstyled">
						<li>August 2015</li>
						<li>September 2015</li>
						<li>October 2015</li>
					</ul>
                </div>
			</div>
        </div>
       
	</section> --}}
@endsection

@push('styles')
<style>
  .botones{
   color: #ffff !important;
  }
</style>
<link rel="stylesheet" href="{{asset("/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css")}}">
<!-- Font Awesome -->
<link rel="stylesheet" href="{{asset("/adminlte/bower_components/font-awesome/css/font-awesome.min.css")}}">
<!-- Ionicons -->
<link rel="stylesheet" href="{{asset("/adminlte/bower_components/Ionicons/css/ionicons.min.css")}}">
<!-- Theme style -->
<link rel="stylesheet" href="{{asset("/adminlte/dist/css/adminlte.min.css")}}">
<!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="{{asset("/adminlte/dist/css/skins/_all-skins.min.css")}}">
@endpush

@push('scripts')
<!-- jQuery 3 -->
<script src="{{asset("/adminlte/bower_components/jquery/dist/jquery.min.js")}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset("/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js")}}"></script>
<!-- Slimscroll -->
<script src="{{asset("/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js")}}"></script>
<!-- FastClick -->
<script src="{{asset("/adminlte/bower_components/fastclick/lib/fastclick.js")}}"></script>
<!-- AdminLTE App -->
<script src="{{asset("/adminlte/dist/js/adminlte.min.js")}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset("/adminlte/dist/js/demo.js")}}"></script>
@endpush