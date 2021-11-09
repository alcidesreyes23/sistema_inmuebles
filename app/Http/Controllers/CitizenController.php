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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {

            $newData = new Citizen();
            $newData->nombres = $request->nombres;  
            $newData->apellidos = $request->apellidos;
            $newData->genero = $request->genero;
            $newData->dui = $request->dui;
            $newData->nit = $request->nit;
            $newData->posee_inmueble = $request->posee_inmueble;
            $newData->edad = $request->edad;
            $newData->fecha_nacimiento = $request->fecha_nacimiento;
            
            $newData->save();

            $log = new Binnacle();
            $log->titulo = "Insert";
            $log->descripcion = "Registro de nuevo ciudadano";
            $log->username = auth()->user()->name;
            $log->save();

            return response()->json();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function show(Citizen $citizen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
         //obtener los datos
         if (request()->ajax()) {
            $data = Citizen::findOrFail($id);
            return response()->json($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
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

            $log = new Binnacle();
            $log->titulo = "Update";
            $log->descripcion = "Actualizacion de Ciudadano";
            $log->username = auth()->user()->name;
            $log->save();


            return response()->json($data);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Citizen  $citizen
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //eliminar
         if (request()->ajax()) {
            Citizen::destroy($id);

            $log = new Binnacle();
            $log->titulo = "Delete";
            $log->descripcion = "Eliminación de Ciudadano";
            $log->username = auth()->user()->name;
            $log->save();

            return response()->json();
        }
    }
}
