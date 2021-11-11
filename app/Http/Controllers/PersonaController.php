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

        if (request()->ajax()) {
            $data = User::all();
            return response()->json($data);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users|max:15',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'rol' => 'required'
        ]);

        if ($request->ajax()) {
            $newData = new User();
            $newData->name = $request->name;
            $newData->email = $request->email;
            $newData->password = Hash::make($request->password);
            $newData->rol = $request->rol;

            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo usuario", auth()->user()->name);
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
            app(BinnacleController::class)->store("Delete", "Eliminación de Usuario", auth()->user()->name);
            return response()->json();
        }
    }

    public function edit($id, Request $request)
    {
        //obtener los datos
        if (request()->ajax()) {
            $data = User::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:15',
            'email' => 'required',
            'rol' => 'required'
        ]);
        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'name' => $data['name'],
                'email' => $data['email'],
                'rol' => $data['rol'],
            ]);
            User::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de Usuario", auth()->user()->name);
            return response()->json($data);
        }
    }
}
