<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// rota home página institucional
Route::get('/', 'HomeController@index')->name('home');

// grupo de rotas para as paginas do admin
Route::group(['middleware' => ['auth'],'prefix' => 'admin'],function () {
  
  // dashboard
  Route::get('/', "Admin\AdminController@index")->name('admin-home');
  
  // modelo pagina exemplo
  Route::get('/exemplo', function(){
    return view('admin.modelo-pagina');
  });

  // Tentativa upload fotos
  Route::get('/tentativa/crop', function(){
    return view('admin.tentativa-crop');
  });

  Route::get('/upload/avatar', 'AvatarController@create')->name('AvatarCreate');
  Route::post('/upload/avatar', 'AvatarController@store')->name('AvatarStore');
  
  Route::get('/profile/{id}', 'ProfileController@show')->name('ProfileShow');

  Route::get('/usuario/novo', 'UsuarioController@create')->name('UsuarioCreate');
  Route::post('/usuario/novo', 'UsuarioController@store')->name('UsuarioStore');
  Route::get('/usuario', 'UsuarioController@index')->name('UsuarioList');
  Route::get('/usuario/{id}', 'UsuarioController@show')->name('UsuarioShow');
  Route::get('/usuario/{id}/foto/upload/', 'FotoController@create')->name('FotoCreate');
  Route::post('/usuario/foto/store', 'FotoController@store')->name('FotoStore');
});
