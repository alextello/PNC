@extends('layout')

@section('title', $post->title)
@section('meta-content', $post->excerpt )

@section('content')

<article class="post container">
  
    <div class="content-post">
      @include('posts.header')
    <h1>{{ $post->title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text">
          {!! $post->body !!}
        </div>
        @if($post->photos->count()===1)
        <figure><img src="/storage/{{ $post->photos->first()->url }}" alt="" class="img-responsive"></figure>
        @elseif($post->photos->count()>1)
        @include('posts.carousel')
        @endif
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
  <link rel="stylesheet" type="text/css" href="/css/twitter-bootstrap.css">
@endpush
@push('scripts')
<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
<script src="/js/twitter-bootstrap.js"></script>
<script id="dsq-count-scr" src="//zendero.disqus.com/count.js" async></script>
@endpush