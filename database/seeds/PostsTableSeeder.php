<?php

use Illuminate\Database\Seeder;
use App\Post;
use Carbon\Carbon;
use App\Category;
use App\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        Category::truncate();

        $category = new Category();
        $category->name = 'Categoria 1';
        $category->save();

        $category = new Category();
        $category->name = 'Categoria 2';
        $category->save();

        $category = new Category();
        $category->name = 'Categoria 3';
        $category->save();

        $post = new Post();
        $post->title = 'Primer post';
        $post->url = str_slug('Primer post');
        $post->excerpt = 'Extracto primer post';
        $post->body = '<p>Contenido primer post</p>';
        $post->published_at = Carbon::now();
        $post->category_id =  1;
        $post->save();

        $post = new Post();
        $post->title = 'segundo post';
        $post->url = str_slug('segundo post');
        $post->excerpt = 'Extracto segundo post';
        $post->body = '<p>Contenido segundo post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id =  2;
        $post->save();

        $post = new Post();
        $post->title = 'segundo post';
        $post->url = str_slug('segundo post');
        $post->excerpt = 'Extracto segundo post';
        $post->body = '<p>Contenido segundo post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id =  3;
        $post->save();

        $user = new User();
        $user->name = 'Edwin Tello';
        $user->email = 'alex@hotmail.com';
        $user->password = bcrypt('admin');
        $user->save();
    }
}
