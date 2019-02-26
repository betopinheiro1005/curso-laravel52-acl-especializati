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

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/post/{id}/update', 'HomeController@update');

// Route::get('/roles-permissions', 'HomeController@rolesPermissions');




Route::group(['prefix' => 'painel'], function(){    
    //PostController
    Route::get('posts', 'Painel\PostController@index');
    
    //PermissionController
    Route::get('permissions', 'Painel\PermissionController@index');
    Route::get('permission/{id}/roles', 'Painel\PermissionController@roles');
    
    //RoleController
    Route::get('roles', 'Painel\RoleController@index');
    Route::get('role/{id}/permissions', 'Painel\RoleController@permissions');

    //UserController
    Route::get('users', 'Painel\UserController@index');
    Route::get('user/{id}/roles', 'Painel\UserController@roles');
    
    //PainelController
    Route::get('/', 'Painel\PainelController@index');
});

Route::auth();

Route::get('/', 'Portal\SiteController@index');

Route::get('/login', function () {
     return view('Auth/login');
});

Route::get('/register', function () {
     return view('Auth/register');
});

Route::get('/logout', 'Auth\LoginController@logout');







