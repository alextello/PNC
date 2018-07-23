<?php

use App\Tag;
use App\Post;
use App\User;
use App\Address;
use App\Category;
use App\Municipio;
use Carbon\Carbon;
use App\Subcategory;
use App\Departamento;
use App\Involucrado;
use App\Gang;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
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
        Address::truncate();
        Municipio::truncate();
        Departamento::truncate();
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

        //Departamento

        $dep = Departamento::create(['name' => 'Sololá']);
        $mun = Municipio::create(['name' => 'Santiago Atitlán', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San José Chacayá', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Concepción', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Santa Catarina Ixtahuacán', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San Juan La Laguna', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San Pablo La Laguna', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San Pedro La Laguna', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Santa Clara La Laguna', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Santa Cruz La Laguna', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Nahualá', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San Antonio Polopó', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Santa Catarina Pololpó', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Panajachel', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San Andrés Semetabaj', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Sololá', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'San Lucas Tolimán', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Santa Lucía Utatlán', 'departamento_id' => '1']);
        $mun = Municipio::create(['name' => 'Santa María Visitación', 'departamento_id' => '1']);
        
        

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
        $post->oficio = 1;
        $post->address_id = Address::create(['name' => '1ra. Calle 5-22 zona 3', 'municipio_id' => '1'])->id;
        $post->save();



        $post = new Post();
        $post->title = 'segundo post';
        $post->url = str_slug('segundo post');
        $post->excerpt = 'Extracto segundo post';
        $post->body = '<p>Contenido segundo post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->user_id =  2;
        $post->tag_id = 1;
        $post->oficio = 11;
        $post->address_id = Address::create(['name' => '11av. 8-20 zona 1', 'municipio_id' => '2'])->id;
        $post->save();

        $post = new Post();
        $post->title = 'tercer post';
        $post->url = str_slug('tercer post');
        $post->excerpt = 'Extracto tercer post';
        $post->body = '<p>Contenido tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->user_id =  2;
        $post->tag_id = 2;
        $post->oficio = 1111;
        $post->address_id = Address::create(['name' => '4ta. calle 6-32 zona 2', 'municipio_id' => '3'])->id;
        $post->save();
       
    }
}
