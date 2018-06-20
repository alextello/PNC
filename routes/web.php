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
// use App\Post;

// Route::get('prueba', function(){
//    $tag = App\Tag::find(2);
//    return $tag->posts()
//                 ->where('category_id', 2)
//                 ->where('subcategory_id', 1)->get();
// });


Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('nosotros', 'PagesController@about')->name('pages.about');
Route::get('archivo', 'PagesController@archive')->name('pages.archive');
Route::get('contacto', 'PagesController@contact')->name('pages.contact');

Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');
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

        Route::get('/estadisticas/auth', 'EstadisticasController@auth')->name('admin.estadisticas.auth');
<<<<<<< HEAD
        Route::get('/estadisticas/tabla', 'EstadisticasController@tabla')->name('admin.estadisticas.tabla');
=======
        Route::post('/estadisticas/fecha', 'EstadisticasController@fecha')->name('admin.estadisticas.fecha');
        Route::get('/Subcategory/{id}', 'SubcategoryController@subs')->name('admin.subcategorias.subs');
>>>>>>> 6e6157c40783b20e323bca72fed54a6649bf93ae
});

Route::get('reportes/{post}', 'PostsController@show')->name('posts.show');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');