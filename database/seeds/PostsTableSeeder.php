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
        $mun = Aldea::create(['name' => 'San Juan Ostuncalco', 'municipio_id' => '1']);
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

        $user = new User();
        $user->name = 'Wilkier Menchu';
        $user->email = 'wilkier@hotmail.com';
        $user->codigo = 'ADDDD';
        $user->telefono = '11111';
        $user->password = 'admin';
        $user->save();
        $user->assignRole($escritorRole);

        $category = new Category();
        $category->name = 'Hechos positivos';
        $category->save();

        $category = new Category();
        $category->name = 'Hechos negativos';
        $category->save();


        $subcategory = new Subcategory();
        $subcategory->name = 'Contra la vida';
        $subcategory->category_id = '1';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Contra la vida';
        $subcategory->category_id = '2';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Contra el patrimonio';
        $subcategory->category_id = '1';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Contra el patrimonio';
        $subcategory->category_id = '2';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Robo de vehiculos';
        $subcategory->category_id = '1';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Robo de vehiculos';
        $subcategory->category_id = '2';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Armas de fuego';
        $subcategory->category_id = '1';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Delitos contra la libertad, seguridad y sexuales a la persona';
        $subcategory->category_id = '1';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Delitos contra la libertad, seguridad y sexuales a la persona';
        $subcategory->category_id = '2';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Fallecidos';
        $subcategory->category_id = '2';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Heridos';
        $subcategory->category_id = '2';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Otros';
        $subcategory->category_id = '1';
        $subcategory->save();

        $subcategory = new Subcategory();
        $subcategory->name = 'Otros';
        $subcategory->category_id = '2';
        $subcategory->save();

    
        $tag = new Tag();
        $tag->name = 'Portacion ilegal de arma de fuego';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Portacion de arma de fuego (Ostentosa)';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Portacion de arma de fuego hechiza';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Portacion de arma de fuego bajo efectos de licor';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Portacion de arma blanca';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Portacion de artefacto explosivo';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Portacion de agresion';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Accidente de transito';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Responsabilidad conductores';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Violencia intrafamiliar';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Violencia contra la mujer';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Ebriedad y escandalo';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Distribucion de droga';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Tenencia de droga';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Posesion de droga para el consumo';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Escandalo bajo efectos de licor';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Escandalo bajo efectos de droga';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Contrabando de mercaderia';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo de vehiculos';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo de motocicleta';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Robo a comercio';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Robo a residencia';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Robo de peaton';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Robo de centro educativo';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Robo de celulares';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo en iglesia';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo bus urbano';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo bus extraurbano';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Otros robos';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Allanamiento judicial';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Allanamiento de morada';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Riña';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Lesiones arma de fuego';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'lesiones arma blanca';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Lesiones arma contundente';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Lesiones en accidente de transito';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Lesiones culposas';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Daños';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Orden de captura';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Cohecho';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Estafa';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Hurto';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Violencia sexal';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Intento de violacion';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Intento de suicidio';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Alterar el orden publico';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Falsedad de documentos';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Ilegales remitidos';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Plagio';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Secuestro';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Extorsion';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Rapto de menores';
        $tag->subcategory_id = 9;
        $tag->save();
        
        $tag = new Tag();
        $tag->name = 'Delitos forestales';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Omiso medida de seguridad';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Mareros detenidos';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Trata de personas';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Menores remitidos';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Infringir ley electoral';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Infringir ley seca';
        $tag->subcategory_id = 9;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Otras causas';
        $tag->subcategory_id = 9;
        $tag->save();
        

        //EMPIEZAN LOS NEGATIVOS

        $tag = new Tag();
        $tag->name = 'Arma de fuego (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Arma blanca (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Arma contundente (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Estrangulados (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Linchados (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Asfixia por suspencion (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Asfixia por sumersion (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Atropellado (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Accidente de transito (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Intoxicacion alcoholica (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Suicidio (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Osamenta humana (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Otras causas (fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Arma de fuego (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Arma de fuego (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Arma blanca (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Arma contundente (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Artefacto explosivo (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Linchado (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Atropellado (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Accidente de transito (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Intento de intoxicacion (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Otras causas (heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        //CONTRA LA LIBERTAD, SEGURIDAD, SEXUALES

        $tag = new Tag();
        $tag->name = 'Violencia sexual';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Personas secuestradas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Personas desaparecidas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Personas raptadas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a mercaderia';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Accidente de transito (cuando hay heridos o fallecidos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Accidente acuatico y aereo';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Accidente de transito (cuando no hay heridos)';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Ataque o atentado a vehiculo y edificios por A/F';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Ataque a agentes y unidad policial';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Explosion de artefactos';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Denuncia de extorsion';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Violencia contra la mujer';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Violencia intrafamiliar';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Extravio arma de fuego';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Disturbios registrados';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Incendios';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Caminatas realizadas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Manifestaciones';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Conflictividad electoral';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Conflictividad social';
        $tag->subcategory_id = 10;
        $tag->save();

        //HECHOS CONTRA LA PROPIEDAD


        $tag = new Tag();
        $tag->name = 'Robo/hurto a residencia';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a comercio';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a iglesia';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo en centro educativo';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Asalto, robo y hurto a transeuntes';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a bufete juridico';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a banco/caja rural';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo en buses urbanos';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo en buses extraurbanos';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a turista';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Robo a bus de turista';
        $tag->subcategory_id = 10;
        $tag->save();

        //ROBO DE VEHICULOS
        $tag = new Tag();
        $tag->name = 'Vehiculos robados';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Vehiculos hurtados';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Motos robadas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Motos hurtadas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Camion con mercaderia';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Armas de fuego robadas';
        $tag->subcategory_id = 10;
        $tag->save();

        $tag = new Tag();
        $tag->name = 'Armas de fuego hurtadas';
        $tag->subcategory_id = 10;
        $tag->save();

        $post = new Post();
        $post->title = 'Primer post';
        $post->url = str_slug('Primer post');
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
        $post->body = '<p>Contenido tercer post</p>';
        $post->published_at = Carbon::now()->subDays(2);
        $post->user_id =  2;
        $post->tag_id = 2;
        $post->oficio = 1111;
        $post->address_id = Address::create(['name' => '4ta. calle 6-32 zona 2', 'aldea_id' => '3'])->id;
        $post->save();

        Movil::create(['tipo' => 'Patrulla']);
        Movil::create(['tipo' => 'Vehiculo']);
        Movil::create(['tipo' => 'Moto']);
        Movil::create(['tipo' => 'A pie']);

        Marca::create(['name' => 'Toyota']);
        Marca::create(['name' => 'Nissan']);
        Marca::create(['name' => 'Honda']);

       
    }
}
