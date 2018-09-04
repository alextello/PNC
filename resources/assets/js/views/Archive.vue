<template>
<div>
    <section class="posts container">
    
        <!-- @if(isset($title)) -->
            <!-- <h2>{{ $title}}</h2> -->
        <!-- @endif -->
            <!-- @foreach($posts as $post) -->
            <article class="post">
        
                <div class="content-post">
                Archive
                    <!-- @include('posts.header') -->
                    <!-- <h1>{{$post->title}}</h1> -->
                    <div class="divider"></div>
                    <!-- @if($post->photos->count()===1)	 -->
                        <!-- <figure><img src="/storage/{{ $post->photos->first()->url }}" alt="" class="img-responsive"></figure> -->
                        <!-- @elseif($post->photos->count()>1) -->
                        <!-- @include('posts.carousel') -->
                        <!-- @endif -->
                        <div class="divider"></div>
                        <!-- <div style="overflow: hidden; white-space: nowrap;"><p><i class="fa fa-fw fa-map-marker">{{ $post->address->name. ' '. $post->address->aldea->name }}</i></p></div> -->
                        <!-- <p><i class="fa fa-fw fa-calendar-minus-o"></i>{{' '.$post->published_at->format('d M Y') }}</p> -->
                        <!-- <p><i class="fa fa-fw fa-clock-o">{{ date("H:i", strtotime($post->time)) }}</i></p> -->
                    <footer class="container-flex space-between">
                        <div class="read-more">
                        <!-- <a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer más</a> -->
                        </div>
                        <!-- @include('posts/tags') -->
                    </footer>
                </div>
            </article>
            <!-- @endforeach -->
    
        </section>
</div>
</template>