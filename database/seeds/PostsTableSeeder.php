<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Post;
use Carbon\Carbon;
use App\Category;
use App\User;
use App\Tag;
use App\Subcategory;
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
        Subcategory::truncate();
        Tag::truncate();
        Storage::disk('public')->deleteDirectory('posts');

        $adminRole = Role::create(['name' => 'Administrador', 'display_name' => 'Admin']);
        $escritorRole = Role::create(['name' => 'Escritor', 'display_name' => 'Escritor']);

        ////permisos de usuarios
        $p = Permission::create(['name' => 'Ver Usuario']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar Usuario']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Crear Usuario']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Eliminar Usuario']);
        $adminRole->givePermissionTo($p);

        /////////////permisos de eventos
        $p = Permission::create(['name' => 'Ver reportes']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar reportes']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Crear reportes']);
        $adminRole->givePermissionTo($p);
        $escritorRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Eliminar reportes']);
        $adminRole->givePermissionTo($p);
        

        /////permisos de plantillas
        $p = Permission::create(['name' => 'Ver plantilla']);
        $adminRole->givePermissionTo($p);
        $escritorRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar plantilla']);
        $adminRole->givePermissionTo($p);
        $escritorRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Crear plantilla']);
        $adminRole->givePermissionTo($p);
        $escritorRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Eliminar plantilla']);
        $adminRole->givePermissionTo($p);
        $escritorRole->givePermissionTo($p);

        //permisos para roles
        $p = Permission::create(['name' => 'Ver role']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar role']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Crear role']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Eliminar role']);
        $adminRole->givePermissionTo($p);

        //permiso para permisos
        $p = Permission::create(['name' => 'Ver permisos']);
        $adminRole->givePermissionTo($p);
        $p = Permission::create(['name' => 'Editar permisos']);
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


        $subcategory = new Subcategory();
        $subcategory->name = 'Hechos contra la propiedad';
        $subcategory->category_id = '1';
        $subcategory->save();


        $subcategory = new Subcategory();
        $subcategory->name = 'Hechos contra la propiedad';
        $subcategory->category_id = '2';
        $subcategory->save();

        $tag = new Tag();
        $tag->name = 'Etiqueta 1';
        $tag->subcategory_id = 1;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Etiqueta 2';
        $tag->subcategory_id = 2;
        $tag->save();

        $post = new Post();
        $post->title = 'Primer post';
        $post->url = str_slug('Primer post');
        $post->excerpt = 'Extracto primer post';
        $post->body = '<p>Contenido primer post</p>';
        $post->published_at = Carbon::now();
        $post->user_id =  1;
        $post->tag_id = 1;
        $post->save();

        $post = new Post();
        $post->title = 'segundo post';
        $post->url = str_slug('segundo post');
        $post->excerpt = 'Extracto segundo post';
        $post->body = '<p>Contenido segundo post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->user_id =  2;
        $post->tag_id = 1;
        $post->save();

        $post = new Post();
        $post->title = 'tercer post';
        $post->url = str_slug('tercer post');
        $post->excerpt = 'Extracto tercer post';
        $post->body = '<p>Contenido tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->user_id =  2;
        $post->tag_id = 2;
        $post->save();
       
    }
}
