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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () use ($router) {

    $router->group(['prefix' => 'admin'], function () use ($router) {
        $router->get('/', 'AdminController@index');
    });

    $router->group(['prefix' => 'member'], function () use ($router) {
        $router->get('/', 'MemberController@index');
        $router->post('/', 'MemberController@store');
        $router->put('/{id}', 'MemberController@update');
        $router->delete('/{id}', 'MemberController@destroy');
    });

    $router->group(['prefix' => 'gallery'], function () use ($router) {
        $router->get('/', 'GalleryController@index');
        $router->post('/', 'GalleryController@store');
        $router->put('/{id}', 'GalleryController@update');
        $router->delete('/{id}', 'GalleryController@destroy');
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
