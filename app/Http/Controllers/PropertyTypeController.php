<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = PropertyType::all();
        return view('property-type.index',compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_inmueble' => 'required'
        ]);

        if ($request->ajax()) {
            $newData = new PropertyType();
            $newData->tipo_inmueble = $request->tipo_inmueble;
            $newData->cantidad = 0;
            $newData->save();
            app(BinnacleController::class)->store("Insert", "Registro de nuevo tipo de propiedad.", auth()->user()->name);
            return response()->json();
        }
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PropertyType::all();
            return response()->json($data);
        }
    }

    public function edit($id,PropertyType $propertyType)
    {
        if (request()->ajax()) {
            $data = PropertyType::findOrFail($id);
            return response()->json($data);
        }
    }

    public function update(Request $request, PropertyType $propertyType)
    {
        $request->validate([
            'tipo_inmueble' => 'required',
            'cantidad' => 'required|integer'
        ]);

        if (request()->ajax()) {
            $data = request()->except('_token');
            $array = ([
                'tipo_inmueble' => $data['tipo_inmueble'],
                'cantidad' => $data['cantidad'],
            ]);
            PropertyType::where('id', '=', $request->id)->update($array);
            app(BinnacleController::class)->store("Update", "Actualizacion de tipo de propiedad.", auth()->user()->name);
            return response()->json($data);
        }
    }

    public function destroy($id,PropertyType $propertyType)
    {
        if (request()->ajax()) {
            PropertyType::destroy($id);
            app(BinnacleController::class)->store("Delete", "Eliminación de tipo de propiedad.", auth()->user()->name);
            return response()->json();
        }
    }
}
