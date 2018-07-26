<?php

use App\Tag;
use App\Post;
use App\User;
use App\Address;
use App\Category;
use App\Aldea;
use Carbon\Carbon;
use App\Subcategory;
use App\Municipio;
use App\Involucrado;
use App\Gang;
use App\Delito;
use App\Marca;
use App\Movil;
use App\Vehiculo;
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
        Aldea::truncate();
        Delito::truncate();
        Municipio::truncate();
        Marca::truncate();
        Movil::truncate();
        Vehiculo::truncate();
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

        $dep = Municipio::create(['name' => 'San Juan Ostuncalco']);
        $mun = Aldea::create(['name' => 'Agua Blanca', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Agua Tibia', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Buena Vista', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'El Tizate', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Espumpuja', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'La Esperanza', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'La Granadilla', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'La Nueva Concepción', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'La Reforma', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'La Unión los Mendoza', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'La Victoria', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Las Barrancas', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Las Lagunas Cuaches', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Los Alonzo', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Monrovia', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Pueblo Nuevo', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Roble Grande', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Sigüila', 'municipio_id' => '1']);
        $mun = Aldea::create(['name' => 'Varsovia', 'municipio_id' => '1']);
        
        

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

        $delito = Delito::create(['name' => 'escandalo publico']);

        $post = new Post();
        $post->title = 'Primer post';
        $post->url = str_slug('Primer post');
        $post->delito_id = 1;
        $post->body = '<p>Contenido primer post</p>';
        $post->published_at = Carbon::now();
        $post->user_id =  1;
        $post->tag_id = 1;
        $post->oficio = 1;
        $post->address_id = Address::create(['name' => '1ra. Calle 5-22 zona 3', 'aldea_id' => '1'])->id;
        $post->save();



        $post = new Post();
        $post->title = 'segundo post';
        $post->url = str_slug('segundo post');
        $post->delito_id = 1;
        $post->body = '<p>Contenido segundo post</p>';
        $post->published_at = Carbon::now()->subDays(1);
        $post->user_id =  2;
        $post->tag_id = 1;
        $post->oficio = 11;
        $post->address_id = Address::create(['name' => '11av. 8-20 zona 1', 'aldea_id' => '2'])->id;
        $post->save();

        $post = new Post();
        $post->title = 'tercer post';
        $post->url = str_slug('tercer post');
        $post->delito_id = 1;
        $post->body = '<p>Contenido tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->user_id =  2;
        $post->tag_id = 2;
        $post->oficio = 1111;
        $post->address_id = Address::create(['name' => '4ta. calle 6-32 zona 2', 'aldea_id' => '3'])->id;
        $post->save();

        Movil::create(['tipo' => 'Vehiculo']);
        Movil::create(['tipo' => 'Moto']);
        Movil::create(['tipo' => 'A pie']);

        Marca::create(['name' => 'Toyota']);
        Marca::create(['name' => 'Nissan']);
        Marca::create(['name' => 'Honda']);

       
    }
}
