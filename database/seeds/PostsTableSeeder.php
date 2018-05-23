<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Carbon\Carbon;
use App\Category;
use App\User;
use App\Tag;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        Role::truncate();
        Post::truncate();
        Category::truncate();
        Tag::truncate();
        Storage::disk('public')->deleteDirectory('posts');

        $adminRole = Role::create(['name' => 'Administrador']);
        $escritorRole = Role::create(['name' => 'Escritor']);

        $p = Permission::create(['name' => 'Ver Usuario']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar Usuario']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Crear Usuario']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Eliminar Usuario']);
        $adminRole->givePermissionTo($p);
        /////////////

        $p = Permission::create(['name' => 'Ver reportes']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar reportes']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Crear reportes']);
        $adminRole->givePermissionTo($p);
        $escritorRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Eliminar reportes']);
        $adminRole->givePermissionTo($p);
        
        

        $user = new User();
        $user->name = 'Edwin Tello';
        $user->email = 'alex@hotmail.com';
        $user->codigo = 'AF200E';
        $user->telefono = '35202684';
        $user->password = 'admin';
        $user->save();
        $user->assignRole($adminRole);

        $user = new User();
        $user->name = 'Samuel Rabanales';
        $user->email = 'samuel@hotmail.com';
        $user->codigo = 'AD0049';
        $user->telefono = '7778888';
        $user->password = 'admin';
        $user->save();
        $user->assignRole($escritorRole);

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
        $post->user_id =  1;
        $post->save();
        $post->tags()->attach(Tag::create(['name' => 'etiqueta 1']));

        $post = new Post();
        $post->title = 'segundo post';
        $post->url = str_slug('segundo post');
        $post->excerpt = 'Extracto segundo post';
        $post->body = '<p>Contenido segundo post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->category_id =  2;
        $post->user_id =  2;
        $post->save();
        $post->tags()->attach(Tag::create(['name' => 'etiqueta 2']));

        $post = new Post();
        $post->title = 'tercer post';
        $post->url = str_slug('tercer post');
        $post->excerpt = 'Extracto tercer post';
        $post->body = '<p>Contenido tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->category_id =  3;
        $post->user_id =  2;
        $post->save();
        $post->tags()->attach(Tag::create(['name' => 'etiqueta 3']));

       
    }
}
