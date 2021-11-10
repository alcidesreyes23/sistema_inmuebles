<?php

namespace App\Http\Controllers;

use App\Models\Citizen;
use App\Models\Binnacle;
use Illuminate\Http\Request;

class CitizenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view("citizens.index");
    }

    public function cargarDatos()
    {
        //listado
        //$data = Persona::orderBy('id', 'DESC')->get();
        if (request()->ajax()) {
            $data = Citizen::all();
            return response()->json($data);
        }
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        Citizen::create($request->all());
        app(BinnacleController::class)->store("Insert", "Registro de nuevo Ciudadano", auth()->user()->name);
        if ($request->posee_inmueble == 'Si') {
            $lastId = Citizen::latest('id')->first();
            return redirect()->route('properties.index2', $lastId);
        }
        return redirect()->route('citizens.index');
    }

    public function show(Citizen $citizen)
    {
        //
    }

    public function edit($id, Request $request)
    {
        //obtener los datos
        if (request()->ajax()) {
            $data = Citizen::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request)
    {
        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'nombres' => $data['nombres'],
                'apellidos' => $data['apellidos'],
                'edad' => $data['edad'],
                'genero' => $data['genero'],
                'dui' => $data['dui'],
                'nit' => $data['nit'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'posee_inmueble' => $data['posee_inmueble'],
            ]);
            Citizen::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de Ciudadano", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id)
    {
        //eliminar
        if (request()->ajax()) {
            Citizen::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminacion de Ciudadano", auth()->user()->name);
            return response()->json();
        }
    }
}
