<?php

namespace App\Http\Controllers;

use App\Models\Binnacle;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PersonaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("personas.index");
    }

    public function cargarDatos()
    {
        //listado
        //$data = Persona::orderBy('id', 'DESC')->get();
        if (request()->ajax()) {
            $data = User::all();
            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
 
        if ($request->ajax()) {

            
            $newData = new User();
            $newData->name = $request->name;  
            $newData->email = $request->email;
            $newData->password = Hash::make($request->password);
            $newData->rol = $request->rol;

            $newData->save();

            $log = new Binnacle();
            $log->titulo = "Insert";
            $log->descripcion = "Registro de nuevo usuario";
            $log->username = auth()->user()->name;
            $log->save();

            return response()->json();
        }
    }

    public function destroy($id)
    {
        //eliminar
        if (request()->ajax()) {
            User::destroy($id);

            $log = new Binnacle();
            $log->titulo = "Delete";
            $log->descripcion = "Eliminación de Usuario";
            $log->username = auth()->user()->name;
            $log->save();

            return response()->json();
        }
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
         //obtener los datos
         if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'name' => $data['name'],
                'email' => $data['email'],
                'rol' => $data['rol'],
            ]);
            User::where('id', '=', $request->id)->update($array);

            $log = new Binnacle();
            $log->titulo = "Update";
            $log->descripcion = "Actualizacion de Usuario";
            $log->username = auth()->user()->name;
            $log->save();


            return response()->json($data);
            
        }

    }
}
