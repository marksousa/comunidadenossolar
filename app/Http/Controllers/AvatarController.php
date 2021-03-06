<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use Auth;
use Storage;

class AvatarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.tentativa-crop');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $rules = array(
        'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      );

      $validator = Validator::make($request->all(), $rules);

      if ($validator->fails()) {
        abort(500, 'Imagem não permitida.');
      }

      // se não for nulo (entao tem avatar) e precisa excluir
      if(!is_null(Auth::user()->avatar)){
        Storage::delete('public/'.Auth::user()->avatar);
      }

      // salva avatar
      $path = $request->avatar->store('public/avatars');
      
      // retira o public da frente do path (ele salva dentro da pasta 'public/avatars' porém para exibir na view nao precisamos do 'public/')
      $path = str_replace('public/', '', $path);

      // grava o path no banco
      Auth::user()->avatar = $path;
      Auth::user()->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
