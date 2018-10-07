<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// use App\Involucrado;
// $a = collect(['name' => 'algo', 'dpi' => '1', 'gender' => 'M']);
// $s = Involucrado::find($a);
// dd($s);
Route::get('prueba', function(){
    $post = App\Post::where('url', 'ebriedad-zona-1-san-juan')->first();
    return view('posts.pdf', ['post' => $post]);
});

Route::get('/', 'PagesController@home')->name('pages.home');
// Route::get('/spa', 'PagesController@spa')->name('pages.spa');
Route::get('nosotros', 'PagesController@about')->name('pages.about');
Route::get('archivo', 'PagesController@archive')->name('pages.archive');
Route::get('contacto', 'PagesController@contact')->name('pages.contact');

Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');
Route::get('subcategorias/{subcategory}', 'SubcategoriesController@show')->name('subcategories.show');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');

Route::group([
    'prefix' => 'admin', 
    'namespace' => 'Admin', 
    'middleware' => 'auth'], 
    function () {
        
        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::resource('posts', 'PostsController', ['except' => 'show', 'as' => 'admin']);
        Route::resource('users', 'UsersController', ['as' => 'admin']);
        Route::post('users/restore', 'UsersController@restore')->name('admin.users.restore');
        Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
        Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);
        Route::middleware('role:Administrador')->put('users/{user}/roles', 'UsersRolesController@update')->name('admin.users.roles.update');
        Route::middleware('role:Administrador')->put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');
        Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
        Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
        Route::resource('plantillas', 'PlantillasController', ['as' => 'admin']);
        Route::post('/plantilla', 'PlantillaSelectController@index');
        Route::get('/subcategoria/{id}', 'SubcategoryController@subDinamicos')->name('subcategorias.dinamicas');

        Route::get('/estadisticas/tag', 'EstadisticasController@tag')->name('admin.estadisticas.tag');
        Route::get('/estadisticas/total', 'EstadisticasController@total')->name('admin.estadisticas.total');
        Route::post('/estadisticas/tag', 'EstadisticasController@fecha')->name('admin.estadisticas.fecha');

        Route::get('/estadisticas/categoria', 'EstadisticasController@cat')->name('admin.estadisticas.categoria');
        Route::get('/estadisticas/totalcat', 'EstadisticasController@totalcat')->name('admin.estadisticas.totalcat');
        Route::post('/estadisticas/categoria', 'EstadisticasController@fechacat')->name('admin.estadisticas.fechacat');

        Route::get('/estadisticas/personas', 'EstadisticasController@personas')->name('admin.estadisticas.personas');
        Route::get('/estadisticas/totalpersonas', 'EstadisticasController@totalpersonas')->name('admin.estadisticas.totalpersonas');


        Route::get('/estadisticas/personas', 'EstadisticasController@personas')->name('admin.estadisticas.personas');
        Route::get('/estadisticas/tabla', 'EstadisticasController@tabla')->name('admin.estadisticas.tabla');
        Route::post('/estadisticas/fecha', 'EstadisticasController@fecha')->name('admin.estadisticas.fecha');
        Route::get('/Subcategory/{id}', 'SubcategoryController@subs')->name('admin.subcategorias.subs');
        Route::delete('/involucrado/{id}/{postid}', 'InvolucradoController@destroy')->name('admin.involucrados.destroy');
        Route::get('/antecedentes', 'AntecedentesController@index')->name('admin.antecedentes.index');
        Route::get('/antecedentes/posts/{post}', 'AntecedentesController@posts')->name('admin.antecedentes.posts');
        Route::get('/involucrado/{id}/{postid}', 'PostsController@involucrado')->name('involucrado.index');
        Route::post('/fallecidos', 'InvolucradoController@fallecidos')->name('admin.involucrados.fallecidos');
        Route::post('/involucrado/update/{id}/{postid}', 'PostsController@involucradoUpdate')->name('admin.involucrado.update');
        Route::get('/vehiculo/edit/{id}/{postid}', 'VehiculoController@edit')->name('admin.vehiculo.edit');
        Route::post('/vehiculo/delete/{id}', 'VehiculoController@delete')->name('admin.vehiculo.delete');
        Route::post('/vehiculo/update/{id}', 'VehiculoController@update')->name('admin.vehiculo.update');
        Route::post('/vehiculo/store', 'VehiculoController@store')->name('admin.vehiculo.store');

        Route::get('/arma/edit/{id}/{postid}', 'GunController@edit')->name('admin.arma.edit');
        Route::post('/arma/delete/{id}', 'GunController@delete')->name('admin.arma.delete');
        Route::post('/arma/update/{id}', 'GunController@update')->name('admin.arma.update');
        Route::post('/arma/store', 'GunController@store')->name('admin.arma.store');

        Route::get('/incautado/edit/{id}/{postid}', 'IncautacionController@edit')->name('admin.incautado.edit');
        Route::post('/incautado/delete/{id}', 'IncautacionController@delete')->name('admin.incautado.delete');
        Route::post('/incautado/update/{id}', 'IncautacionController@update')->name('admin.incautado.update');
        Route::post('/incautado/store', 'IncautacionController@store')->name('admin.incautado.store');
        
        Route::get('/robo/edit/{id}/{postid}', 'RoboController@edit')->name('admin.robo.edit');
        Route::post('/robo/delete/{id}', 'RoboController@delete')->name('admin.robo.delete');
        Route::post('/robo/update/{id}', 'RoboController@update')->name('admin.robo.update');
        Route::post('/robo/store', 'RoboController@store')->name('admin.robo.store');

        

        Route::get('/estadisticas/Hechos-negativos', 'TablasEstadisticasController@hechosNegativos')->name('hechosnegativos');
        Route::post('/estadisticas/Hechos-negativos', 'TablasEstadisticasController@hechosNegativos')->name('hechosnegativos.post');
        Route::get('/estadisticas/Hechos-positivos', 'TablasEstadisticasController@hechosPositivos')->name('hechospositivos');
        Route::post('/estadisticas/Hechos-positivos', 'TablasEstadisticasController@hechosPositivos')->name('hechospositivos.post');

        Route::get('/estadisticas/Hechos-negativos-mes', 'TablasEstadisticasController@hechosNegativosMes')->name('hechosnegativos.mes');
        Route::post('/estadisticas/Hechos-negativos-mes', 'TablasEstadisticasController@hechosNegativosMes')->name('hechosnegativos.mes.post');
        Route::get('/estadisticas/Hechos-positivos-mes', 'TablasEstadisticasController@hechosPositivosMes')->name('hechospositivos.mes');
        Route::post('/estadisticas/Hechos-positivos-mes', 'TablasEstadisticasController@hechosPositivosMes')->name('hechospositivos.mes.post');

        Route::get('/estadisticas/Hechos-negativos/tag', 'TablasEstadisticasController@negativosTag')->name('hechosnegativos.tag');
        Route::get('/estadisticas/Hechos-positivos/tag', 'TablasEstadisticasController@positivosTag')->name('hechospositivos.tag');

        Route::post('/estadisticas/Hechos', 'TablasEstadisticasController@buscarTag')->name('buscar.tag');

});

Route::get('reportes/{post}', 'PostsController@show')->name('posts.show');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/word/{id}', 'FileController@word')->name('file.word');
Route::get('/pfd/{id}', 'FileController@pdf')->name('file.pdf');
Route::get('/prueba/{id}', function(){

});

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');