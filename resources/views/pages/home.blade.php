@extends('layout')

@section('content')

<section class="posts container">
		<router-view></router-view>
	@if(isset($title))
		<h2>{{ $title}}</h2>
	@endif
		@foreach($posts as $post)
		<article class="post" style="width: 100%">
			<div class="content-post">
				@include('posts.header')
				<h1>{{$post->title}}</h1>
				<div class="divider"></div>
				@if($post->photos->count()===1)	
					<figure><img src="/storage/{{ $post->photos->first()->url }}" alt="" class="img-responsive"></figure>
					@elseif($post->photos->count()>1)
					@include('posts.carousel')
					@endif
					<div class="divider"></div>
					<div style="overflow: hidden; white-space: nowrap;"><p><i class="fa fa-fw fa-map-marker">{{ $post->address->name. ' '. $post->address->aldea->name }}</i></p></div>
					<p><i class="fa fa-fw fa-calendar-minus-o"></i>{{' '.$post->published_at->format('d M Y') }}</p>
					<p><i class="fa fa-fw fa-clock-o">{{ date("H:i", strtotime($post->time)) }}</i></p>
				<footer class="container-flex space-between">
					<div class="read-more">
					<a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer más</a>
					</div>
					@include('posts/tags')
				</footer>
			</div>
		</article>
		@endforeach

	</section>
	<!-- fin del div.posts.container -->
	{{$posts->links()}}

@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href={{asset("/css/twitter-bootstrap.css")}}>
  <link rel="stylesheet" href={{asset("/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css")}}>
  <link rel="stylesheet" href={{asset("/css/style.css")}}>
  <link rel="stylesheet" href={{asset("/adminlte/bower_components/font-awesome/css/font-awesome.min.css")}}>
  <link rel="stylesheet" href={{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.css")}}>
@endpush

@push('scripts')
<script src={{asset("/adminlte/bower_components/jquery/dist/jquery.min.js")}}></script>
<script src={{asset("/js/twitter-bootstrap.js")}}></script>
<script src={{asset("/adminlte/bower_components/moment/min/moment.min.js")}}></script>
<script src={{asset("/adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js")}}></script>
<script>
    $('#reservation').daterangepicker({
        'startDate': '01/01/2019',
        'endDate': '02/01/2019',
        locale: {
      format: 'D/M/YYYY'
    }
    });
</script>
@endpush
	