<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});

Route::get('/clear-config', function() {
  Artisan::call('config:clear');
  return "Config is cleared";
});

// rota home página institucional
// Route::get('/', 'HomeController@index')->name('home');

// Rota para entrada no sistema - Login
Route::get('/', function(){
  return redirect()->route('login');
});

// grupo de rotas para as paginas do admin
Route::group(['middleware' => ['auth'],'prefix' => 'admin'],function () {
  
  // dashboard
  Route::get('/', "Admin\AdminController@index")->name('admin-home');
  
  // modelo pagina exemplo
  Route::get('/exemplo', function(){
    return view('admin.modelo-pagina');
  });

  // Rotas relativas a area do usuário registrado (USER) no sistema
  Route::get('/profile/{id}', 'ProfileController@show')->name('ProfileShow');
  Route::get('/upload/avatar', 'AvatarController@create')->name('AvatarCreate');
  Route::post('/upload/avatar', 'AvatarController@store')->name('AvatarStore');

  // Rotas relativas às pessoas cadastradas (USUARIO) no sistema
  Route::get('/usuarios', 'UsuarioController@index')->name('UsuarioIndex');
  Route::get('/usuario/novo', 'UsuarioController@create')->name('UsuarioCreate');
  Route::post('/usuario/novo', 'UsuarioController@store')->name('UsuarioStore');
  Route::get('/usuario/{id}/editar', 'UsuarioController@edit')->name('UsuarioEdit');
  Route::match(['put', 'patch'],'/usuario/{id}/editar', 'UsuarioController@update')->name('UsuarioUpdate');
  Route::get('/usuario/{id}', 'UsuarioController@show')->name('UsuarioShow');
  Route::get('/usuario/{id}/foto/upload/', 'FotoController@create')->name('FotoCreate');
  Route::post('/usuario/foto/store', 'FotoController@store')->name('FotoStore');

  // Rotas Relativas aos papeis dos USERS do sistema
  Route::get('/users', 'Admin\UserController@index')->name('UserIndex');
  Route::get('user/papel/{id}', 'Admin\UserController@papel')->name('UserPapel');
  Route::post('user/papel/{papel}', 'Admin\UserController@papelStore')->name('UserPapelStore');
  Route::delete('user/papel/{user}/{papel}', 'Admin\UserController@papelDestroy')->name('UserPapelDestroy');

  // Rotas do CRUD de Papéis
  Route::resource('papeis', 'Admin\PapelController');

  // Rotas relativas às permissões dos diferentes papéis do sistema
  Route::get('papel/permissao/{id}', 'Admin\PapelController@permissao')->name('PapelPermissao');
  Route::post('papel/permissao/{permissao}', 'Admin\PapelController@permissaoStore')->name('PapelPermissaoStore');
  Route::delete('papel/permissao/{papel}/{permissao}', 'Admin\PapelController@permissaoDestroy')->name('PapelPermissaoDestroy');

  // Rotas do CRUD de Permissões
  Route::resource('permissoes', 'Admin\PermissaoController');
});

// grupo de rotas para as paginas do pilar da saúde
Route::group(['middleware' => ['auth'],'prefix'=>'saude'], function(){
  
  // Prontuários
  Route::get('/prontuario', "Saude\ProntuarioController@index")->name('ProntuarioIndex');
  Route::get('/prontuario/novo/{usuario_id}', "Saude\ProntuarioController@create")->name('ProntuarioCreate');
});
