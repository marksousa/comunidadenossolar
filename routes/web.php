<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

// Route::get('/', function () {
//     return view('home');
// });

// rota pagina institucional
Route::get('/', 'HomeController@index')->name('home');

// grupo de rotas para as paginas do admin
Route::group(['middleware' => 'auth','prefix' => 'admin'],function () {
  
  // dashboard
  Route::get('/', "Admin\AdminController@index")->name('admin-home');
  
  // modelo pagina exemplo
  Route::get('/exemplo', function(){
    return view('admin.modelo-pagina');
  });

  Route::get('/usuario/novo', 'UsuarioController@create')->name('UsuarioCreate');
  Route::post('/usuario/novo', 'UsuarioController@store')->name('UsuarioStore');
  Route::get('/usuarios', 'UsuarioController@index')->name('UsuarioList');
  Route::get('/usuarios/{id}', 'UsuarioController@show')->name('UsuarioShow');
});
