@extends('layout')

@section('title', $post->title)

@section('content')

<article class="post container">
  
    <div class="content-post">
      @include('posts.header')
    <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text" style="text-align: justify;">
          {!! Purify::clean($post->body) !!}
        </div>
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
        @include('partials.social-links', ['description' => $post->title])
          
         @include('posts.tags')
      </footer>
      <div class="comments">
      <div class="divider"></div>
        <div id="disqus_thread"></div>
        {{-- @include('partials.disqus-script')                         --}}
      </div><!-- .comments -->
    </div>
  </article>

@endsection

@push('styles')
  <link rel="stylesheet" type="text/css" href="{{asset('/css/twitter-bootstrap.css')}}">
  {{-- <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css"> --}}
  <link rel="stylesheet" href="{{asset("/adminlte/bower_components/font-awesome/css/font-awesome.min.css")}}">
@endpush
@push('scripts')
<script src="{{asset("/adminlte/bower_components/jquery/dist/jquery.min.js")}}"></script>
<script src="{{asset("/js/twitter-bootstrap.js")}}"></script>
{{-- <script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script> --}}
@endpush