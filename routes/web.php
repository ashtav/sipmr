<?php

use App\Models\Content;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Materi;
use App\Models\Pengumuman;
use App\Models\Activity;
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

Route::get('/', function () use ($router) {
    $content = Content::first();
    if(Auth::check()){
        $user = User::count();
        $materi = Materi::count();
        $pengumuman = Pengumuman::count();
        $kegiatan = Activity::count();

        return view('admin.index', compact(['user','materi','pengumuman','kegiatan']));
    }else{
        return view('welcome', compact('content'));
    }
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
        $router->post('/activation/{id}', 'MemberController@activate');
    });

    $router->group(['prefix' => 'gallery'], function () use ($router) {
        $router->get('/', 'GalleryController@index');
        $router->post('/', 'GalleryController@store');
        $router->put('/{id}', 'GalleryController@update');
        $router->delete('/{id}', 'GalleryController@destroy');
    });

    $router->group(['prefix' => 'materi'], function () use ($router) {
        $router->get('/', 'MateriController@index');
        $router->post('/', 'MateriController@store');
        $router->put('/{id}', 'MateriController@update');
        $router->delete('/{id}', 'MateriController@destroy');
    });

    $router->group(['prefix' => 'pengumuman'], function () use ($router) {
        $router->get('/', 'PengumumanController@index');
        $router->post('/', 'PengumumanController@store');
        $router->put('/{id}', 'PengumumanController@update');
        $router->delete('/{id}', 'PengumumanController@destroy');
    });

    $router->group(['prefix' => 'content'], function () use ($router) {
        $router->get('/', 'ContentController@sejarah');

        $router->get('/sejarah', 'ContentController@sejarah');
        $router->put('/sejarah/{id}', 'ContentController@updateSejarah');

        $router->get('/visi', 'ContentController@visi');
        $router->put('/visi/{id}', 'ContentController@updateVisi');

        $router->get('/struktur', 'ContentController@struktur');
        $router->put('/struktur/{id}', 'ContentController@updateStruktur');
        $router->post('/struktur_img', 'ContentController@updateStrukturImg');

    });

    $router->group(['prefix' => 'profile'], function () use ($router) {
        $router->get('/', 'ProfileController@index');
        $router->put('/change-foto', 'ProfileController@updateFoto');
    });

    $router->group(['prefix' => 'activity'], function () use ($router) {
        $router->get('/', 'ActivityController@index');
        $router->post('/', 'ActivityController@store');
        $router->put('/{id}', 'ActivityController@update');
        $router->delete('/{id}', 'ActivityController@destroy');
    });
});


Auth::routes();
