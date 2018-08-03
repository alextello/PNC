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
    $post = App\Post::find(1);
    return view('posts.pdf', ['post' => $post]);
});

Route::get('/', 'PagesController@home')->name('pages.home');
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
        Route::resource('roles', 'RolesController', ['except' => 'show', 'as' => 'admin']);
        Route::resource('permissions', 'PermissionsController', ['only' => ['index', 'edit', 'update'], 'as' => 'admin']);
        Route::middleware('role:Administrador')->put('users/{user}/roles', 'UsersRolesController@update')->name('admin.users.roles.update');
        Route::middleware('role:Administrador')->put('users/{user}/permissions', 'UsersPermissionsController@update')->name('admin.users.permissions.update');
        Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
        Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
        Route::resource('plantillas', 'PlantillasController', ['as' => 'admin']);
        Route::post('/plantilla', 'PlantillaSelectController@index');

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
        Route::get('/vehiculo/edit/{id}', 'VehiculoController@edit')->name('admin.vehiculo.edit');
        Route::post('/vehiculo/delete/{id}', 'VehiculoController@delete')->name('admin.vehiculo.delete');
        Route::post('/vehiculo/update/{id}', 'VehiculoController@update')->name('admin.vehiculo.update');
        Route::post('/vehiculo/store', 'VehiculoController@store')->name('admin.vehiculo.store');

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