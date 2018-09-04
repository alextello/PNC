<template>
<div>
    <section class="posts container">
    
        <!-- @if(isset($title)) -->
            <!-- <h2>{{ $title}}</h2> -->
        <!-- @endif -->
            <!-- @foreach($posts as $post) -->
            <article v-for="post in posts" :key="post.id" class="post">
        
                <div class="content-post">
                    <header class="container-flex space-between">
                    <div class="date">
                    <span class="c-gris" v-text="post.owner.name+' / '+post.published_date"></span>
                    <hr>
                    <span class="c-gris" v-text="'Oficio ' +post.oficio"></span>
                    <hr>
                    <span class="label label-warning">
                        <!-- <a href="{{ route('subcategories.show', $post->tags->subcategory ) }}">{{ $post->tags->subcategory->name }}</a> -->
                    </span>
                    </div>
                    <div class="post-category">
                    <span class="category">
                        <!-- <a href="{{ route('categories.show', $post->tags->subcategory->category )}}">{{ $post->tags->subcategory->category->name }}</a> -->
                        <router-link :to="{name : 'categorias_show', params : {category :post.tags.subcategory.category.url} }">{{post.tags.subcategory.category.name}}</router-link>
                    </span>
                    </div>
                </header>
                    <!-- <h1>{{$post->title}}</h1> -->
                    <h1 v-text="post.title"></h1>
                    <div class="divider"></div>
                    
                    <!-- @if($post->photos->count()===1)	 -->
                        <!-- <figure><img src="/storage/{{ $post->photos->first()->url }}" alt="" class="img-responsive"></figure> -->
                        <!-- @elseif($post->photos->count()>1) -->
                        <!-- @include('posts.carousel') -->
                        <!-- @endif -->
                        <div class="divider"></div>
                        <!-- <div style="overflow: hidden; white-space: nowrap;"><p><i class="fa fa-fw fa-map-marker">{{ $post->address->name. ' '. $post->address->aldea->name }}</i></p></div> -->
                        <div style="overflow: hidden; white-space: nowrap;"><p><i class="fa fa-fw fa-map-marker" v-text="post.address.name + ' '+ post.address.aldea.name"></i></p></div>
                        <!-- <p><i class="fa fa-fw fa-calendar-minus-o"></i>{{' '.$post->published_at->format('d M Y') }}</p> -->
                        <!-- <p><i class="fa fa-fw fa-clock-o">{{ date("H:i", strtotime($post->time)) }}</i></p> -->
                    <footer class="container-flex space-between">
                        <div class="read-more">
                        <!-- <a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer más</a> -->
                        <router-link class="text-uppercase c-green" 
                        :to="{name: 'post_show', params: {url : post.url} }">Leer más</router-link>
                        </div>
                       <div class="tags container-flex">
                        <span class="tag c-gris">
                            <router-link :to="{name : 'tags_show', params : {tag :post.tags.url} }">#{{post.tags.name}}</router-link>
                            <!-- <a href="{{ route('tags.show', $post->tags) }}">#{{$post->tags->name}}</a> -->
                            </span>
                        </div>
                    </footer>
                </div>
            </article>
            <!-- @endforeach -->
    
        </section>
</div>
</template>
<script>
export default {
    data(){
        return{
            posts:[]
        }
    },
    mounted: function(){
        axios.get('/api/posts')
        .then(response => {
            this.posts = response.data.data;
        })
        .catch(error => {

        })
    }
}
</script>
