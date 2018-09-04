<template>
<div>
<article class="post container">
  
    <div class="content-post">
       <header class="container-flex space-between">
            <div class="date">
            <span class="c-gris" v-text="post.owner.name+' / '+post.published_date"></span>
            <hr>
            <span class="c-gris" v-text="'Oficio ' +post.oficio"></span>
            <hr>
            <span class="label label-warning">
                <router-link :to="{name : 'subcategorias_show', params : {subcategory :post.tags.subcategory.url} }">{{post.tags.subcategory.name}}</router-link>
            </span>
            </div>
            <div class="post-category">
            <span class="category">
                <!-- <a href="{{ route('categories.show', $post->tags->subcategory->category )}}">{{ $post->tags->subcategory->category->name }}</a> -->
                <router-link :to="{name : 'categorias_show', params : {category :post.tags.subcategory.category.url} }">{{post.tags.subcategory.category.name}}</router-link>
            </span>
            </div>
        </header>
    <h1>{{ post.title }}</h1>
        <div class="divider"></div>
        <div class="image-w-text" style="text-align: justify;" v-html="post.body"> 
          <!-- {!! $post->body !!} -->
        </div>
        <!-- <figure><img src="/storage/{{ $post->photos->first()->url }}" alt="" class="img-responsive"></figure> -->
        <!-- @if($post->photos->count()===1) -->
        <!-- @elseif($post->photos->count()>1) -->
        <!-- @include('posts.carousel') -->
        <!-- @endif -->
        <div class="divider"></div>
        <div style="overflow: hidden; white-space: nowrap;">
           <div style="overflow: hidden; white-space: nowrap;"><p><i class="fa fa-fw fa-map-marker" v-text="post.address.name + ' '+ post.address.aldea.name"></i></p></div>
            </div>
					<!-- <p v-text="post.published_at"><i class="fa fa-fw fa-calendar-minus-o"></i></p> -->
					<!-- <p v-text="post.time"><i class="fa fa-fw fa-clock-o"></i></p> -->
					<!-- <p v-text="post.time"><i class="fa fa-fw fa-clock-o">{{ date("H:i", strtotime($post->time)) }}</i></p> -->
       <footer class="container-flex space-between">
            <div class="read-more">
            <!-- <a href="{{ route('posts.show', $post) }}" class="text-uppercase c-green">Leer más</a> -->
            <!-- <router-link class="text-uppercase c-green" :to="{name: 'post_show', params: {url : post.url} }">Leer más</router-link> -->
            </div>
           <div class="tags container-flex">
            <span class="tag c-gris">
                <router-link :to="{name : 'tags_show', params : {tag :post.tags.url} }">{{post.tags.name}}</router-link>
                <!-- <a href="{{ route('tags.show', $post->tags) }}">#{{$post->tags->name}}</a> -->
                </span>
            </div>
        </footer>
      <div class="comments">
      <div class="divider"></div>
        <div id="disqus_thread"></div>
        <!-- {{-- @include('partials.disqus-script')                         --}} -->
      </div><!-- .comments -->
    </div>
  </article>
</div>
</template>

<script>
export default {
    data(){
        return{
            post: {
                address :{
                    aldea :{}
                },
                tags: {
                    subcategory : {
                        category:{}
                    }
                }
            }
        }
    },
    mounted(){
        axios.get(`/api/reportes/${this.$route.params.url}`)
        .then(res => {
            this.post = res.data;
            console.log(res.data.address.aldea.name);
        })
        .catch(err => {
            console.log(err);
        })
    }
}
</script>
