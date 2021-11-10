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
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        app(BinnacleController::class)->store("Insert", "Registro de nuevo tipo de propiedad.", auth()->user()->name);
    }

    public function show()
    {
        if (request()->ajax()) {
            $data = PropertyType::all();
            return response()->json($data);
        }
    }

    public function edit(PropertyType $propertyType)
    {
        //
    }

    public function update(Request $request, PropertyType $propertyType)
    {
        app(BinnacleController::class)->store("Update", "Actualizacion de tipo de propiedad.", auth()->user()->name);
    }

    public function destroy(PropertyType $propertyType)
    {
        app(BinnacleController::class)->store("Delete", "Eliminación de tipo de propiedad.", auth()->user()->name);
    }
}
